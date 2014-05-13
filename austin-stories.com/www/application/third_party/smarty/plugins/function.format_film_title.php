<?php
function smarty_function_format_film_title($params)
{
	$CI =& get_instance();
	$name = $CI->vigilantecorelib->format_film_title($params['title'], $params['prefix']);
	return $name;
}
?>