<?php
function smarty_function_get_alias_name($params)
{
	$CI =& get_instance();
	$CI->vigilantecorelib->_member_get_alias_name($params['fname'], $params['lname'], $params['login'], $params['flag'], $params['aliasID'], $params['alias']);
	return $name;
}
?>