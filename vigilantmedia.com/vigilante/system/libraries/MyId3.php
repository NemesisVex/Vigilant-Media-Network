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
require_once(BASEPATH . "libraries/getid3/getid3.php");

class MyId3 extends getid3
{
/*
|==========================================================
| Constructor
|==========================================================
|
|
*/
	var $id3;
	
	function MyId3()
	{
		log_message('debug', "Id3 Class Initialized");
		$id3 = new getID3;
		return $id3;
	}
	
	function id3_tagwriter()
	{
		require_once(BASEPATH . "libraries/getid3/write.php");
		$tag_writer = new getid3_writetags;
		return $tag_writer;
	}
}
?>