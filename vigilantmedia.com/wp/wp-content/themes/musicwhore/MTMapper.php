<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MtMapper
 *
 * @author Greg Bueno
 */
class MtMapper {
	private $mt_db_host;
	private $mt_db_user;
	private $mt_db_password;
	private $mt_db_database;
	private $connection;
	
	//put your code here
	public function __construct() {
		$this->mt_db_host = "mysql.vigilantmedia.com";
		$this->mt_db_user = "vigilantmedia";
		$this->mt_db_password = "3825crux";
		$this->mt_db_database = "vigilantmedia";
		
		$this->connect_to_mt_db();
	}
	
	public function get_entry_by_id($id) {
		$query = 'select * from mt_entry where entry_id = ' . $id;
		if (false !== ($result = mysql_query($query, $this->connection))) {
			$rs = mysql_fetch_object($result);
			return $rs;
		}
		return false;
	}
	
	private function connect_to_mt_db() {
		$this->connection = mysql_connect($this->mt_db_host, $this->mt_db_user, $this->mt_db_password);
		mysql_select_db($this->mt_db_database);
	}
}

?>
