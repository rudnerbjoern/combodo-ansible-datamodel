<?php
/**
 * @copyright   Copyright (C) 2023 Combodo SARL
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//
// Class: Ansible
//
Dict::Add('EN US', 'English', 'English', array(
	'Class:Ansible' => 'Ansible Application',
	'Class:Ansible+' => '',
	'Class:Ansible:baseinfo' => 'General Information',
	'Class:Ansible:operation' => 'Operations',
	'Class:Ansible/Attribute:name+' => 'Name of the Ansible application',
	'Class:Ansible/Attribute:org_id+' => 'Organization that the application belongs to',
	'Class:Ansible/Attribute:status' => 'Status',
	'Class:Ansible/Attribute:status+' => '',
	'Class:Ansible/Attribute:status/Value:obsolete' => 'Obsolete',
	'Class:Ansible/Attribute:status/Value:production' => 'Production',
	'Class:Ansible/Attribute:status/Value:implementation' => 'Implementation',
	'Class:Ansible/Attribute:location_id' => 'Location',
	'Class:Ansible/Attribute:location_id+' => 'Location where the application is installed',
	'Class:Ansible/Attribute:location_name' => 'Location name',
	'Class:Ansible/Attribute:location_name+' => '',
	'Class:Ansible/Attribute:uuid' => 'UUID',
	'Class:Ansible/Attribute:uuid+' => 'Universal Unique Identifier of the application',
	'Class:Ansible/Attribute:functionalci_id' => 'CI',
	'Class:Ansible/Attribute:functionalci_id+' => 'Functional CI hosting the application. It can be a server, a virtual machine or an application solution',
	'Class:Ansible/Attribute:last_execution_date' => 'Last execution date',
	'Class:Ansible/Attribute:last_execution_date+' => 'Date when the last run took place',
	'Class:Ansible/Attribute:duration' => 'Duration',
	'Class:Ansible/Attribute:duration+' => 'Execution time it took for the application',
	'Class:Ansible/Attribute:ansibleinventories_list' => 'Inventories',
	'Class:Ansible/Attribute:ansibleinventories_list+' => 'List of all inventories attached to the application',
	'Class:Ansible/Attribute:ansibleinventorygroups_list' => 'Inventory groups',
	'Class:Ansible/Attribute:ansibleinventorygroups_list+' => 'List of all inventory groups attached to the application',
	'Class:Ansible/Attribute:playbooks_list' => 'Playbooks',
	'Class:Ansible/Attribute:playbooks_list+' => 'List of all playbooks attached to the application',
));

//
// Class: AnsibleInventory
//
Dict::Add('EN US', 'English', 'English', array(
	'Class:AnsibleInventory' => 'Ansible Inventory',
	'Class:AnsibleInventory+' => '',
	'Class:AnsibleInventory/Attribute:name' => 'Name',
	'Class:AnsibleInventory/Attribute:name+' => 'Name of the Ansible inventory',
	'Class:AnsibleInventory/Attribute:ansible_id' => 'Ansible Application',
	'Class:AnsibleInventory/Attribute:ansible_id+' => 'Ansible application that the inventory belongs to',
	'Class:AnsibleInventory/Attribute:ansible_name' => 'Ansible Application name',
	'Class:AnsibleInventory/Attribute:ansible_name+' => '',
	'Class:AnsibleInventory/Attribute:org_id+' => 'Organization that the inventory belongs to',
	'Class:AnsibleInventory/Attribute:description' => 'Description',
	'Class:AnsibleInventory/Attribute:description+' => '',
	'Class:AnsibleInventory/Attribute:ansibleinventorygroups_list' => 'Inventory Groups',
	'Class:AnsibleInventory/Attribute:ansibleinventorygroups_list+' => 'All the inventary groups that belong to the inventory',
	'Class:AnsibleInventory/Tab:cis_list' => 'CI',
	'Class:AnsibleInventory/Tab:cis_list+' => 'List of all CIs attached to an inventory group belonging to the inventory',
));

//
// Class: AnsibleInventoryGroup
//
Dict::Add('EN US', 'English', 'English', array(
	'Class:AnsibleInventoryGroup' => 'Ansible Inventory Group',
	'Class:AnsibleInventoryGroup+' => '',
	'Class:AnsibleInventoryGroup/Attribute:name' => 'Name',
	'Class:AnsibleInventoryGroup/Attribute:name+' => 'Name of the Ansible inventory group',
	'Class:AnsibleInventoryGroup/Attribute:ansible_id' => 'Ansible Application',
	'Class:AnsibleInventoryGroup/Attribute:ansible_id+' => 'Ansible application that the inventory group belongs to',
	'Class:AnsibleInventoryGroup/Attribute:ansible_name' => 'Ansible Application name',
	'Class:AnsibleInventoryGroup/Attribute:ansible_name+' => '',
	'Class:AnsibleInventoryGroup/Attribute:org_id+' => 'Organization that the inventory group belongs to',
	'Class:AnsibleInventoryGroup/Attribute:ansibleinventory_id' => 'Ansible Inventory',
	'Class:AnsibleInventoryGroup/Attribute:ansibleinventory_id+' => 'Ansible inventory that the group belongs to',
	'Class:AnsibleInventoryGroup/Attribute:parent_id' => 'Parent group',
	'Class:AnsibleInventoryGroup/Attribute:parent_id+' => 'Parent inventory group',
	'Class:AnsibleInventoryGroup/Attribute:parent_name' => 'Parent group name',
	'Class:AnsibleInventoryGroup/Attribute:parent_name+' => '',
	'Class:AnsibleInventoryGroup/Attribute:description' => 'Description',
	'Class:AnsibleInventoryGroup/Attribute:description+' => '',
	'Class:AnsibleInventoryGroup/Attribute:functionalcis_list' => 'CIs',
	'Class:AnsibleInventoryGroup/Attribute:functionalcis_list+' => 'All the CIs that belong to the group',
));

//
// Class lnkAnsibleInventoryGroupToFunctionalCI
//
Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkAnsibleInventoryGroupToFunctionalCI' => 'Link Ansible Inventory Group / Functional CI',
	'Class:lnkAnsibleInventoryGroupToFunctionalCI+' => '',
	'Class:lnkAnsibleInventoryGroupToFunctionalCI/Name' => '%1$s / %2$s',
	'Class:lnkAnsibleInventoryGroupToFunctionalCI/Attribute:functionalci_id' => 'CI',
	'Class:lnkAnsibleInventoryGroupToFunctionalCI/Attribute:functionalci_id+' => 'CI or host that belongs to the group',
	'Class:lnkAnsibleInventoryGroupToFunctionalCI/Attribute:functionalci_name' => 'CI name',
	'Class:lnkAnsibleInventoryGroupToFunctionalCI/Attribute:functionalci_name+' => '',
	'Class:lnkAnsibleInventoryGroupToFunctionalCI/Attribute:ansibleinventorygroup_id' => 'Inventory Group',
	'Class:lnkAnsibleInventoryGroupToFunctionalCI/Attribute:ansibleinventorygroup_id+' => '',
	'Class:lnkAnsibleInventoryGroupToFunctionalCI/Attribute:ansibleinventorygroup_name' => 'Inventory Group name',
	'Class:lnkAnsibleInventoryGroupToFunctionalCI/Attribute:ansibleinventorygroup_name+' => '',
	'Class:lnkAnsibleInventoryGroupToFunctionalCI/Attribute:tag' => 'Tag',
	'Class:lnkAnsibleInventoryGroupToFunctionalCI/Attribute:tag+' => '',
));

//
// Class: AnsiblePlaybook
//
Dict::Add('EN US', 'English', 'English', array(
	'Class:AnsiblePlaybook' => 'Ansible Playbook',
	'Class:AnsiblePlaybook+' => '',
	'Class:AnsiblePlaybook:baseinfo' => 'General Information',
	'Class:AnsiblePlaybook:operation' => 'Operations',
	'Class:AnsiblePlaybook:scriptinfo' => 'Script',
	'Class:AnsiblePlaybook/Attribute:name' => 'Name',
	'Class:AnsiblePlaybook/Attribute:name+' => 'Name of the Ansible playbook',
	'Class:AnsiblePlaybook/Attribute:ansible_id' => 'Ansible Application',
	'Class:AnsiblePlaybook/Attribute:ansible_id+' => 'Ansible application that the playbook belongs to',
	'Class:AnsiblePlaybook/Attribute:org_id+' => 'Organization that the application belongs to',
	'Class:AnsiblePlaybook/Attribute:status' => 'Status',
	'Class:AnsiblePlaybook/Attribute:status+' => 'Operational status of the playbook',
	'Class:AnsiblePlaybook/Attribute:status/Value:obsolete' => 'Obsolete',
	'Class:AnsiblePlaybook/Attribute:status/Value:production' => 'Production',
	'Class:AnsiblePlaybook/Attribute:status/Value:implementation' => 'Implementation',
	'Class:AnsiblePlaybook/Attribute:recurrent' => 'Recurrent',
	'Class:AnsiblePlaybook/Attribute:recurrent+' => 'Specifies if the playbook must be executed only once or regularly',
	'Class:AnsiblePlaybook/Attribute:recurrent/Value:yes' => 'Yes',
	'Class:AnsiblePlaybook/Attribute:recurrent/Value:no' => 'No',
	'Class:AnsiblePlaybook/Attribute:last_execution_date' => 'Last execution date',
	'Class:AnsiblePlaybook/Attribute:last_execution_date+' => 'Date when the last run took place',
	'Class:AnsiblePlaybook/Attribute:duration' => 'Duration',
	'Class:AnsiblePlaybook/Attribute:duration+' => 'Execution time it took for the application',
	'Class:AnsiblePlaybook/Attribute:script' => 'Script',
	'Class:AnsiblePlaybook/Attribute:script+' => 'Script figuring the playbook',
	'Class:AnsiblePlaybook/Attribute:functionalcis_list' => 'CIs',
	'Class:AnsiblePlaybook/Attribute:functionalcis_list+' => 'Set of CIs that the playbook get executed against to',
));

//
// Class lnkAnsiblePlaybookToFunctionalCI
//
Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkAnsiblePlaybookToFunctionalCI' => 'Link Ansible Playbook / Functional CI',
	'Class:lnkAnsiblePlaybookToFunctionalCI+' => '',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Name' => '%1$s / %2$s',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:functionalci_id' => 'CI',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:functionalci_id+' => 'CI or host against which the playbook will be executed',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:functionalci_name' => 'CI name',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:functionalci_name+' => '',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:ansibleplaybook_id' => 'Playbook',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:ansibleplaybook_id+' => 'Playbook that will be executed on the CI',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:ansibleplaybook_name' => 'Playbook name',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:ansibleplaybook_name+' => '',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:action' => 'Action',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:action+' => 'Defines when the playbook should be executed on the CI',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:action/Value:toschedule' => 'To schedule and execute',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:action/Value:toschedule+' => '',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:action/Value:toexecute' => 'To execute as soon as possible',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:action/Value:toexecute+' => '',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:status' => 'Status',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:status+' => 'Execution status provided by Ansible',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:status/Value:executed' => 'Executed',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:status/Value:executed+' => '',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:status/Value:failed' => 'Failed',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:status/Value:failed+' => '',
));

//
// Menus and messages
//
Dict::Add('EN US', 'English', 'English', array(
	'Menu:ConfigManagement:Ansible' => 'Ansible',
	'Menu:Ansible:General' => 'General',
	'UI:AnsibleInventory:Action:FileDisplay:Menu' => 'Display inventory file',
	'UI:AnsibleInventory:Action:Details:Menu' => 'Details',
	'UI:AnsibleInventory:Action:FileDisplay:PageTitle' => 'Inventory %1$s file',
	'UI:AnsibleInventory:Action:FileDisplay:Title' => 'Inventory file',
	'UI:AnsibleInventory:Action:FileDisplay:Format:ini' => 'Display inventory file in INI format',
	'UI:AnsibleInventory:Action:FileDisplay:Format:yml' => 'Display inventory file in YML format',
	'UI:AnsibleInventoryGroup:Action:New:lnkAnsibleInventoryGroupToFunctionalCI:WrongCIClass' => 'Only Servers, Virtual Machines and Application Solutions can be attached to an inventory group',
	'UI:AnsiblePlaybook:Action:New:lnkAnsiblePlaybookToFunctionalCI:WrongCIClass' => 'Only Servers, Virtual Machines and Application Solutions can be attached to a playbook',
));

