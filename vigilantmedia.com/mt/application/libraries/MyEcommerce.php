<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * MyEcommerce
 *
 * 
 * @package CodeIgniter
 * @subpackage Vigilant Media Network
 * @category Libraries
 * @author Greg Bueno
 * @copyright (c) 2012 Greg Bueno
 */
class MyEcommerce
{
	var $locale;
	var $merchant_id_cdjapan = 3;
	var $merchant_id_yesasia = 4;
	var $merchant_id_itunes = 7;
	
	var $itunes_locale = array('us' => 143441, 'jp' => 143462);
	var $itunes_uri_base = 'http://click.linksynergy.com/fs-bin/stat?id=Lql4T6lMbD0&amp;offerid=78941&amp;type=3&amp;subid=0&amp;tmpid=1826&amp;RD_PARM1=';
	var $itunes_uri_base_artist;
	var $itunes_uri_base_album;
	var $itunes_uri_tail;
	
	var $yesasia_uri_base = 'http://us.yesasia.com/assocred.asp';
	
	var $cdjapan_uri_base = 'http://www.cdjapan.co.jp/detailview.html?KEY=';
	
	function __construct($locale = 'us')
	{
		$this->locale = $locale;
		
		$this->itunes_uri_base_artist =  $this->itunes_uri_base . rawurlencode(rawurlencode('http://phobos.apple.com/WebObjects/MZStore.woa/wa/viewArtist?'));
		$this->itunes_uri_base_album = $this->itunes_uri_base . rawurlencode(rawurlencode('http://phobos.apple.com/WebObjects/MZStore.woa/wa/viewAlbum?'));
		$this->itunes_uri_tail = rawurlencode('&partnerId=30');
		
		$this->yesasia_uri_base .= '?' . YESASIA_ID . '+';
	}
	
	function build_itunes_album_url($playlistId, $selectedItemId = '', $locale)
	{
		$itunes_url = $this->itunes_uri_base_album;
		$itunes_url .= rawurlencode(rawurlencode('&playlistId=' . $playlistId));
		if (!empty($selectedItemId)) {$itunes_url .= rawurlencode(rawurlencode('&selectedItemId=' . $selectedItemId));}
		$itunes_url .= rawurlencode(rawurlencode('&originStoreFront=' . $this->itunes_locale[$locale]));
		$itunes_url .= $this->itunes_uri_tail;
		
		return $itunes_url;
	}
	
	function build_itunes_artist_url($id)
	{
		$itunes_url = $this->itunes_uri_base_artist;
		$itunes_url .= rawurlencode(rawurlencode('&id=' . $id));
		
		return $itunes_url;
	}
	
	function build_yesasia_artist_url($aid)
	{
		$yesasia_url = $this->yesasia_uri_base;
		$yesasia_url .= 'http://us.yesasia.com/en/artIdxDept.aspx/aid-' . $aid . '/code-j/section-music/';
		
		return $yesasia_url;
	}
	
	function build_yesasia_album_url($pid)
	{
		$yesasia_url = $this->yesasia_uri_base;
		$yesasia_url .= 'http://us.yesasia.com/en/PrdDept.aspx/pid-' . $pid . '/code-j/section-music/';
		
		return $yesasia_url;
	}
	
	function build_cdjapan_url($key)
	{
		$cdjapan_url = $this->cdjapan_uri_base . $key;
		return $cdjapan_url;
	}
	
	function build_ecommerce_url($ecommerce_id, $merchant_id, $locale = 'us')
	{
		switch ($merchant_id)
		{
			case $this->merchant_id_cdjapan:
				$ecommerce_url = $this->build_cdjapan_url($ecommerce_id);
				break;
			case $this->merchant_id_yesasia:
				$ecommerce_url = $this->build_yesasia_album_url($ecommerce_id);
				break;
			case $this->merchant_id_itunes:
				$ecommerce_url = $this->build_itunes_album_url($ecommerce_id, null, $locale);
				break;
		}
		
		return $ecommerce_url;
	}
}
?>