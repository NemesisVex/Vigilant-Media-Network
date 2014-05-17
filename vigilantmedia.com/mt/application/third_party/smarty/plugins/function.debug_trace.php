<?php
function smarty_function_debug_trace($params)
{
	//DebugTrace($params['msg']);
	
	$CI =& get_instance();
	$CI->vigilantecorelib->debug_trace($params['msg'], $params['color']);
}
?>