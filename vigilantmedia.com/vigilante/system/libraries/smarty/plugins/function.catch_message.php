<?php
function smarty_function_catch_message($params)
{
	//CatchMessage($params['msg']);
	
	$CI =& get_instance();
	$CI->vigilantecorelib->catch_message($params['msg'], $params['color']);
}
?>