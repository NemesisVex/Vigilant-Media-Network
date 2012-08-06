<?php

/**
 * @file
 * Administration page callbacks for the Observant Records module. 
 */

/*
 * 
function observantrecords_admin_settings() {
	$options = array();
	$form = array();
	$types = node_type_get_types();
	
	foreach ($types as $node_type) {
		$options[$node_type] = $node_type->name;
	}
	
	$form['observantrecords_node_types'] = array(
		'#type' => 'checkboxes',
		'#title' => t('Connect to an Observant Records release'),
		'#options' => $options,
		'#default_value' => variable_get(array('page')),
		'#description' => t('Something or other.'),
	);
	
	$form['#submit'][] = 'observantrecords_admin_settings_submit';
	return system_settings_form($form, TRUE);
}

function observantrecords_admin_settings_submit($form, $form_state) {
	foreach ($form_state['values']['observantrecords_node_types'] as $key => $value) {
		if (!$value) {
			$instance = field_info_instance('node', 'observant_records_connection', $key);
			if (!empty($instance)) {
				field_delete_instance($instance, FALSE);
				watchdog('Observant Records Connection', 'Deleted Observant Records connection from content type: %key', array('%key' => $key));
			}
		} else {
			$instance = field_info_instance('node', 'observant_records_connection', $key);
			if (empty($instance)) {
				$instance = array(
					'field_name' => 'observant_records_connection',
					'entity_type' => 'node',
					'bundle' => $key,
					'label' => t('Observant Records Connection'),
					'widget_type' => 'text_textarea_with_summary',
					'settings' => array('display_summary' => TRUE),
					'display' => array(
						'default' => array(
							'type' => 'text_default',
						),
						'teaser' => array(
							'type' => 'text_summary_or_trimmed',
						)
					),
				);
			}
			$instance = field_create_instance($instance);
			watchdog('Observant Records Connection', 'Added Observant Records connection from content type: %key', array('%key' => $key));
		}
	}
}
 */
