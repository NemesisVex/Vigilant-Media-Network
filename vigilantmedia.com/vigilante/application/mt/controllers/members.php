<?php
class Members extends CI_Controller
{
	var $_db_field_id = 'user_id';
	var $_db_field_login = 'user_login';
	var $_db_field_email = 'user_email';
	var $_db_field_first_name = 'user_first_name';
	var $_db_field_last_name = 'user_last_name';
	var $_db_field_password = 'user_password';
	var $_db_field_temp_password = 'user_temp_password';
	
	var $_sess_active_flag = 'is_logged_in';
	var $_sess_field_id = 'user_id';
	var $_sess_user_level_masks = array(1 => 'Banned/rejected', 2 => 'Pending', 4 => 'Temporary', 8 => 'Member', 16 => 'Administrator', 32 => 'Root administrator');
	var $_sess_user_access_masks = array(2 => 'Display real name', 4 => 'Display login name', 8 => 'Post to Austin Stories', 16 => 'Post to Duran-duran.ent',
	32 => 'Post to Musicwhore.org', 64 => 'Post to Gregbueno.com', 128 => 'Audiobin add enabled', 256 => 'Audiobin Preview play enabled',
	512 => 'Audiobin Streaming deleted enabled', 1024 => 'Audiobin Basic save enabled', 2048 => 'Audiobin Premiere save enabled', 4096 => 'Read secret journal entries');
	var $_sess_admin_allow_masks = array(16 => 'Administrator', 32 => 'Root administrator');
	
	var $_email_webmaster_name;
	var $_email_webmaster_email = 'greg@gregbueno.com';
	var $_email_webmaster_info = array('email' => 'greg@gregbueno.com');
	var $_email_subject_base;
	
	var $page_title = 'Member Administration';
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mt_user_model');
		$this->load->library('MtLib');
		$this->load->library('pagination');
		
		$this->mysmarty->assign('session', $this->phpsession);
		$this->mysmarty->assign('_sess_user_access_masks', $this->_sess_user_access_masks);
		$this->mysmarty->assign('_sess_user_level_masks', $this->_sess_user_level_masks);
		
		$this->mtlib->mtconfig['sites'][8] = array('site_name' => 'Austin Stories', 'site_alias' => 'as');
		$this->mtlib->mtconfig['sites'][64] = array('site_name' => 'Gregbueno.com', 'site_alias' => 'gb');
	}
	
	function index()
	{
		$offset = $this->uri->segment(3);
		$per_page = 50;
		
		$this->mtlib->_format_members_section_head();
		
		$rowUsers = $this->Mt_user_model->get_all_users('user_login');
		$total_rows = $rowUsers->num_rows();
		
		$page_config['base_url'] = '/index.php/members/index/';
		$page_config['total_rows'] = $total_rows;
		$page_config['per_page'] = $per_page;
		$page_config['uri_segment'] = 3;
		$page_config['num_links'] = 5;
		$this->pagination->initialize($page_config);
		
		$page_links = $this->pagination->create_links();
		
		$rsUsers = $this->vigilantedblib->_db_return_smarty_array($rowUsers, $per_page, $offset);
		
		$this->mysmarty->assign('page_links', $page_links);
		$this->mysmarty->assign('rsUsers', $rsUsers);
		$this->mtlib->_smarty_display_mt_page('mt_members.tpl');
	}
	
	function edit($user_id)
	{
		$this->mtlib->_format_members_section_head();
		
		if (false !== ($rsUser = $this->Mt_user_model->get_user_by_id($user_id)))
		{
			$this->mysmarty->assign('rsUser', $rsUser);
		}
		
		$rowCountries = $this->Mt_user_model->get_countries();
		$rsCountries = $this->vigilantedblib->_db_return_smarty_array($rowCountries);
		
		$rowStates = $this->Mt_user_model->get_states();
		$rsStates = $this->vigilantedblib->_db_return_smarty_array($rowStates);
		
		$this->mysmarty->assign('rsCountries', $rsCountries);
		$this->mysmarty->assign('rsStates', $rsStates);
		$this->mysmarty->assign('user_id', $user_id);
		$this->mtlib->_smarty_display_mt_page('mt_members_edit.tpl');
	}
	
	function delete($user_id)
	{
		$this->mtlib->_format_members_section_head();
		
		if (false !== ($rsUser = $this->Mt_user_model->get_user_by_id($user_id)))
		{
			$this->mysmarty->assign('rsUser', $rsUser);
		}
		$this->mysmarty->assign('user_id', $user_id);
		$this->mtlib->_smarty_display_mt_page('mt_members_delete.tpl');
	}
	
	function review()
	{
		$this->mtlib->_format_members_section_head();
		
		$rowUsers = $this->Mt_user_model->get_pending_users();
		$rsUsers = $this->vigilantedblib->_db_return_smarty_array($rowUsers);
		
		$this->mysmarty->assign('rsUsers', $rsUsers);
		$this->mtlib->_smarty_display_mt_page('mt_members_review.tpl');
	}
	
	//Method controllers
	function update($user_id)
	{
		$access_mask = $this->input->get_post('access_mask');
		$_user_password = $this->input->get_post('_user_password');
		$user_password = $this->input->get_post('user_password');
		
		$rsUser = $this->Mt_user_model->get_user_by_id($user_id);
		$input = $this->vigilantedblib->_db_build_update_data($rsUser);
		
		$input['user_access_mask '] = !empty($access_mask) ? array_sum($access_mask) : 0;
		$input['user_password'] = !empty($_user_password) ? crypt($_user_password) : $user_password;
		$input['user_id'] = $user_id;
		
		if (!empty($input))
		{
			if (false !== $this->Mt_user_model->update_user_by_id($user_id, $input))
			{
				$this->phpsession->flashsave('msg', 'Your profile was updated.');
			}
		}
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		die();
	}
	
	function approve($user_id)
	{
		$access_mask = $this->input->get_post('access_mask');
		$user_level_mask = $this->input->get_post('user_level_mask');
		$notify = $this->input->get_post('notify');
		
		if ($user_level_mask==2)
		{
			$this->phpsession->flashsave('error', 'Please flag the user with a status other than pending.');
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			die();
		}
		
		$rsUser = $this->Mt_user_model->get_user_by_id($user_id);
		
		if (!empty($rsUser->user_temp_password))
		{
			$password_crypt = crypt($rsUser->user_temp_password);
			$password_uncrypt = $rsUser->user_temp_password;
			$input['user_password'] = $password_crypt;
			$input['user_temp_password'] = null;
		}
		
		$input['user_access_mask'] = !empty($access_mask) ? array_sum($access_mask) : 0;
		$input['user_level_mask'] = !empty($user_level_mask) ? $user_level_mask : 0;
		$input['user_id'] = $user_id;
		
		if (!empty($input))
		{
			if (false !== $this->Mt_user_model->update_user_by_id($user_id, $input))
			{
				$site_name = $this->mtlib->mtconfig['sites'][$notify]['site_name'];
				$site_alias = $this->mtlib->mtconfig['sites'][$notify]['site_alias'];
				$this->_email_webmaster_name = $site_name . ' Webmaster';
				$this->_email_subject_base = $site_name;
				
				$to = $rsUser->user_email;
				$from = array('name' => $this->_email_webmaster_name, 'email' => $this->_email_webmaster_email);
				$subject_more = 'Membership approved';
				
				$this->mysmarty->assign('rsUser', $rsUser);
				$this->mysmarty->assign('password_uncrypt', $password_uncrypt);
				$text = $this->mysmarty->fetch('mt_members_review_email_approved_' . $site_alias . '.tpl');
				
				$this->_notify_send_mail($to, $from, $text, $subject_more, null, $this->_email_webmaster_email);
				$this->phpsession->flashsave('msg', 'Your profile was updated.');
			}
		}
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		die();
	}
	
	function remove($user_id)
	{
		$this->load->model('Mt_as_aliases_model');
		$this->load->model('Mt_as_favorites_model');
		$this->load->model('Mt_as_portal_model');
		$this->load->model('Mt_as_sites_model');
		
		$confirm = $this->input->get_post('confirm');
		
		if ($confirm=='Yes')
		{
			if (false !== ($rsCheck = $this->Mt_user_model->get_user_by_id($user_id)))
			{
				$this->Mt_as_aliases_model->delete_alias_by_user_id($user_id);
				$this->Mt_as_favorites_model->delete_favorite_by_user_id($user_id);
				$this->Mt_as_portal_model->delete_post_by_user_id($user_id);
				$this->Mt_as_sites_model->delete_site_by_user_id($user_id);
				$this->Mt_user_model->delete_user_log_by_user_id($user_id);
				if (false !== $this->Mt_user_model->delete_user_by_id($user_id))
				{
					$this->phpsession->flashsave('msg', 'Member record was deleted.');
				}
			}
			else
			{
				$this->phpsession->flashsave('error', 'Member record was not found.');
			}
		}
		else
		{
			$this->phpsession->flashsave('error', 'Member record was not deleted.');
		}
		header('Location: /index.php/members/');
	}
	
	//Private functions
	
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
		
		if (false !== $this->email->send())
		{
			return true;
		}
		
		echo $this->email->print_debugger();
	}
}
?>