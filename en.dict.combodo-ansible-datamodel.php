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
	'Class:Ansible/Attribute:playbooks_list' => 'Playbooks',
	'Class:Ansible/Attribute:playbooks_list+' => 'List of all playbooks attached to the application',
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
	'Class:AnsiblePlaybook/Attribute:functionalcis_list' => 'Hosts',
	'Class:AnsiblePlaybook/Attribute:functionalcis_list+' => 'Set of hosts that the playbook get executed against to',
));

//
// Class lnkAnsiblePlaybookToFunctionalCI
//
Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkAnsiblePlaybookToFunctionalCI' => 'Link Ansible Playbook / Functional CI',
	'Class:lnkAnsiblePlaybookToFunctionalCI+' => '',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Name' => '%1$s / %2$s',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:functionalci_id' => 'Host',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:functionalci_id+' => 'Host or device against which the playbook will be executed',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:functionalci_name' => 'Host name',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:functionalci_name+' => '',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:ansibleplaybook_id' => 'Playbook',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:ansibleplaybook_id+' => 'Paybook that will be executed on the host',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:ansibleplaybook_name' => 'Playbook name',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:ansibleplaybook_name+' => '',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:action' => 'Action',
	'Class:lnkAnsiblePlaybookToFunctionalCI/Attribute:action+' => 'Defines when the playbook should be executed on the host',
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

