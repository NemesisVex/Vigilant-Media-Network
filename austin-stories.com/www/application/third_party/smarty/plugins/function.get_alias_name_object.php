<?php
function smarty_function_get_alias_name_object($params)
{
	$CI =& get_instance();
	$rs = $params['obj'];
	
	$name = $CI->vigilantecorelib->_member_get_alias_name($rs->user_first_name, $rs->user_last_name, $rs->user_login, $rs->user_access_mask, $rs->alias_id, $rs->alias_name);
	return $name;
}
?>