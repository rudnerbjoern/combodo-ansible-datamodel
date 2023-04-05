<?php
/**
 * @copyright   Copyright (C) 2023 Combodo SARL
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace Combodo\iTop\Ansible\Model;

use CMDBObjectSet;
use DBObjectSearch;
use FunctionalCI;

class _Ansible extends FunctionalCI
{
	/**
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
	 * @param $iGroupId
	 * @return CMDBObjectSet
	 * @throws \OQLException
	 */
	private function GetFunctionalCIs($iGroupId)
	{
		$sOQL = "SELECT lnkAnsibleInventoryGroupToFunctionalCI AS l JOIN AnsibleInventoryGroup AS ig ON l.ansibleinventorygroup_id = ig.id WHERE ig.id = :key";
		$oSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('key' => $iGroupId));
		return $oSet;
	}

	/**
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
		$sHtml = '';
		while ($oInventoryGroup = $oInventoryGroupSet->Fetch()) {
			// Display group name
			$sGroupName = $oInventoryGroup->Get('name');
			$sHtml .= str_pad("", $sPadding + YAML_GROUPS_SPACE).$sGroupName.":\n";

			// Display list of hosts within the group
			$oLnkSet = $this->GetFunctionalCIs($oInventoryGroup->GetKey());
			if ($oLnkSet->CountExceeds(0)) {
				$sHtml .= str_pad("", $sPadding + YAML_HOSTS_SPACE)."hosts:\n";
				while ($oLnk = $oLnkSet->Fetch()) {
					$sHtml .= str_pad("", $sPadding + YAML_CIS_SPACE).$oLnk->Get('functionalci_name').": {".$oLnk->Get('tag')."}\n";
				}
			}

			// Display children, if any
			$oInventoryGroupChildrenSet = $this->GetInventoryGroups($oInventoryGroup->get('ansibleinventory_name'), $oInventoryGroup->GetKey());
			if ($oInventoryGroupChildrenSet->CountExceeds(0)) {
				$sNewPadding = $sPadding + YAML_GROUPS_SPACE + YAML_CHILDREN_SPACE;
				$sHtml .= str_pad("", $sNewPadding)."children:\n";
				$sHtml .= $this->GetYamlInventoryLevel($oInventoryGroupChildrenSet, $sNewPadding);
			}
		}

		return $sHtml;
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
		$sHtml = '';
		$sHtmlPrepend = '';
		while ($oInventoryGroup = $oInventoryGroupSet->Fetch()) {
			// Display list of hosts within the group
			$sGroupName = $oInventoryGroup->Get('name');
			$oLnkSet = $this->GetFunctionalCIs($oInventoryGroup->GetKey());
			if ($oLnkSet->CountExceeds(0)) {
				// Display group name but fot the ungrouped one
				// Prepend the ungrouped hosts at the beginning of the file
				if ($sGroupName == YAML_UNGROUPED_INVENTORY_GROUP_NAME) {
					while ($oLnk = $oLnkSet->Fetch()) {
						$sHtmlPrepend .= $oLnk->Get('functionalci_name')."\n";
					}
				} else {
					$sHtml .= "\n[".$sGroupName."]\n";
					while ($oLnk = $oLnkSet->Fetch()) {
						$sHtml .= $oLnk->Get('functionalci_name')."\n";
					}
				}
			}

			$oChildrenSet = $this->GetInventoryGroupChildren($oInventoryGroup->GetKey());
			if ($oChildrenSet->CountExceeds(0)) {
				$sHtml .= "\n[".$sGroupName.":children]\n";
				while ($oChild = $oChildrenSet->Fetch()) {
					$sHtml .= $oChild->Get('name')."\n";
				}
			}
			// Display children, if any
			$oInventoryGroupChildrenSet = $this->GetInventoryGroups($oInventoryGroup->get('ansibleinventory_name'), $oInventoryGroup->GetKey());
			$sHtml .= $this->GetIniInventoryLevel($oInventoryGroupChildrenSet);
		}

		return $sHtmlPrepend.$sHtml;
	}

	/**
	 * Provides zone in BIND format in a text field
	 *
	 * @param $sSortOrder
	 *
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public function GetInventoryFile($sInventory, $sFormat): string
	{
		$oParentInventoryGroupSet = $this->GetInventoryGroups($sInventory, 0);

		$sHtml = '';
		switch ($sFormat) {
			case 'yaml':
				$sHtml .= "all:\n";
				$sHtml .= str_pad("", YAML_CHILDREN_SPACE)."children:\n";
				$sHtml .= $this->GetYamlInventoryLevel($oParentInventoryGroupSet, YAML_CHILDREN_SPACE);
				break;

			case 'ini':
			default:
				$sHtml .= $this->GetIniInventoryLevel($oParentInventoryGroupSet);
				break;
		}

		return $sHtml;
	}


}