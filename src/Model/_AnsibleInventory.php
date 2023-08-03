<?php
/**
 * @copyright   Copyright (C) 2023 Combodo SARL
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace Combodo\iTop\Ansible\Model;

use ApplicationContext;
use cmdbAbstractObject;
use Combodo\iTop\Application\UI\Base\Layout\Object\ObjectFactory;
use Combodo\iTop\Application\UI\Base\Layout\PageContent\PageContentFactory;
use DBObjectSearch;
use Dict;
use iTopWebPage;
use MenuBlock;
use MetaModel;
use utils;

class _AnsibleInventory extends cmdbAbstractObject
{
	public function SetPageTitles(iTopWebPage $oP, $sUIPath, $bIcon = true) {
		$sClassLabel = MetaModel::GetName(get_class($this));
		$oP->set_title(Dict::Format($sUIPath.':PageTitle_Object_Class', $this->GetName(), $sClassLabel));
		$oP->add("<div class=\"page_header teemip_page_header\">\n");
		$sIcon = '';
		if ($bIcon) {
			$sIcon = $this->GetIcon()."&nbsp;";
		}
		$oP->add("<h1>".$sIcon.Dict::Format($sUIPath.':Title_Class_Object', $sClassLabel,
				'<span class="hilite">'.$this->GetName().'</span>')."</h1>\n");
		$oP->add("</div>\n");
	}

	public function DisplayBareTab(iTopWebPage $oP, $sTitle = '') {
		$sClass = get_class($this);
		if (version_compare(ITOP_DESIGN_LATEST_VERSION, '3.0', '<')) {
			// Display action menu
			$oSingletonFilter = new DBObjectSearch($sClass);
			$oSingletonFilter->AddCondition('id', $this->GetKey(), '=');
			$oBlock = new MenuBlock($oSingletonFilter, 'details', false);
			$oBlock->Display($oP, 'baretab');

			// Set titles
			$this->SetPageTitles($oP, $sTitle);
		} else {
			// The object can be read - Process request now
			$sClassLabel = MetaModel::GetName($sClass);

			$oP->set_title(Dict::Format('UI:DetailsPageTitle', $this->GetRawName(), $sClassLabel)); // Set title will take care of the encoding
			$oP->SetContentLayout(PageContentFactory::MakeForObjectDetails($this, cmdbAbstractObject::ENUM_DISPLAY_MODE_VIEW));
			$oObjectDetails = ObjectFactory::MakeDetails($this);

			$aHeadersBlocks = $this->DisplayBareHeader($oP, false);
			if (false === empty($aHeadersBlocks['subtitle'])) {
				$oObjectDetails->AddSubTitleBlocks($aHeadersBlocks['subtitle']);
			}
			if (false === empty($aHeadersBlocks['toolbar'])) {
				$oObjectDetails->AddToolbarBlocks($aHeadersBlocks['toolbar']);
			}

			$oP->AddUiBlock($oObjectDetails);
			$oP->AddTabContainer(OBJECT_PROPERTIES_TAB, '', $oObjectDetails);
			$oP->SetCurrentTabContainer(OBJECT_PROPERTIES_TAB);
			$oP->SetCurrentTab(Dict::S($sTitle));
		}
	}

	public function DisplayInventoryFile(iTopWebPage $oP, $aParams = array()): void
	{
		$this->DisplayBareTab($oP, 'UI:AnsibleInventory:Action:FileDisplay:Title');

		$id = $this->GetKey();

		// Prepare context to switch display order and display button
		$sUrl = utils::GetAbsoluteUrlModulePage('combodo-ansible-datamodel', 'ui.combodo-ansible-datamodel.php', array());
		$sHtml = "<form method=\"post\" action=\"".$sUrl."\">";
		$sHtml .= "<input type=\"hidden\" name=\"class\" value=\"AnsibleInventory\">";
		$sHtml .= "<input type=\"hidden\" name=\"id\" value=\"$id\">";
		$sHtml .= "<input type=\"hidden\" name=\"operation\" value=\"inventoryfiledisplay\">";
		$sHtml .= "<input type=\"hidden\" name=\"transaction_id\" value=\"".utils::GetNewTransactionId()."\">";
		$sFormat = $aParams['format'];
		$sNewFormat = ($sFormat == 'ini') ? 'yml' : 'ini';
		$sHtml .= "<input type=\"hidden\" name=\"format\" value=\"$sNewFormat\">";
		$oAppContext = new ApplicationContext();
		$sHtml .= $oAppContext->GetForForm();
		$sButton = "<button type=\"submit\" class=\"action\"><span>".Dict::S('UI:AnsibleInventory:Action:FileDisplay:Format:'.$sNewFormat)."</span></button>";
		$sHtml .= $sButton."<br><br>";
		$sHtml .= "</form>";
		$oP->add($sHtml);

		// Display text area
		/** @var \Ansible $oAnsible */
		$oAnsible = MetaModel::GetObject('Ansible', $this->Get('ansible_id'));
		$sHtml = $oAnsible->GetInventoryFile($this->Get('name'), $sFormat);
		$sUITitle = Dict::Format('UI:AnsibleInventory:Action:FileDisplay:PageTitle',$this->GetName());
		if (version_compare(ITOP_DESIGN_LATEST_VERSION, '3.0', '<')) {
			$oP->SetBreadCrumbEntry($sUITitle, $sUITitle, '', '', 'fa fa-file');
		} else {
			$oP->SetBreadCrumbEntry($sUITitle, $sUITitle, '', '', 'fa fa-file', iTopWebPage::ENUM_BREADCRUMB_ENTRY_ICON_TYPE_CSS_CLASSES);
		}
		$oP->add(<<<HTML
				<div id="inventoryfile" class="ibo-is-code">
				<pre>$sHtml</pre>
				</div>
HTML
		);
	}


}
