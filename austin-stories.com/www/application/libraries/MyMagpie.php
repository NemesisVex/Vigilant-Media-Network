<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * MyMagpie
 *
 * 
 * @package CodeIgniter
 * @subpackage Vigilant Media Network
 * @category Libraries
 * @author Greg Bueno
 * @copyright (c) 2012 Greg Bueno
 */

require_once(APPPATH . "third_party/magpierss/rss_fetch.inc");
define('MAGPIE_CACHE_DIR', APPPATH . 'third_party/magpierss/cache');
define('MAGPIE_OUTPUT_ENCODING', 'UTF-8');

class MyMagpie extends Smarty
{
	function MyMagpie()
	{
	}
}
?>