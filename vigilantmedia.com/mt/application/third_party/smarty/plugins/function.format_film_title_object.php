<?php
function smarty_function_format_film_title_object($params)
{
	$CI =& get_instance();
	$rs = $params["obj"];
	
	$name = $CI->vigilantecorelib->format_film_title($rs->film_title, $rs->film_title_prefix);
	return $name;
}
?>