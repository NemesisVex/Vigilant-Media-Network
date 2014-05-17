<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * MyMusicbrainz
 *
 * 
 * @package CodeIgniter
 * @subpackage Vigilant Media Network
 * @category Libraries
 * @author Greg Bueno
 * @copyright (c) 2012 Greg Bueno
 */
class MyMusicbrainz
{
	var $CI;
	var $request_uri = 'http://musicbrainz.org/ws/1';
	var $results;
	
	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('MyCacheRestRequest');

		return;
	}
	
	function build_request_uri($search_type, $params, $limit = '', $offset = '', $type = 'xml')
	{
		$this->request_uri .= '/' . $search_type . '/';
		$this->request_uri .= '?type=' . $type;
		
		if (!empty($params))
		{
			$encoded_params = $this->_encode_parameters($params);
			$this->request_uri .= '&' . http_build_query($encoded_params);
		}
		if (!empty($limit)) {$this->request_uri .= '&limit=' . $limit;}
		if (!empty($offset)) {$this->request_uri .= '&offset=' . $offset;}
	}

	function build_id_request_uri($search_type, $gid, $inc = '', $limit = '', $offset = '', $type = 'xml')
	{
		$this->request_uri .= '/' . $search_type . '/';
		$this->request_uri .= $gid;
		$this->request_uri .= '?type=' . $type;

		if (!empty($inc)) {$this->request_uri .= '&inc=' . $inc;}
		if (!empty($limit)) {$this->request_uri .= '&limit=' . $limit;}
		if (!empty($offset)) {$this->request_uri .= '&offset=' . $offset;}
	}
	
	function send_request($request_uri)
	{
		$results = $this->CI->mycacherestrequest->get($request_uri);
		if (!empty($results))
		{
			$this->results = simplexml_load_string($results);
		}
	}
	
	function send_query($search_type, $params, $limit = '', $offset = '')
	{
		$this->build_request_uri($search_type, $params, $limit, $offset);
		$this->send_request($this->request_uri);
	}
	
	function send_query_by_id($search_type, $gid, $inc = '', $limit = '', $offset = '')
	{
		$this->build_id_request_uri($search_type, $gid, $inc, $limit, $offset);
		$this->send_request($this->request_uri);
	}
	
	function query_artist($params, $limit = '', $offset = '')
	{
		$this->send_query('artist', $params, $limit, $offset);
	}
	
	function query_release($params, $limit = '', $offset = '')
	{
		$this->send_query('release', $params, $limit, $offset);
	}
	
	function query_release_group($params, $limit = '', $offset = '')
	{
		$this->send_query('release-group', $params, $limit, $offset);
	}

	function query_track($params, $limit = '', $offset = '')
	{
		$this->send_query('track', $params, $limit, $offset);
	}
	
	function query_label($params, $limit = '', $offset = '')
	{
		$this->send_query('label', $params, $limit, $offset);
	}

	function query_tag($params, $limit = '', $offset = '')
	{
		$this->send_query('tag', $params, $limit, $offset);
	}

	function query_rating($params, $limit = '', $offset = '')
	{
		$this->send_query('rating', $params, $limit, $offset);
	}
	
	function get_artist_by_id($gid, $inc = '', $limit = '', $offset = '')
	{
		$this->send_query_by_id('artist', $gid, urlencode($inc), $limit, $offset);
	}
	
	function get_release_by_id($gid, $inc = '', $limit = '', $offset = '')
	{
		$this->send_query_by_id('release', $gid, urlencode($inc), $limit, $offset);
	}
	
	function get_release_group_by_id($gid, $inc = '', $limit = '', $offset = '')
	{
		$this->send_query_by_id('release-group', $gid, urlencode($inc), $limit, $offset);
	}

	function get_track_by_id($gid, $inc = '', $limit = '', $offset = '')
	{
		$this->send_query_by_id('track', $gid, urlencode($inc), $limit, $offset);
	}

	function get_label_by_id($gid, $inc = '', $limit = '', $offset = '')
	{
		$this->send_query_by_id('label', $gid, urlencode($inc), $limit, $offset);
	}

	function _encode_parameters($params)
	{
		if (!empty($params))
		{
			foreach ($params as $key => $value)
			{
				$params[$key] = urlencode($value);
			}
		}
		return $params;
	}
}

?>
