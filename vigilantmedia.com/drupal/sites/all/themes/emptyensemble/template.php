<?php

function emptyensemble_preprocess_node(&$vars) {
	$vars['submitted'] = '&#8212; Posted by <strong>' . $vars['node']->name . '</strong> on ' . date('F d, Y H:i', $vars['node']->created);
}

function emptyensemble_preprocess_page(&$vars) {
	if (arg(0) == 'taxonomy' && arg(1) == 'term' && is_numeric(arg(2))) {
		$tid = arg(2);
		$vars['theme_hook_suggestions'][] = 'page__taxonomy__' . $tid;
	}
}
