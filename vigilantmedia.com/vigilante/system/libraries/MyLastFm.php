<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * MyLastFm
 *
 * 
 * @package CodeIgniter
 * @subpackage Vigilant Media Network
 * @category Libraries
 * @author Greg Bueno
 * @copyright (c) 2012 Greg Bueno
 */
class MyLastFm
{
	var $CI;
	var $request_uri = 'http://ws.audioscrobbler.com/2.0/?';
	var $results;
	var $api_key = LASTFM_API_KEY;
	
	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('MyCacheRestRequest');
		return;
	}
	
	function build_request_uri($method, $params)
	{
		$query_array = array();

		$query_array['method'] = $method;
		$query_array['api_key'] = $this->api_key;
		$query_array = array_merge($query_array, $params);
		$query_string = http_build_query($query_array);
		$this->request_uri .= $query_string;
	}
	
	function send_request($request_uri)
	{
		$curl_opts = array();
		
		$results = $this->CI->mycacherestrequest->get($request_uri, '', $curl_opts);
		$this->results = simplexml_load_string($results);
		//print_r($this->results);
	}
	
	function send_query($method, $params)
	{
		$this->build_request_uri($method, $params);
		//$this->CI->vigilantecorelib->debug_trace($this->request_uri);
		$this->send_request($this->request_uri);
	}
	
	function album_get_info($album = '', $artist = '', $mb_gid = '')
	{
		$params = array();

		if (!empty($album)) {$params['album'] = $album;}
		if (!empty($artist)) {$params['artist'] = $artist;}
		if (!empty($mb_gid)) {$params['mbid'] = $mb_gid;}
		$this->send_query('album.getInfo', $params);
	}
}

?>