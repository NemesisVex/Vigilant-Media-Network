<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * VigilanteCoreLib
 *
 * 
 * @package CodeIgniter
 * @subpackage Vigilant Media Network
 * @category Libraries
 * @author Greg Bueno
 * @copyright (c) 2012 Greg Bueno
 */
class VigilanteCoreLib
{
	function __construct()
	{
		$this->CI =& get_instance();
	}
	
	function debug_trace($msg = '', $color = '#F00')
	{
		echo '<span style="color: ' . $color . ';">DEBUG: ' . $msg . '</span><br>' . "\n";
	}
	
	function catch_message($msg = '', $color = '#00F')
	{
		echo '<span style="color: ' . $color . ';">' . $msg . '</span><br>' . "\n";
	}
	
	function catch_error($msg = '', $color = '#F00')
	{
		echo '<span style="color: ' . $color . ';">' . $msg . '</span><br>' . "\n";
	}
	
	function parse_line_breaks($txt)
	{
		$this->CI =& get_instance();
		
		$text = trim($txt);
		/*
		$text = preg_replace("/(?:^|(?:\x0d\x0a){2,}|\x0a{2,}|\x0d{2,})(.+?)(?=(?:(\x0d\x0a){2,}|\x0d{2,}|\x0a{2,}|$))/s","<p>$1</p>",$text);
		$text = preg_replace("/(?:^|(?:\x0d\x0a){1,}|\x0a{1,}|\x0d{1,})(.+?)(?=(?:(\x0d\x0a){1,}|\x0d{1,}|\x0a{1,}|$))/s","$1<br/>",$text);
		$text = preg_replace("/<\/p><br\/>/","</p>",$text);
		$text = preg_replace("/<br\/>/","<br/>\n",$text);
		$text = preg_replace("/<\/p>/","</p>\n\n",$text);
		*/
		$paras = preg_split("/\r?\n\r?\n/", $text);
		foreach ($paras as $i => $p)
		{
			if (!preg_match("/^<(?:table|ol|ul|pre|select|form|blockquote|div|q|hr)/", $p))
			{
				$p = preg_replace("/\r?\n/", "<br />\n", $p);
				$p = "<p>$p</p>";
				$ntxt[] = $p;
			}
			else
			{
				$ntxt[] = $p;
			}
		}
		$text = implode("\n\n", $ntxt);
		return $text;
	}
	
	function format_artist_name($last_name, $first_name, $asian_mask = '', $escape = true)
	{
		if (empty($first_name))
		{
			$str = $last_name;
		}
		else
		{
			$str = ($asian_mask & 2)==2 ? $last_name . " " . $first_name : $first_name . " " . $last_name;
		}

		$escaped_str = htmlentities($str, ENT_COMPAT, "UTF-8");
		$return_str = $escape == false ? $str : $escaped_str;

		return $return_str;
	}
	
	function format_artist_name_object($rs, $escape = true)
	{
		$artist_settings_mask = !empty($rs->artist_settings_mask) ? $rs->artist_settings_mask : null;
		return $this->format_artist_name($rs->artist_last_name, $rs->artist_first_name, $artist_settings_mask, $escape);
	}
	
	function format_film_title($title, $prefix)
	{
		$str = !empty($prefix) ? $prefix . " " . $title : $title;
		return $str;
	}
	
	function format_film_title_object($rs)
	{
		return $this->format_film_title($rs->film_title, $rs->film_title_prefix);
	}
	
	function log_action($msg, $user_id = '')
	{
		if (!empty($_SESSION['user_id']))
		{
			$input['log_user_id'] = !empty($user_id) ? $user_id : $_SESSION['user_id'];
		}
		$input['log_message'] = $msg;
		$input['log_ip'] = $_SERVER['REMOTE_ADDR'];
		$input['log_date_added'] = date("Y-m-d H:i:s");
		
		$this->CI->db->insert('vm_users_log', $input);
	}
	
	function email($to, $hidden_fields, $shown_fields, $site_name, $redirect)
	{
		$this->CI =& get_instance();
		$send_mail = true;
		
		foreach ($hidden_fields as $hidden_field)
		{
			$check_field = $this->CI->input->get_post($hidden_field);
			if (!empty($check_field))
			{
				$send_mail = false;
				header('Location: ' . $_SERVER['HTTP_REFERER']);
				die();
			}
		}
		
		if ($send_mail == true)
		{
			foreach ($shown_fields as $var => $value)
			{
				$$var = stripslashes($this->CI->input->get_post($value));
			}
			
			$message .= "\n\n";
			$message .= "-----------------------------\n";
			if (!empty($_SERVER['REMOTE_HOST'])) {$message .= "REMOTE_HOST: " . $_SERVER['REMOTE_HOST'] . "\n";}
			$message .= "REMOTE_ADDR: " . $_SERVER['REMOTE_ADDR'] . "\n";
			$message .= "HTTP_USER_AGENT: " . $_SERVER['HTTP_USER_AGENT'] . "\n";
			
			$subject_prefix = $site_name . ': feedback';
			$subject = (empty($subject)) ? $subject_prefix : $subject_prefix . ': ' . $subject;
			
			$mail_config['protocol'] = 'mail';
			$mail_config['mailpath'] = '/usr/bin/mail';
			$mail_config['charset'] = 'utf-8';
			$mail_config['wordwrap'] = true;
			
			$this->CI->email->initialize($mail_config);
			
			$this->CI->email->from($email, $realname);
			$this->CI->email->to($to);
			
			$this->CI->email->subject($subject);
			$this->CI->email->message($message);
			
			if (false !== $this->CI->email->send())
			{
				header('Location: ' . $redirect);
				die();
			}
			
			echo $this->CI->email->print_debugger();
		}
	}
	
	// Private methods
	function _check_mask($arrBitmask, $value, $returnValue = NULL)
	{
		$this->CI =& get_instance();
		
		$setting = false;
		foreach ($arrBitmask as $bitmask => $bitmaskValue)
		{
			if ((intval($bitmask) & intval($value)) == intval($bitmask))
			{
				switch ($returnValue)
				{
					case "value":
						$setting = $bitmaskValue;
						break;
					case "bitmask":
						$setting = $bitmask;
						break;
					default:
						$setting = true;
				}
				break;
			}
		}
		return $setting;
	}
	
	function _member_get_alias_name($first_name, $last_name, $login, $flag, $alias_id, $alias)
	{
		$name = !empty($alias_id) ? $alias : $this->_member_get_display_name($first_name, $last_name, $login, $flag);
		return $name;
	}
	
	function _member_get_display_name($first_name, $last_name, $login, $flag)
	{
		$name = '';
		//obscure logins with e-mail addresses
		if (preg_match('/(.*)\@(.*)\.[a-z]{3}/', $login))
		{
			$login = preg_replace('/\@/', ' AT ', $login);
			$login = preg_replace('/\./', ' DOT ', $login);
		}
		if ((intval($flag) & 2)==2)
		{
			if (!empty($first_name)) {$name .= $first_name;}
			if (!empty($first_name) && !empty($last_name)) {$name .= ' ';}
			if (!empty($last_name)) {$name .= $last_name;}
		}
		else
		{
			$name = $login;
		}
		return $name;
	}
	
}
?>