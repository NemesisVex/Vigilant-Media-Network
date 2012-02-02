<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|==========================================================
| Code Igniter - by pMachine
|----------------------------------------------------------
| www.codeignitor.com
|----------------------------------------------------------
| Copyright (c) 2006, pMachine, Inc.
|----------------------------------------------------------
| This library is licensed under an open source agreement:
| www.codeignitor.com/docs/license.html
|----------------------------------------------------------
| File: libraries/Smarty.php
|----------------------------------------------------------
| Purpose: Wrapper for Smarty Templates
|==========================================================
*/
require_once(BASEPATH . "libraries/magpierss/rss_fetch.inc");
define('MAGPIE_CACHE_DIR', BASEPATH . 'libraries/magpierss/cache');
define('MAGPIE_OUTPUT_ENCODING', 'UTF-8');

class MyMagpie extends Smarty
{
/*
|==========================================================
| Constructor
|==========================================================
|
|
*/
	function MyMagpie()
	{
	}
}
?>