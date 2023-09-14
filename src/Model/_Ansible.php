<?php
/**
 * @copyright   Copyright (C) 2023 Combodo SARL
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace Combodo\iTop\Ansible\Model;

use CMDBObjectSet;
use DBObjectSearch;
use Exception;
use FunctionalCI;
use IssueLog;
use MetaModel;

class _Ansible extends FunctionalCI
{
	/**
	 * Get the list of Inventory Groups in the Ansible instance
	 *
	 * @param $sInventory
	 * @param $iParentId
	 * @return CMDBObjectSet
	 * @throws \OQLException
	 */
	private function GetInventoryGroups($sInventory, $iParentId)
	{
		$sOQL = "SELECT AnsibleInventoryGroup AS ig WHERE ig.ansible_id = :id AND ig.ansibleinventory_name = :inventory AND ig.parent_id = :parent_id";
		$oSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('id' => $this->GetKey(), 'inventory' => $sInventory, 'parent_id' => $iParentId));
		return $oSet;
	}

	/**
	 * Get the list of Inventory Groups children of a given Inventory Group
	 *
	 * @param $iInventoryGroupId
	 * @return CMDBObjectSet
	 * @throws \OQLException
	 */
	private function GetInventoryGroupChildren($iInventoryGroupId)
	{
		$sOQL = "SELECT AnsibleInventoryGroup AS ig WHERE ig.parent_id = :key";
		$oSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('key' => $iInventoryGroupId));
		return $oSet;
	}

	/**
	 * Get the list of links between Inventory Groups and Functional CIs for the Ansible instance
	 *
	 * @param $iGroupId
	 * @return CMDBObjectSet
	 * @throws \OQLException
	 */
	private function GetlnkInventoryGroupToFunctionalCIs($iGroupId)
	{
		$sOQL = "SELECT lnkAnsibleInventoryGroupToCI AS l JOIN AnsibleInventoryGroup AS ig ON l.ansibleinventorygroup_id = ig.id WHERE ig.id = :groupid";
		$oSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('groupid' => $iGroupId));
		return $oSet;
	}

	/**
	 * Get the list of all CIs attached to the Ansible instance in a given inventory
	 *
	 * @param $sInventory
	 * @return CMDBObjectSet
	 * @throws \OQLException
	 */
	private function GetFunctionalCIsInInventory ($sInventory)
	{
		$sOQL = "SELECT FunctionalCI AS f JOIN lnkAnsibleInventoryGroupToCI AS l ON l.functionalci_id = f.id JOIN AnsibleInventoryGroup AS g ON l.ansibleinventorygroup_id = g.id WHERE g.ansible_id = :id AND g.ansibleinventory_name = :name";
		$oSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('id' => $this->GetKey(), 'name' => $sInventory));
		return $oSet;
	}

	/**
	 * Get the default list of CIs allowed in inventories
	 * @return string[]
	 */
	public static function GetDefaultFunctionalCIsInInventories()
	{
		$aDefaultCIs = [
			'Server',
			'VirtualMachine',
			'ApplicationSolution'
		];

		return $aDefaultCIs;
	}

	/**
	 * Get list of CI classes that are authorized in inventories
	 *
	 * @return string[]
	 */
	private function GetFunctionalCIClassesAuthorizedInInventories ()
	{
		$aCIClassesInInventoryGroupsParams = MetaModel::GetModuleSetting(ANSIBLE_MODULE_NAME, ANSIBLE_CI_CLASSES_IN_INVENTORYGROUPS, array());
		if (!empty($aCIClassesInInventoryGroupsParams)) {
			$aCIClassesInInventoryGroups = $aCIClassesInInventoryGroupsParams;
		} else {
			$aCIClassesInInventoryGroups = _Ansible::GetDefaultFunctionalCIsInInventories();
		}

		return $aCIClassesInInventoryGroups;
	}

	/**
	 * Get the list of all CIs which class is authorized in inventories
	 *
	 * @return CMDBObjectSet
	 * @throws \OQLException
	 */
	private function GetFunctionalCIsAuthorizedInInventories ()
	{
		$aCIClassesInInventoryGroups = $this->GetFunctionalCIClassesAuthorizedInInventories();

		// Build list for OQL
		$bFirstItem = true;
		$sClasses = "(";
		foreach ($aCIClassesInInventoryGroups AS $iKey => $sClass) {
			if ($bFirstItem) {
				$bFirstItem = false;
				$sClasses .= "'".$sClass."'";
			} else {
				$sClasses .= ",'".$sClass."'";
			}
		}
		$sClasses .= ")";
		IssueLog::Info($sClasses);

		// Get CIs
		$sOQL = "SELECT FunctionalCI WHERE finalclass IN ".$sClasses;
		$oSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL));
		return $oSet;
	}

	/**
	 * @param $oInventoryGroupSet
	 * @param $sPadding
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	private function GetYamlInventoryLevel($oInventoryGroupSet, $sPadding): string
	{
		$sText = '';
		while ($oInventoryGroup = $oInventoryGroupSet->Fetch()) {
			// Display group name
			$sGroupName = $oInventoryGroup->Get('name');
			$sText .= str_pad("", $sPadding + YAML_GROUPS_SPACE).$sGroupName.":\n";

			// Display list of hosts within the group
			$oLnkSet = $this->GetlnkInventoryGroupToFunctionalCIs($oInventoryGroup->GetKey());
			$oAnsibleAuthorizedCiSet = $this->GetFunctionalCIClassesAuthorizedInInventories();
			if ($oLnkSet->CountExceeds(0)) {
				$sText .= str_pad("", $sPadding + YAML_HOSTS_SPACE)."hosts:\n";
				while ($oLnk = $oLnkSet->Fetch()) {
					$sCIFinalclass = $oLnk->Get('functionalci_finalclass');
					if (in_array($sCIFinalclass, $oAnsibleAuthorizedCiSet)) {
						$sText .= str_pad("", $sPadding + YAML_CIS_SPACE).$oLnk->Get('functionalci_name').":\n";
						// Add tags if required
						/** @var \ormTagSet:: $oTag */
						$oTag = $oLnk->Get('tag');
						$aTagValues = $oTag->GetLabels();
						foreach ($aTagValues as $sTag) {
							$sLabel = strstr($sTag, "=", true);
							if ($sLabel !== false) {
								$sValue = substr(strstr($sTag, "=", false), 1);
								$sText .= str_pad("", $sPadding + YAML_HOST_VARIABLES_SPACE).$sLabel.": ".$sValue."\n";
							}
						}
					} else {
						IssueLog::Warning("CI ".$oLnk->Get('functionalci_name')." has not been included in the inventory file because its class doesn't belong to the list of authorized classes.");
					}
				}
			}

			// Display children, if any
			$oInventoryGroupChildrenSet = $this->GetInventoryGroups($oInventoryGroup->get('ansibleinventory_name'), $oInventoryGroup->GetKey());
			if ($oInventoryGroupChildrenSet->CountExceeds(0)) {
				$sNewPadding = $sPadding + YAML_GROUPS_SPACE + YAML_CHILDREN_SPACE;
				$sText .= str_pad("", $sNewPadding)."children:\n";
				$sText .= $this->GetYamlInventoryLevel($oInventoryGroupChildrenSet, $sNewPadding);
			}
		}

		return $sText;
	}

	/**
	 * @param $oInventoryGroupSet
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	private function GetIniInventoryLevel($oInventoryGroupSet): string
	{
		$sText = '';
		$sTextPrepend = '';
		while ($oInventoryGroup = $oInventoryGroupSet->Fetch()) {
			// Display list of hosts within the group
			$sGroupName = $oInventoryGroup->Get('name');
			$oLnkSet = $this->GetlnkInventoryGroupToFunctionalCIs($oInventoryGroup->GetKey());
			$oAnsibleAuthorizedCiSet = $this->GetFunctionalCIClassesAuthorizedInInventories();
			if ($oLnkSet->CountExceeds(0)) {
				// Display group name but fot the ungrouped one
				// Prepend the ungrouped hosts at the beginning of the file
				if ($sGroupName == YAML_UNGROUPED_INVENTORY_GROUP_NAME) {
					while ($oLnk = $oLnkSet->Fetch()) {
						$sCIFinalclass = $oLnk->Get('functionalci_finalclass');
						if (in_array($sCIFinalclass, $oAnsibleAuthorizedCiSet)) {
							$sTag = $oLnk->Get('tag');
							if ($sTag != '') {
								$sTextPrepend .= $oLnk->Get('functionalci_name')." ".$oLnk->Get('tag')."\n";
							} else {
								$sTextPrepend .= $oLnk->Get('functionalci_name')."\n";
							}
						} else {
							IssueLog::Warning("CI ".$oLnk->Get('functionalci_name')." has not been included in the inventory file because its class doesn't belong to the list of authorized classes.");
						}
					}
				} else {
					$sText .= "\n[".$sGroupName."]\n";
					while ($oLnk = $oLnkSet->Fetch()) {
						$sCIFinalclass = $oLnk->Get('functionalci_finalclass');
						if (in_array($sCIFinalclass, $oAnsibleAuthorizedCiSet)) {
							/** @var \ormTagSet:: $oTag */
							$oTag = $oLnk->Get('tag');
							$aTagValues = $oTag->GetLabels();
							if (!empty($aTagValues)) {
								$sTag = implode(' ', $aTagValues);
								$sText .= $oLnk->Get('functionalci_name')." ".$sTag."\n";
							} else {
								$sText .= $oLnk->Get('functionalci_name')."\n";
							}
						} else {
							IssueLog::Warning("CI ".$oLnk->Get('functionalci_name')." has not been included in the inventory file because its class doesn't belong to the list of authorized classes.");
						}
					}
				}
			}

			$oChildrenSet = $this->GetInventoryGroupChildren($oInventoryGroup->GetKey());
			if ($oChildrenSet->CountExceeds(0)) {
				$sText .= "\n[".$sGroupName.":children]\n";
				while ($oChild = $oChildrenSet->Fetch()) {
					$sText .= $oChild->Get('name')."\n";
				}
			}
			// Display children, if any
			$oInventoryGroupChildrenSet = $this->GetInventoryGroups($oInventoryGroup->get('ansibleinventory_name'), $oInventoryGroup->GetKey());
			$sText .= $this->GetIniInventoryLevel($oInventoryGroupChildrenSet);
		}

		return $sTextPrepend.$sText;
	}

	/**
	 * Get the inventory file of the Ansible instance
	 *
	 * @param $sInventory: inventory name
	 * @param $sFormat: format to use for the inventory
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	public function GetInventoryFile($sInventory, $sFormat): string
	{
		$oParentInventoryGroupSet = $this->GetInventoryGroups($sInventory, 0);

		$sText = '';
		switch ($sFormat) {
			case 'yml':
				$sText .= "all:\n";
				$sText .= str_pad("", YAML_CHILDREN_SPACE)."children:\n";
				$sText .= $this->GetYamlInventoryLevel($oParentInventoryGroupSet, YAML_CHILDREN_SPACE);
				break;

			case 'ini':
			default:
				$sText .= $this->GetIniInventoryLevel($oParentInventoryGroupSet);
				break;
		}

		return $sText;
	}

	/**
	 * Get the list of hosts from a given OQL
	 *
	 * @param $sInventory
	 * @param $sOQL
	 * @param $sAttribute
	 * @return array
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	public function GetHostsListFromOQL($sInventory, $sOQL, $sAttribute): array
	{
		$sHostList = '';
		$iNbCIs = 0;
		$sErrorMsg = '';

		// Get set of CIs defined by inventory OQL
		try {
			$oHostByOQLSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL));
		} catch (Exception $e) {
			$sErrorMsg = 'Invalid OQL provided';
			IssueLog::Debug($sErrorMsg);

			return [$sHostList, $iNbCIs, $sErrorMsg];
		}

		// Make sure the Set host FunctionalCIs
		$sSetClass = $oHostByOQLSet->GetClass();
		if (MetaModel::GetRootClass($sSetClass) != 'FunctionalCI') {
			$sErrorMsg = 'The OQL doesn\'t provide Functional CIs';
			IssueLog::Debug($sErrorMsg);

			return [$sHostList, $iNbCIs, $sErrorMsg];
		}
		// Make sure that the requested attribute is part of the common class given by the set
		$sCiClass = $oHostByOQLSet->GetClass();
		if (!MetaModel::IsValidAttCode($sCiClass, $sAttribute)) {
			$sErrorMsg = 'The requested attribute "'.$sAttribute.'" is not valid for the CI class "'.$sCiClass.'" resulting from the OQL.';
		} else {
			// Get set of CIs attached to the Ansible application
			$oAnsibleAuthorizedCiSet = $this->GetFunctionalCIsAuthorizedInInventories();
			if ($sInventory != '') {
				$oAnsibleCiInventorySet = $this->GetFunctionalCIsInInventory($sInventory);
				$oAnsibleCiSet = $oAnsibleCiInventorySet->CreateIntersect($oAnsibleAuthorizedCiSet);
				$oHostSet = $oHostByOQLSet->CreateIntersect($oAnsibleCiSet);
			} else {
				$oHostSet = $oHostByOQLSet->CreateIntersect($oAnsibleAuthorizedCiSet);
			}
			$iNbCIs = $oHostSet->Count();
			$bFirstHost = true;
			while ($oHost = $oHostSet->Fetch()) {
				if ($bFirstHost) {
					$bFirstHost = false;
				} else {
					$sHostList .= ',';
				}
				$sHostList .= $oHost->Get($sAttribute);
			}
		}

		return [$sHostList, $iNbCIs, $sErrorMsg];
	}

}