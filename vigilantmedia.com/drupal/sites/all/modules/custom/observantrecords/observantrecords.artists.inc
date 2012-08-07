<?php

/**
 *
 * @file
 * Connect to Observant Records database and return an autocomplete widget populated
 * by Observant Records artists.
 *  
 */

function observantrecords_artists_field_info() {
	$field_info = array(
		'observant_artists_term_reference' => array(
			'label' => t('Observant Records Artist Term Reference'),
			'description' => t('This field stores a reference to an Observant Records artist term.'),
			'default_widget' => 'options_select',
			'default_formatter' => 'taxonomy_term_reference_link',
		),
	);
	return $field_info;
}

function observantrecords_artists_field_widget_info() {
	$artist_widget = array(
		'observant_artists_taxonomy' => array(
			'label' => t('Autocomplete artist widget'),
			'field_types' => array('observant_artists_term_reference'),
			'settings' => array(
				'size' => 60,
				'autocomplete_path' => 'taxonomy/autocomplete',
			),
			'behaviors' => array(
				'multiple_values' => FIELD_DEFAULT_CUSTOM,
			),
		),
	);
	return $artist_widget;
}