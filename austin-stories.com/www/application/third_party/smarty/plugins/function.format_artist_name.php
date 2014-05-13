<?php
function smarty_function_format_artist_name($params)
{
	$CI =& get_instance();
	$name = $CI->vigilantecorelib->format_artist_name($params['lname'], $params['fname'], $params['asian']);
	return $name;
}
?>