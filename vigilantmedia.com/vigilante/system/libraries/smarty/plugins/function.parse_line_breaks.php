<?php
function smarty_function_parse_line_breaks($params)
{
	$CI =& get_instance();
	$txt = $CI->vigilantecorelib->parse_line_breaks($params["txt"]);
	return $txt;
}
?>