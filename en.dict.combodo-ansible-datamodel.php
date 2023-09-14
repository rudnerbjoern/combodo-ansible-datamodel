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
	'Class:Ansible/Attribute:ansibleinventories_list' => 'Inventories',
	'Class:Ansible/Attribute:ansibleinventories_list+' => 'List of all inventories attached to the application',
	'Class:Ansible/Attribute:ansibleinventorygroups_list' => 'Inventory groups',
	'Class:Ansible/Attribute:ansibleinventorygroups_list+' => 'List of all inventory groups attached to the application',
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
	'Class:AnsibleInventory/Tab:cis_list' => 'CIs',
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
// Class lnkAnsibleInventoryGroupToCI
//
Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkAnsibleInventoryGroupToCI' => 'Link Ansible Inventory Group / Functional CI',
	'Class:lnkAnsibleInventoryGroupToCI+' => '',
	'Class:lnkAnsibleInventoryGroupToCI/Name' => '%1$s / %2$s',
	'Class:lnkAnsibleInventoryGroupToCI/Attribute:functionalci_id' => 'CI',
	'Class:lnkAnsibleInventoryGroupToCI/Attribute:functionalci_id+' => 'CI or host that belongs to the group',
	'Class:lnkAnsibleInventoryGroupToCI/Attribute:functionalci_name' => 'CI name',
	'Class:lnkAnsibleInventoryGroupToCI/Attribute:functionalci_name+' => '',
	'Class:lnkAnsibleInventoryGroupToCI/Attribute:ansibleinventorygroup_id' => 'Inventory Group',
	'Class:lnkAnsibleInventoryGroupToCI/Attribute:ansibleinventorygroup_id+' => '',
	'Class:lnkAnsibleInventoryGroupToCI/Attribute:ansibleinventorygroup_name' => 'Inventory Group name',
	'Class:lnkAnsibleInventoryGroupToCI/Attribute:ansibleinventorygroup_name+' => '',
	'Class:lnkAnsibleInventoryGroupToCI/Attribute:tag' => 'Tag',
	'Class:lnkAnsibleInventoryGroupToCI/Attribute:tag+' => '',
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
	'UI:AnsibleInventory:Action:FileDisplay:Title:Title_Class_Object' => 'Inventory file for %1$s %2$s',
	'UI:AnsibleInventory:Action:FileDisplay:Title:PageTitle_Object_Class' => 'Inventory file',
	'UI:AnsibleInventory:Action:FileDisplay:Format:ini' => 'Display inventory file in INI format',
	'UI:AnsibleInventory:Action:FileDisplay:Format:yml' => 'Display inventory file in YML format',
	'UI:AnsibleInventoryGroup:Action:New:lnkAnsibleInventoryGroupToCI:WrongCIClass' => 'Only the following classes of CIs can be attached to an inventory group: %1$s',
));

