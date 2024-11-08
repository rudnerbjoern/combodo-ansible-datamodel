<?php
/**
 * @copyright   Copyright (C) 2023 Combodo SARL
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace Combodo\iTop\Ansible\Controller;

use Combodo\iTop\Ansible\Model\AnsibleObjectResult;
use DBObject;
use RestResult;

class RestResultWithTextFile extends RestResult
{
	public array $objects;

	/**
	 * Report the given object
	 *
	 * @param $iCode
	 * @param string $sMessage Description of the error if any, an empty string otherwise
	 * @param DBObject $oObject The object being reported
	 * @param $sText
	 *
	 * @return void
	 */
	public function AddObject($iCode, string $sMessage, DBObject $oObject, $sText): void {
		$sClass = get_class($oObject);
		$oObjRes = new AnsibleObjectResult($sClass, $oObject->GetKey());
		$oObjRes->code = $iCode;
		$oObjRes->message = $sMessage;

		$oObjRes->text_file = $sText;

		$sObjKey = get_class($oObject).'::'.$oObject->GetKey();
		$this->objects[$sObjKey] = $oObjRes;
	}
}
