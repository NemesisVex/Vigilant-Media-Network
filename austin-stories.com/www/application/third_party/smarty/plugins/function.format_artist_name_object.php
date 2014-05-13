<?php
function smarty_function_format_artist_name_object($params)
{
	$CI =& get_instance();
	$rs = $params["obj"];
	
	$name = $CI->vigilantecorelib->format_artist_name($rs->artist_last_name, $rs->artist_first_name, $rs->artist_settings_mask);
	return $name;
}
?>