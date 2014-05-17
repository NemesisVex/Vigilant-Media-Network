<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * MyAmazon
 *
 * 
 * @package CodeIgniter
 * @subpackage Vigilant Media Network
 * @category Libraries
 * @author Greg Bueno
 * @copyright (c) 2012 Greg Bueno
 */
class MyAmazon
{
	var $CI;
	var $secret_access_key;
	var $associate_tag;
	var $locale;
	var $uri_base;
	var $request_uri;
	var $auth_request_uri;
	var $results;

	var $associate_tags = array('us' => 'musicwhore-20',
						  'jp' => 'musicwhore-22',
						  'uk' => 'musicwhore-21',
						  'de' => 'webservices-20',
						  'ca' => 'webservices-20',
						  'fr' => 'webservices-20');
	var $uri_bases = array('us' => 'http://ecs.amazonaws.com/onca/xml?Service=AWSECommerceService',
						  'jp' => 'http://ecs.amazonaws.jp/onca/xml?Service=AWSECommerceService',
						  'uk' => 'http://ecs.amazonaws.co.uk/onca/xml?Service=AWSECommerceService',
						  'de' => 'http://ecs.amazonaws.de/onca/xml?Service=AWSECommerceService',
						  'ca' => 'http://ecs.amazonaws.ca/onca/xml?Service=AWSECommerceService',
						  'fr' => 'http://ecs.amazonaws.fr/onca/xml?Service=AWSECommerceService');
	var $amazon_locale = array('us' => array('astore' => 'astore.amazon.com', 'domain' => 'www.amazon.com', 'associateID' => 'musicwhoreorg-20', 'country' => 'United States'),
							   'jp' => array('astore' => 'astore.amazon.co.jp', 'domain' => 'www.amazon.co.jp', 'associateID' => 'musicwhoreorg-22', 'country' => 'Japan'),
							   'uk' => array('domain' => 'www.amazon.co.uk', 'associateID' => 'musicwhoreorg-21', 'country' => 'United Kingdom'),
							   'de' => array('domain' => 'www.amazon.de', 'associateID' => 'webservices-20', 'country' => 'Germany'),
							   'ca' => array('domain' => 'www.amazon.ca', 'associateID' => 'webservices-20', 'country' => 'Canada'),
							   'fr' => array('domain' => 'www.amazon.fr', 'associateID' => 'webservices-20', 'country' => 'France'));

	function __construct($locale = 'us', $id = SUBSCRIBER_ID, $id_type = 'SubscriptionId')
	{
		$this->CI =& get_instance();
		$this->CI->load->library('MyCacheRestRequest');

		$args = func_get_args();
		$secret_key = !empty($args[3]) ? $args[3] : NULL;

		$this->locale = $locale;
		$this->uri_base = $this->uri_bases[$locale];
		if (!empty($secret_key)) {$this->secret_access_key = $secret_key;}

		$request_uri = $this->uri_base;

		switch ($id_type)
		{
			case 'AccessKey':
				$request_uri .= '&AWSAccessKeyId=' . $id;
			case 'SubscriptionId':
				$request_uri .= '&SubscriptionId=' . $id;
		}

		$this->request_uri = $request_uri;
	}

	function build_request_uri($operation, $params)
	{
		$this->associate_tag = $this->associate_tags[$this->locale];
		$request_uri = '&';
		$params['AssociateTag'] = $this->associate_tag;
		$params['Operation'] = $operation;
		$request_uri .= http_build_query($params);
		$this->request_uri .= $request_uri;
	}

	function send_request($request_uri)
	{
		$auth_request_uri = $this->auth_get_request(SECRET_ACCESS_KEY, $request_uri, ACCESS_KEY_ID);
		$results = $this->CI->mycacherestrequest->get($auth_request_uri, md5($request_uri));
		$this->results = simplexml_load_string($results);
		$this->auth_request_uri = $auth_request_uri;
	}

	function item_search($searchIndex='Music', $keywords)
	{
		$args = func_get_args();
		$more_params = !empty($args[2]) ? $args[2] : NULL;

		$params['SearchIndex'] = $searchIndex;
		$params['Keywords'] = $keywords;
		if (!empty($more_params)) {$params = array_merge($params, $more_params);}

		$this->build_request_uri('ItemSearch', $params);
		$this->send_request($this->request_uri);
		return $this->results;
	}

	function item_lookup($item_id)
	{
		$args = func_get_args();
		$more_params = !empty($args[1]) ? $args[1] : NULL;

		$params['ItemId'] = $item_id;
		if (!empty($more_params)) {$params = array_merge($params, $more_params);}

		$this->build_request_uri('ItemLookup', $params);
		$this->send_request($this->request_uri);
		return $this->results;
	}

	function build_amazon_url($asin, $locale = 'us', $type = 'domain')
	{
		$amazon_url = 'http://' . $this->amazon_locale[$locale][$type];
		switch ($type)
		{
			case 'astore':
				$amazon_url .= '/' . $this->associate_tags[$locale] . '/detail/' . $asin;
				break;
			case 'domain':
				$amazon_url .= '/exec/obidos/ASIN/' . $asin . '/detail/' . $this->associate_tags[$locale];
				break;
		}
		return $amazon_url;
	}

	function auth_get_request($secret_key, $request, $access_key_id="", $version="2009-03-01")
	{
		// Get host and url
		$url = parse_url($request);

		// Get Parameters of request
		$request = $url['query'];
		$parameters = array();
		parse_str($request, $parameters);
		$parameters["Timestamp"] = gmdate("Y-m-d\TH:i:s\Z");
		$parameters["Version"] = $version;
		if ($access_key_id != '') $parameters["AWSAccessKeyId"] = $access_key_id;

		// Sort paramters
		ksort($parameters);

		// re-build the request
		$request = array();
		foreach ($parameters as $parameter=>$value)
		{
			$parameter = str_replace("%7E", "~", rawurlencode($parameter));
			$value = str_replace("%7E", "~", rawurlencode($value));
			$request[] = $parameter . "=" . $value;
		}
		$request = implode("&", $request);

		$signature_string = "GET" . chr(10) . $url['host'] . chr(10) . $url['path'] . chr(10) . $request;

		$signature = urlencode(base64_encode(hash_hmac("sha256", $signature_string, $secret_key, true)));

		$request = "http://" . $url['host'] . $url['path'] . "?" . $request . "&Signature=" . $signature;

		return $request;
	}

	function hmac($key, $data, $hashfunc='sha256')
	{
		$blocksize=64;

		if (strlen($key) > $blocksize) $key=pack('H*', $hashfunc($key));
		$key=str_pad($key, $blocksize, chr(0x00));
		$ipad=str_repeat(chr(0x36), $blocksize);
		$opad=str_repeat(chr(0x5c), $blocksize);
		$hmac = pack('H*', $hashfunc(($key^$opad) . pack('H*', $hashfunc(($key^$ipad) . $data))));
		return $hmac;
	}
  }
?>