<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * MyDiscogs
 *
 * 
 * @package CodeIgniter
 * @subpackage Vigilant Media Network
 * @category Libraries
 * @author Greg Bueno
 * @copyright (c) 2012 Greg Bueno
 */
class MyDiscogs
{
	var $CI;
	var $request_uri = 'http://www.discogs.com';
	var $results;
	var $api_key = DISCOGS_API_KEY;
	
	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('MyCacheRestRequest');
		return;
	}
	
	function build_request_uri($search_string, $search_type = '')
	{
		$query_array = array();

		switch ($search_type)
		{
			case 'artist':
				$this->request_uri .= '/artist/';
				break;
			case 'release':
				$this->request_uri .= '/release/';
				break;
			case 'track':
				$this->request_uri .= '/track/';
				break;
			default:
				$this->request_uri .= '/search/';
				$query_array['type'] = 'all';
				$query_array['q'] = 'a-f';
		}
		$query_array['f'] = 'xml';
		$query_array['api_key'] = DISCOGS_API_KEY;
		$query_string = http_build_query($query_array);
		
		$this->request_uri .= $search_string;
		$this->request_uri .= '?' . $query_string;
	}
	
	function send_request($request_uri)
	{
		$curl_opts = array();
		$curl_opts['CURLOPT_ENCODING'] = 'gzip, deflate';

		$results = $this->CI->mycacherestrequest->get($request_uri, '', $curl_opts);
		$this->results = simplexml_load_string($results);
		//print_r($this->results);
	}
	
	function send_query($string, $search_type = '')
	{
		$this->build_request_uri($string, $search_type);
		//$this->CI->vigilantecorelib->debug_trace($this->request_uri);
		$this->send_request($this->request_uri);
	}
	
	function query_artist($string)
	{
		$this->send_query(urlencode($string), 'artist');
	}
	
	function query_release($string)
	{
		$this->send_query(urlencode($string), 'release');
	}
	
	function query_track($string)
	{
		$this->send_query(urlencode($string), 'track');
	}
}

?>