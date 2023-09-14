<?php
/**
 * @copyright   Copyright (C) 2023 Combodo SARL
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//
// Class: Ansible
//
Dict::Add('FR FR', 'French', 'Français', array(
	'Class:Ansible' => 'Application Ansible',
	'Class:Ansible+' => '',
	'Class:Ansible:baseinfo' => 'Informations Générales',
	'Class:Ansible:operation' => 'Opérations',
	'Class:Ansible/Attribute:name+' => 'Nom de l\'application Ansible',
	'Class:Ansible/Attribute:org_id+' => 'Organisation à laquelle appartient l\'application',
	'Class:Ansible/Attribute:status' => 'Statut',
	'Class:Ansible/Attribute:status+' => '',
	'Class:Ansible/Attribute:status/Value:obsolete' => 'Obsolète',
	'Class:Ansible/Attribute:status/Value:production' => 'Production',
	'Class:Ansible/Attribute:status/Value:implementation' => 'Implémentation',
	'Class:Ansible/Attribute:location_id' => 'Site',
	'Class:Ansible/Attribute:location_id+' => 'Site ou l\'application est installée',
	'Class:Ansible/Attribute:location_name' => 'Nom du site',
	'Class:Ansible/Attribute:location_name+' => '',
	'Class:Ansible/Attribute:uuid' => 'UUID',
	'Class:Ansible/Attribute:uuid+' => 'Universal Unique Identifier de l\'application',
	'Class:Ansible/Attribute:functionalci_id' => 'CI',
	'Class:Ansible/Attribute:functionalci_id+' => 'CI fonctionel hébergeant l\'application. Ce peut être un server, une machine virtuelle ou une solution applicative',
	'Class:Ansible/Attribute:ansibleinventories_list' => 'Inventaires',
	'Class:Ansible/Attribute:ansibleinventories_list+' => 'Liste de tous les inventaires rattachés à l\'application',
	'Class:Ansible/Attribute:ansibleinventorygroups_list' => 'Groupes d\'inventaires',
	'Class:Ansible/Attribute:ansibleinventorygroups_list+' => 'Liste de tous les groupes d\'inventaires rattachés à l\'application',
));

//
// Class: AnsibleInventory
//
Dict::Add('FR FR', 'French', 'Français', array(
	'Class:AnsibleInventory' => 'Inventaire Ansible',
	'Class:AnsibleInventory+' => '',
	'Class:AnsibleInventory/Attribute:name' => 'Nom',
	'Class:AnsibleInventory/Attribute:name+' => 'Nom de l\'inventaire Ansible',
	'Class:AnsibleInventory/Attribute:ansible_id' => 'Application Ansible',
	'Class:AnsibleInventory/Attribute:ansible_id+' => 'Application Ansible à laquelle l\'inventaire appartient',
	'Class:AnsibleInventory/Attribute:ansible_name' => 'Nom de l\'application Ansible',
	'Class:AnsibleInventory/Attribute:ansible_name+' => '',
	'Class:AnsibleInventory/Attribute:org_id+' => 'Organisation à laquelle appartient l\'inventaire',
	'Class:AnsibleInventory/Attribute:description' => 'Description',
	'Class:AnsibleInventory/Attribute:description+' => '',
	'Class:AnsibleInventory/Attribute:ansibleinventorygroups_list' => 'Groupes d\'inventaires',
	'Class:AnsibleInventory/Attribute:ansibleinventorygroups_list+' => 'Tous les groupes d\'inventaires rattachés à l\'inventaire',
	'Class:AnsibleInventory/Tab:cis_list' => 'CIs',
	'Class:AnsibleInventory/Tab:cis_list+' => 'Liste de tous les CIs appartenant à un groupe d\inventaire lié à l\'inventaire',
));

//
// Class: AnsibleInventoryGroup
//
Dict::Add('FR FR', 'French', 'Français', array(
	'Class:AnsibleInventoryGroup' => 'Groupe d\'inventaire Ansible',
	'Class:AnsibleInventoryGroup+' => '',
	'Class:AnsibleInventoryGroup/Attribute:name' => 'Nom',
	'Class:AnsibleInventoryGroup/Attribute:name+' => 'Nom du groupe d\'inventaire',
	'Class:AnsibleInventoryGroup/Attribute:ansible_id' => 'Application Ansible',
	'Class:AnsibleInventoryGroup/Attribute:ansible_id+' => 'Application Ansible à laquelle appartient le groupe d\'inventaire',
	'Class:AnsibleInventoryGroup/Attribute:ansible_name' => 'Nom de l\'application Ansible',
	'Class:AnsibleInventoryGroup/Attribute:ansible_name+' => '',
	'Class:AnsibleInventoryGroup/Attribute:org_id+' => 'Organisation à laquelle appartient le groupe d\'inventaire',
	'Class:AnsibleInventoryGroup/Attribute:ansibleinventory_id' => 'Inventaire Ansible',
	'Class:AnsibleInventoryGroup/Attribute:ansibleinventory_id+' => 'Inventaire Ansible auquel appartient le groupe',
	'Class:AnsibleInventoryGroup/Attribute:parent_id' => 'Groupe parent',
	'Class:AnsibleInventoryGroup/Attribute:parent_id+' => 'Groupe d\'inventaire parent',
	'Class:AnsibleInventoryGroup/Attribute:parent_name' => 'Nom du groupe parent',
	'Class:AnsibleInventoryGroup/Attribute:parent_name+' => '',
	'Class:AnsibleInventoryGroup/Attribute:description' => 'Description',
	'Class:AnsibleInventoryGroup/Attribute:description+' => '',
	'Class:AnsibleInventoryGroup/Attribute:functionalcis_list' => 'CIs',
	'Class:AnsibleInventoryGroup/Attribute:functionalcis_list+' => 'Liste de tous les CIs liés au groupe',
));

//
// Class lnkAnsibleInventoryGroupToCI
//
Dict::Add('FR FR', 'French', 'Français', array(
	'Class:lnkAnsibleInventoryGroupToCI' => 'Lien groupe d\'inventaire Ansible / CI Fonctionnel',
	'Class:lnkAnsibleInventoryGroupToCI+' => '',
	'Class:lnkAnsibleInventoryGroupToCI/Attribute:functionalci_id' => 'CI',
	'Class:lnkAnsibleInventoryGroupToCI/Attribute:functionalci_id+' => 'CI ou host qui appartient au groupe',
	'Class:lnkAnsibleInventoryGroupToCI/Attribute:functionalci_name' => 'Nom du CI',
	'Class:lnkAnsibleInventoryGroupToCI/Attribute:functionalci_name+' => '',
	'Class:lnkAnsibleInventoryGroupToCI/Attribute:ansibleinventorygroup_id' => 'Groupe d\'inventaire',
	'Class:lnkAnsibleInventoryGroupToCI/Attribute:ansibleinventorygroup_id+' => '',
	'Class:lnkAnsibleInventoryGroupToCI/Attribute:ansibleinventorygroup_name' => 'Nom du groupe d\'inventaire',
	'Class:lnkAnsibleInventoryGroupToCI/Attribute:ansibleinventorygroup_name+' => '',
	'Class:lnkAnsibleInventoryGroupToCI/Attribute:tag' => 'Etiquette',
	'Class:lnkAnsibleInventoryGroupToCI/Attribute:tag+' => '',
));

//
// Menus and messages
//
Dict::Add('FR FR', 'French', 'Français', array(
	'Menu:ConfigManagement:Ansible' => 'Ansible',
	'Menu:Ansible:General' => 'Général',
	'UI:AnsibleInventory:Action:FileDisplay:Menu' => 'Afficher le fichier d\'inventaire',
	'UI:AnsibleInventory:Action:Details:Menu' => 'Détails',
	'UI:AnsibleInventory:Action:FileDisplay:PageTitle' => 'Inventory %1$s file',
	'UI:AnsibleInventory:Action:FileDisplay:Title' => 'Fichier d\'inventaire',
	'UI:AnsibleInventory:Action:FileDisplay:Title:Title_Class_Object' => 'Fichier d\'inventaire pour %1$s %2$s',
	'UI:AnsibleInventory:Action:FileDisplay:Title:PageTitle_Object_Class' => 'Fichier d\'inventaire',
	'UI:AnsibleInventory:Action:FileDisplay:Format:ini' => 'Afficher le fichier d\'inventaire au format INI',
	'UI:AnsibleInventory:Action:FileDisplay:Format:yml' => 'Afficher le fichier d\'inventaire au format YML',
	'UI:AnsibleInventoryGroup:Action:New:lnkAnsibleInventoryGroupToCI:WrongCIClass' => 'Seules les classes de CIs suivantes peuvent être rattachés à un groupe d\'inventaire: %1$s',
));

