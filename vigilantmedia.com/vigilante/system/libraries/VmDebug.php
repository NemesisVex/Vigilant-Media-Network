<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VmDebug
 *
 * @author Greg Bueno
 */
class VmDebug {

	public function __construct($params = null) {
		
	}

	function debug_trace($msg = '', $color = '#F00') {
		echo '<span style="color: ' . $color . ';">DEBUG: ' . $msg . '</span><br>' . "\n";
	}

	public function debug_print_r($msg, $die_after_print = false) {
		echo '<pre>';
//		if (is_array($msg)) {
//			foreach ($msg as $message) {
//				print_r($message);
//			}
//		} else {
			print_r($msg);
//		}
		echo '</pre>';
		if ($die_after_print === true) {
			die();
		}
	}

}

?>
