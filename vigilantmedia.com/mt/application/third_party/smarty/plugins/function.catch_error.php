<?php
function smarty_function_catch_error($params)
{
	//CatchError($params['error']);
	
	$CI =& get_instance();
	$CI->vigilantecorelib->catch_error($params['error'], $params['color']);
}
?>