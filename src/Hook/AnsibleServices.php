<?php
/**
 * @copyright   Copyright (C) 2023 Combodo SARL
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace Combodo\iTop\Ansible\Hook;

use CMDBObjectSet;
use Combodo\iTop\Ansible\Controller\RestResultWithTextFile;
use DBObjectSearch;
use iRestServiceProvider;
use RestResult;
use RestResultWithObjects;
use RestUtils;
use UserRights;

/**
 * Implementation of REST services for Ansible
 *
 */
class AnsibleServices implements iRestServiceProvider
{
	const ANSIBLE_SERVICES_VERSION = '1.0';

	/**
	 * Enumerate services delivered by this class
	 *
	 * @param string $sVersion The version (e.g. 1.0) supported by the services
	 * @return array An array of hash 'verb' => verb, 'description' => description
	 */
	public function ListOperations($sVersion)
	{
		$aOps = array();
		$aOps[] = array(
			'verb' => 'ansible/get_webservices_version',
			'description' => 'Provide the version currently in use for the iTop WEB services dedicated to Ansible'
		);
		$aOps[] = array(
			'verb' => 'ansible/get_inventory',
			'description' => 'Get the inventory of an Ansible application'
		);
		$aOps[] = array(
			'verb' => 'ansible/get_hosts_by_oql',
			'description' => 'Get a list of hosts for an the Ansible application'
		);

		return $aOps;
	}

	/**
	 * Enumerate services delivered by this class
	 *
	 * @param string $sVersion The version (e.g. 1.0) supported by the services
	 * @param string $sVerb
	 * @param object $aParams
	 *
	 * @return RestResult The standardized result structure (at least a message)
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \SimpleGraphException
	 * @throws \Exception
	 */
	public function ExecOperation($sVersion, $sVerb, $aParams)
	{
		switch ($sVerb) {
			case 'ansible/get_webservices_version':
				$oResult = new RestResult();
				$oResult->code = RestResult::OK;
				$oResult->message = 'Running version of the iTop WEB services dedicated to Ansible is: '.static::ANSIBLE_SERVICES_VERSION;
				break;

			case 'ansible/get_inventory':
				$oResult = new RestResultWithTextFile();
				// Check user rights
				if (UserRights::IsActionAllowed('Ansible', UR_ACTION_READ) != UR_ALLOWED_YES) {
					$oResult->code = RestResult::UNAUTHORIZED;
					$oResult->message = 'The current user does not have enough permissions to read Ansible data.';
					break;
				}

				// Check that a valid Ansible application has been given
				$sUUID = RestUtils::GetMandatoryParam($aParams, 'uuid');
				$sOQL = "SELECT Ansible AS a WHERE a.uuid = :uuid";
				$oAnsibleSet =  new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('uuid' => $sUUID));
				if ($oAnsible = $oAnsibleSet->Fetch()) {
					// Compute inventory
					$sInventory = RestUtils::GetMandatoryParam($aParams, 'inventory');
					$sFormat = RestUtils::GetMandatoryParam($aParams, 'format');
					$sFormat = ($sFormat == 'yml') ? 'yml' : 'ini';
					$sText = $oAnsible->GetInventoryFile($sInventory, $sFormat);
					$oResult->AddObject(0, 'computed', $oAnsible, $sText);
					$oResult->code = RestResult::OK;
					$oResult->message = "Found 1 Ansible application";
				} else {
					$oResult->code = RestResult::INTERNAL_ERROR;
					$oResult->message = "No Ansible application found";
				}
				break;

			case 'ansible/get_hosts_by_oql':
				$oResult = new RestResultWithTextFile();
				// Check user rights
				if (UserRights::IsActionAllowed('Ansible', UR_ACTION_READ) != UR_ALLOWED_YES) {
					$oResult->code = RestResult::UNAUTHORIZED;
					$oResult->message = 'The current user does not have enough permissions to read Ansible data.';
					break;
				}

				// Check that a valid Ansible application has been given
				$sUUID = RestUtils::GetMandatoryParam($aParams, 'uuid');
				$sOQL = "SELECT Ansible AS a WHERE a.uuid = :uuid";
				$oAnsibleSet =  new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('uuid' => $sUUID));
				if ($oAnsible = $oAnsibleSet->Fetch()) {
					$sInventory = RestUtils::GetOptionalParam($aParams, 'inventory', '');
					$sHostsOQL = RestUtils::GetMandatoryParam($aParams, 'oql');
					$sAttribute = RestUtils::GetOptionalParam($aParams, 'attribute', 'name');
					list ($sHostList, $iNbCIs, $sError) = $oAnsible->GetHostsListFromOQL($sInventory, $sHostsOQL, $sAttribute);
					if ($sError != '') {
						$oResult->code = RestResult::INTERNAL_ERROR;
						$oResult->message = $sError;
					} else {
						$oResult->AddObject(0, 'computed', $oAnsible, $sHostList);
						$oResult->code = RestResult::OK;
						$oResult->message = "Found: ".$iNbCIs.' CIs';
					}
				} else {
					$oResult->code = RestResult::INTERNAL_ERROR;
					$oResult->message = "No Ansible application found";
				}
				break;

			default:
				// unknown operation: handled at a higher level
				$oResult = new RestResultWithObjects();
		}

		return $oResult;
	}
}

