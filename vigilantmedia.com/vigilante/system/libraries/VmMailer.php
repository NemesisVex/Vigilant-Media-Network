<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * VmMailer
 *
 * @author Greg Bueno
 */
class VmMailer {

	private $CI;
	private $mail_config = array();
	public $to;
	public $from_email;
	public $from_name;
	public $subject_prefix;
	public $subject;
	public $message;
	public $redirect;

	public function __construct($params = null) {
		$this->mail_config['protocol'] = 'mail';
		$this->mail_config['mailpath'] = '/usr/bin/mail';
		$this->mail_config['charset'] = 'utf-8';
		$this->mail_config['wordwrap'] = true;

		$this->redirect = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $_SERVER['REQUEST_URI'];
		$this->subject_prefix = 'Vigilant Media Network: feedback';
		
		$this->CI =& get_instance();
	}

	public function set_config($field, $value) {
		$this->mail_config[$field] = $value;
	}

	public function get_config($field = null) {
		return ($field !== null) ? $this->mail_config[$field] : $this->mail_config;
	}

	public function process_email_form($hidden_fields, $shown_fields) {
		$send_mail = true;

		foreach ($hidden_fields as $hidden_field) {
			$check_field = $this->CI->input->get_post($hidden_field);
			if (!empty($check_field)) {
				$send_mail = false;
				header('Location: ' . $_SERVER['HTTP_REFERER']);
				die();
			}
		}

		if ($send_mail == true) {
			foreach ($shown_fields as $shown_field => $value) {
				$this->$shown_field = stripslashes($this->CI->input->get_post($value));
			}

			$this->send_mail();
		}
	}

	public function send_mail() {
		$subject = (empty($this->subject)) ? $this->subject_prefix : $this->subject_prefix . ': ' . $this->subject;
		
		$message_footer = '';
		$message_footer .= "\n\n";
		$message_footer .= "-----------------------------\n";
		if (!empty($_SERVER['REMOTE_HOST'])) {
			$message_footer .= "REMOTE_HOST: " . $_SERVER['REMOTE_HOST'] . "\n";
		}
		$message_footer .= "REMOTE_ADDR: " . $_SERVER['REMOTE_ADDR'] . "\n";
		$message_footer .= "HTTP_USER_AGENT: " . $_SERVER['HTTP_USER_AGENT'] . "\n";
		$this->message .= $message_footer;

		$this->CI->email->initialize($this->mail_config);

		$this->CI->email->from($this->from_email, $this->from_name);
		$this->CI->email->to($this->to);
		$this->CI->email->subject($subject);
		$this->CI->email->message($this->message);

		if (false !== $this->CI->email->send()) {
			header('Location: ' . $this->redirect);
			die();
		}
		
		echo '<pre>' . "\n";
		echo $this->CI->email->print_debugger();
		echo '</pre>' . "\n";
	}

}

?>
