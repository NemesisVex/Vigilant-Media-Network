<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * MyCacheRestRequest
 *
 * 
 * @package CodeIgniter
 * @subpackage Vigilant Media Network
 * @category Libraries
 * @author Greg Bueno
 * @copyright (c) 2012 Greg Bueno
 */
class MyCacheRestRequest
{
	var $CI;
	var $base_cache = 'cache';
	var $cache_path;
	var $max_age = 86400;
	var $results;
	
	function __construct($path = '', $age = '')
	{
		$this->CI =& get_instance();
		$this->CI->load->library('unit_test');

			$this->cache_path = !empty($path) ? $path : APPPATH . $this->base_cache;

		if (!empty($age))
		{
			$this->max_age = $age;
		}
	}

	function get($url, $file_name = '', $curl_opts = '')
	{
		$cache_path = empty($file_name) ? $this->_get_file_name($url) : $this->cache_path . '/' . $file_name;

		if (false !== ($cache_status = $this->_check_cache($cache_path)))
		{
			if (false !== ($age = $this->_check_cache_age($cache_path)))
			{
				if ($this->max_age > $age)
				{
					$results = $this->_get_cache($cache_path);
				}
				else
				{
					if (false !== ($results = $this->_send_request($url, $curl_opts)))
					{
						$this->_set_cache($cache_path, $results);
					}
				}
				return $results;
			}
		}
		else
		{
			if (false !== ($results = $this->_send_request($url, $curl_opts)))
			{
				$this->_set_cache($cache_path, $results);
				return $results;
			}
		}

		return false;
	}

	// Private methods

	function _check_cache($cache_path)
	{
		if (false !== file_exists($cache_path))
		{
			$mod_time = filemtime($cache_path);
			$age = time() - $mod_time;

			if ($this->max_age > $age)
			{
				return true;
			}
		}

		return false;
	}

	function _check_cache_age($file_name)
	{
		if (false !== file_exists($file_name))
		{
			$modified_time = filemtime($file_name);
			$age = time() - $modified_time;
			return $age;
		}
		return false;
	}

	function _get_file_name($url)
	{
		$file_name = md5($url);
		$file_path = $this->cache_path . '/' . $file_name;
		return $file_path;
	}

	function _get_cache($cache_path)
	{
		if (false !== file_exists($cache_path))
		{
			if (false !== ($fp = fopen($cache_path, 'r')))
			{
				$data = fread($fp, filesize($cache_path));
				fclose($fp);

				return $data;
			}
		}

		return false;
	}

	function _set_cache($file_name, $data)
	{
		if (!empty($data))
		{
			if (false !== ($fp = fopen($file_name, 'w')))
			{
				fwrite($fp, $data);
				fclose($fp);

				return true;
			}
		}

		return false;
	}

	function _send_request($url, $curl_opts = '')
	{
		$session = curl_init($url);
		curl_setopt($session, CURLOPT_HEADER, false);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

		if (!empty($curl_opts))
		{
			foreach ($curl_opts as $curl_option => $curl_value)
			{
				eval("curl_setopt(\$session, $curl_option, '$curl_value');");
			}
		}

		$response = curl_exec($session);
		curl_close($session);

		return $response;
	}

  }
?>