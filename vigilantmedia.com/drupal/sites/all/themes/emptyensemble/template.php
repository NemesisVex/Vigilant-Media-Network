<?php

function emptyensemble_preprocess_node(&$vars) {
	$vars['submitted'] = '&#8212; Posted by <strong>' . $vars['node']->name . '</strong> on ' . date('F d, Y H:i', $vars['node']->created);
}

function emptyensemble_theme() {
	$theme = array(
		'artist_info' => array(
			'variables' => array(
				'artists' => NULL,
			),
			'template' => 'emptyensemble.artist_info',
		),
		'album_info' => array(
			'variables' => array(
				'albums' => NULL,
			),
			'template' => 'emptyensemble.album_info',
		),
		'track_info' => array(
			'variables' => array(
				'tracks' => NULL,
			),
			'template' => 'emptyensemble.track_info',
		)
	);
	return $theme;
}

?>
