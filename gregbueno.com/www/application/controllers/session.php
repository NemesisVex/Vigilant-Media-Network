<?php
class Session extends CI_Controller
{
	var $_form_field_redirect = 'redirect';
	var $_form_field_login = 'login';
	var $_form_field_password = 'password';
	var $_form_field_savelogin = 'saveLogin';
	var $_form_field_change_password = 'newpassword';
	var $_form_field_new_password = 'newpassword';

	var $_db_field_id = 'user_id';
	var $_db_field_login = 'user_login';
	var $_db_field_email = 'user_email';
	var $_db_field_first_name = 'user_first_name';
	var $_db_field_last_name = 'user_last_name';
	var $_db_field_password = 'user_password';
	var $_db_field_temp_password = 'user_temp_password';

	var $_sess_active_flag = 'is_logged_in';
	var $_sess_field_id = 'user_id';
	var $_sess_admin_allow_masks = array(16 => 'Administrator', 32 => 'Root administrator');

	var $_email_webmaster_name = 'TechComm2 Webmaster';
	var $_email_webmaster_email = 'greg.bueno@ni.com';
	var $_email_webmaster_info = array('name' => 'TechComm2 Webmaster', 'email' => 'greg.bueno@ni.com');
	var $_email_subject_base = 'TechComm2: ';

	var $page_title = 'TechComm2 Members';

	function __construct()
	{
		parent::__construct();
		$this->load->model('Mt_user_model');
		$this->mysmarty->assign('session', $this->phpsession);
	}

	// View controllers
	function index($user_id = NULL)
	{
		$this->_get_user_record($user_id);
		$this->techcommlib->_smarty_display_protected_page('members_content', 'members_index.tpl', 'members_content.tpl');
	}

	function edit($user_id = NULL)
	{
		$this->_get_user_record($user_id);
		$this->techcommlib->_smarty_display_protected_page('members_content', 'members_profile.tpl', 'members_content.tpl');
	}

	function password($view = NULL)
	{
		$this->techcommlib->_smarty_display_page('members_password.tpl');
	}

	function change_password()
	{
		$user_temp_password = $this->uri->segment(4);
		if (false !== ($rsUser = $this->Mt_user_model->get_user_by_temp_password($user_temp_password)))
		{
			$this->mysmarty->assign('user_temp_password', $user_temp_password);
			$this->mysmarty->assign('rsUser', $rsUser);
			$this->techcommlib->_smarty_display_page('members_password_change.tpl');
		}
		else
		{
			$this->phpsession->flashsave('error', 'You have reached a temporary URL which has already expired. To change your password again, send another change request to your e-mail address.');
			header('Location: ' . $_SERVER['SCRIPT_NAME'] . '/members/password/');
		}
	}

	function register()
	{
		show_error('Memberships are no longer accepted.', 410);
//		$this->techcommlib->_smarty_display_page('members_register.tpl');
	}

	// Method controllers
	// Profile administration
	function update($user_id)
	{
		$rsUser = $this->Mt_user_model->get_user_by_id($user_id);
		$input = $this->techcommlib->_db_build_update_data($rsUser);

		$change_password = $this->input->get_post($this->_form_field_change_password);
		if ($change_password == true)
		{
			$new_password = $this->input->get_post($this->_form_field_new_password);
			$input[$this->_db_field_password] = crypt($new_password);
		}

		if (!empty($input))
		{
			if (false !== $this->Mt_user_model->update_user_by_id($user_id, $input))
			{
				$this->phpsession->flashsave('msg', 'Your profile was updated.');
				$this->vigilantecorelib->log_action($rsUser->{$this->_db_field_login} . ' updated their profile.');
			}
		}

		header('Location: ' . $_SERVER['HTTP_REFERER']);
		die();
	}

	function add()
	{
		$perform_add = true;

		$rsUser = $this->db->get($this->Mt_user_model->_db_table_name, 1, 1)->row();
		$input = $this->techcommlib->_db_build_insert_data($rsUser);

		$generated_password = substr(md5($input[$this->_db_field_email] . time()), 8);
		$input[$this->_db_field_password] = crypt($generated_password);

		if (false !== $this->Mt_user_model->get_user_by_login($input[$this->_db_field_login]))
		{
			$error = 'Sorry, another person is already registered under the user name <strong>' . $input[$this->_db_field_login] . '.</strong>';
			$perform_add = false;
		}

		if (false !== $this->Mt_user_model->get_user_by_email($input[$this->_db_field_email]))
		{
			$error = 'Sorry, another person is already registered under the email <strong>' . $input[$this->_db_field_email] . '.</strong>';
			$perform_add = false;
		}

		if ($perform_add == true)
		{
			if (false !== $this->Mt_user_model->add_user($input))
			{
				$user_id = $this->db->insert_id();
				$this->phpsession->flashsave('msg', 'Your profile was created.');

				$email_text = array('generated_password' => $generated_password,
								   $this->_db_field_login => $input[$this->_db_field_login],
								   $this->_db_field_first_name => $input[$this->_db_field_first_name],
								   $this->_db_field_last_name => $input[$this->_db_field_last_name]);
				$user_name = $input[$this->_db_field_first_name] . ' ' . $input[$this->_db_field_last_name];
				$email_user = array('name' => $user_name, 'email' => $input[$this->_db_field_email]);

				$this->_notify_webmaster_new_user($this->_email_webmaster_email, $email_user, $email_text, 'Your account has been registered.');
				$this->_notify_user_new_user($input[$this->_db_field_email], $this->_email_webmaster_info, $email_text, 'New user sign-up');

				$this->vigilantecorelib->log_action($input[$this->_db_field_login] . ' created an account.');
			}
			header('Location: ' . $_SERVER['SCRIPT_NAME'] . '/members/index/' . $user_id . '/');
		}
		else
		{
			if (!empty($error)) {$this->phpsession->flashsave('error', $error);}
			$this->vigilantecorelib->log_action($rsUser->{$this->_db_field_login} . ' failed to create an account.');
			header('Location: ' . $_SERVER['SCRIPT_NAME'] . '/members/register/');
		}
		die();
	}

	// Password reseting
	function generate_password()
	{
		$email = $this->input->get_post('email');

		if (false !== ($rsUser = $this->Mt_user_model->get_user_by_email($email)))
		{
			$input = $this->techcommlib->_db_build_update_data($rsUser);
			$generate_password = substr(md5($email . time()), 5);

			$input[$this->_db_field_temp_password] = $generate_password;
			$this->Mt_user_model->update_user_by_email($email, $input);

			$text = array('generate_password' => $generate_password);
			$this->_notify_user_temp_password($email, $this->_email_webmaster_info, $text, 'Password change request');

			$this->techcommlib->_smarty_display_page('members_password_generate.tpl');
		}
		else
		{
			$this->phpsession->flashsave('error', 'An account could not be found under the e-mail address <strong>' . $email . '</strong>');
			header('Location: ' . $_SERVER['SCRIPT_NAME'] . '/members/password/');
			die();
		}
	}

	function update_password()
	{
		$change_password = true;
		$user_temp_password = $this->uri->segment(4);

		$newpassword = $this->input->get_post('newpassword');
		$confirmpassword = $this->input->get_post('confirmpassword');
		$user_id = $this->input->get_post('user_id');

		if (false !== ($rsUser = $this->Mt_user_model->get_user_by_temp_password($user_temp_password)))
		{
			if ($newpassword != $confirmpassword)
			{
				$this->phpsession->flashsave('error', 'Please make sure your confirmation password matches your new password.');
				$change_password = false;
				header('Location: ' . $_SERVER['SCRIPT_NAME'] . '/members/password/change/' . $user_temp_password . '/');
				die();
			}
		}
		else
		{
			$this->phpsession->flashsave('error', 'You have reached a temporary URL which has already expired. To change your password again, send another change request to your e-mail address.');
			$change_password = false;
			header('Location: ' . $_SERVER['SCRIPT_NAME'] . '/members/password/');
			die();
		}

		if ($change_password == true)
		{
			$user_password = crypt($newpassword);
			$input = array($this->_db_field_password => $user_password, $this->_db_field_temp_password => NULL);
			$this->Mt_user_model->update_user_by_id($user_id, $input);
			$this->vigilantecorelib->log_action($rsUser->{$this->_db_field_login} . ' changed their password.');

			$this->techcommlib->_smarty_display_page('members_password_changed.tpl');
		}
	}

	// Session handling
	function login()
	{
		$this->_old_school_login();
	}

	function logout()
	{
		$this->_old_school_logout();
	}

	//Private methods
	function _get_user_record($user_id = NULL)
	{
		if (isset($user_id))
		{
			if (false === $this->_session_check_permission($user_id))
			{
				$user_id = $this->phpsession->get($this->_sess_field_id);
				if (empty($user_id))
				{
					$error = 'You do not have permission to access this user profile.';
				}
			}
		}
		else
		{
			$user_id = $this->phpsession->get($this->_sess_field_id);
		}

		if (!empty($user_id))
		{
			if (false !== ($rsUser = $this->Mt_user_model->get_user_by_id($user_id)))
			{
				$this->mysmarty->assign('rsUser', $rsUser);
			}
			else
			{
				$error = 'No record of this user could be found.';
			}
		}
		if (!empty($error)) {$this->phpsession->flashsave('error', $error);}
	}

	function _session_check_permission($user_id)
	{
		if ($this->phpsession->get($this->_db_field_id) == $user_id)
		{
			return true;
		}
		elseif ($this->techcommlib->_check_mask($this->_sess_admin_allow_masks, $this->phpsession->get('user_level_mask'))==true)
		{
			return true;
		}
		return false;
	}

	function _get_user_by_login_password($login, $password)
	{
		if (false !== ($rs = $this->Mt_user_model->get_user_by_login($login)))
		{
			if (crypt($password, $rs->user_password) == $rs->user_password)
			{
				return $rs;
			}
		}
		return false;
	}

	function _notify_get_smarty_text($text, $template)
	{
		foreach ($text as $field => $value)
		{
			$this->mysmarty->assign($field, $value);
		}
		$text = $this->mysmarty->fetch($template);
		return $text;
	}

	function _notify_webmaster_new_user($to, $from, $text, $subject_more = '', $cc = '', $bcc = '')
	{
		$msg = $this->_notify_get_smarty_text($text, 'members_register_email_to_l10n.tpl');
		$this->_notify_send_mail($to, $from, $msg, $subject_more, $cc, $bcc);
	}

	function _notify_user_new_user($to, $from, $text, $subject_more = '', $cc = '', $bcc = '')
	{
		$msg = $this->_notify_get_smarty_text($text, 'members_register_email_to_writer.tpl');
		$this->_notify_send_mail($to, $from, $msg, $subject_more, $cc, $bcc);
	}

	function _notify_user_temp_password($to, $from, $text, $subject_more = '', $cc = '', $bcc = '')
	{
		$msg = $this->_notify_get_smarty_text($text, 'members_password_email_to_user.tpl');
		$this->_notify_send_mail($to, $from, $msg, $subject_more, $cc, $bcc);
	}

	function _notify_send_mail($to, $from, $text, $subject_more = '', $cc = '', $bcc = '')
	{
		$this->email->to($to);
		$this->email->from($from['email'], $from['name']);
		if (!empty($cc)) {$this->email->cc($cc);}
		if (!empty($bcc)) {$this->email->bcc($bcc);}

		$subject = $this->_email_subject_base;
		if (!empty($subject_more)) {$subject .= ': ' . $subject_more;}
		$this->email->subject($subject);
		$this->email->message($text);

		$this->email->send();

		echo $this->email->print_debugger();
	}

	function _new_school_login()
	{
		$redirect = $this->input->get_post($this->_form_field_redirect);
		$login = $this->input->get_post($this->_form_field_login);
		$password = $this->input->get_post($this->_form_field_password);
		$save_login = $this->input->get_post($this->_form_field_savelogin);

		if ($this->phpsession->get($this->_sess_active_flag)==true)
		{
			header('Location: ' . $redirect);
		}

		if (false !== ($rs = $this->_get_user_by_login_password($login, $password)))
		{
			foreach ($rs as $field => $value)
			{
				if ($field != $this->_db_field_password || $field != $this->_db_field_temp_password)
				{
					$this->phpsession->save($field, $value);
				}
			}
			$this->phpsession->save($this->_sess_active_flag, true);
			$this->vigilantecorelib->log_action($login . ' logged in.');
			if ($save_login == true) {$this->phpsession->save('save_login', true);}
			header('Location: ' . $redirect);
			die();
		}
		else
		{
			$this->mysmarty->assign('error', 'Login failed.');
			$this->mysmarty->assign('login', $login);
			$this->mysmarty->assign('redirect', $redirect);
			$this->vigilantecorelib->log_action($login . ' failed to log in.');
			$this->index();
		}
	}

	function _old_school_login()
	{
		$redirect = $this->input->get_post($this->_form_field_redirect);
		$login = $this->input->get_post($this->_form_field_login);
		$password = $this->input->get_post($this->_form_field_password);
		$save_login = $this->input->get_post($this->_form_field_savelogin);

		if ($this->phpsession->get($this->_sess_active_flag)==true)
		{
			header('Location: ' . $redirect);
		}

		if (false !== ($rs = $this->_get_user_by_login_password($login, $password)))
		{
			foreach ($rs as $field => $value)
			{
				if ($field != $this->_db_field_password || $field != $this->_db_field_temp_password)
				{
					$this->phpsession->save(null, $value, $field);
				}
			}
			$this->phpsession->save(null, true, $this->_sess_active_flag);
			$this->phpsession->save(null, true, 'LoggedIn'); //old school.
			if ($save_login == true) {$this->phpsession->save(null, true, 'save_login');}
			$this->vigilantecorelib->log_action($login . ' logged in.');
			header('Location: ' . $redirect);
			die();
		}
		else
		{
			$this->mysmarty->assign('error', 'Login failed.');
			$this->mysmarty->assign('login', $login);
			$this->mysmarty->assign('redirect', $redirect);
			$this->vigilantecorelib->log_action($login . ' failed to log in.');
			$this->index();
		}
	}

	function _new_school_logout()
	{
		$this->vigilantecorelib->log_action($_SESSION[$this->_db_field_login] . ' logged out.');
		$this->phpsession->clear();
		$this->output->set_header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

	function _old_school_logout()
	{
		$this->vigilantecorelib->log_action($_SESSION[$this->_db_field_login] . ' logged out.');

		session_destroy();
		$this->output->set_header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
}
?>