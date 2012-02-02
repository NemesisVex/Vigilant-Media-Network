<?php

class Meetings extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('MtLib');
		$this->load->library('pagination');
		
		$this->load->model('Mt_as_meetings_model');
		$this->mysmarty->assign('session', $this->phpsession);
	}
	
	function index()
	{
		header('Location: /index.php/mt/austinstories/');
	}
	
	function browse($function = '')
	{
		$this->mtlib->_format_section_head('Austin Stories', 'Meeting administration');
		$per_page = 13;
		$offset = $this->uri->segment(4);
		
		$rowMeetings = $this->Mt_as_meetings_model->get_all_meetings();
		$total_rows = $rowMeetings->num_rows();
		
		$page_config['base_url'] = '/index.php/austinstories/meetings/browse/';
		$page_config['total_rows'] = $total_rows;
		$page_config['per_page'] = $per_page;
		$page_config['uri_segment'] = 4;
		$page_config['num_links'] = 5;
		$this->pagination->initialize($page_config);
		
		$page_links = $this->pagination->create_links();
		
		$rsMeetings = $this->vigilantedblib->_db_return_smarty_array($rowMeetings, $per_page, $offset);
		
		$this->mysmarty->assign('page_links', $page_links);
		$this->mysmarty->assign('rsMeetings', $rsMeetings);
		$this->mtlib->_smarty_display_mt_page('mt_austinstories_meetings_browse.tpl');
	}
	
	function add($template = 'mt_austinstories_meetings_edit.tpl', $header = 'Add a meeting')
	{
		$this->mtlib->_format_section_head('Austin Stories', 'Meeting administration', $header);
		$this->mtlib->_smarty_display_mt_page($template);
	}
	
	function edit($meet_id, $template = 'mt_austinstories_meetings_edit.tpl', $header = 'Edit a meeting')
	{
		$rsMeeting = $this->Mt_as_meetings_model->get_meeting_by_id($meet_id);
		
		$this->mysmarty->assign('rsMeeting', $rsMeeting);
		$this->mysmarty->assign('meet_id', $meet_id);
		$this->add($template, $header);
	}
	
	function delete($meet_id)
	{
		$this->edit($meet_id, 'mt_austinstories_meetings_delete.tpl', 'Delete an alias');
	}
	
	// Processing methods
	
	function update($meet_id)
	{
		$rsMeeting = $this->Mt_as_meetings_model->get_meeting_by_id($meet_id);
		$input = $this->vigilantedblib->_db_build_update_data($rsMeeting);
		
		$input['meet_id'] = $meet_id;
		
		if (!empty($input))
		{
			if (false !== $this->Mt_as_meetings_model->update_meeting_by_id($meet_id, $input))
			{
				$this->phpsession->flashsave('msg', 'Meeting date was updated.');
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
		}
		
		die();
	}
	
	function create()
	{
		$rsMeeting = $this->db->get('as_meetings', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsMeeting);
		
		if (!empty($input))
		{
			if (false !== $this->Mt_as_meetings_model->add_meeting($input))
			{
				$this->phpsession->flashsave('msg', 'Meeting date was created.');
				$meet_id = $this->db->insert_id();
				header('Location: /index.php/austinstories/meetings/edit/' . $meet_id . '/');
			}
		}
		
		die();
	}
	
	function remove($meet_id = '')
	{
		$confirm = $this->input->get_post('confirm');
		$meet_date = $this->input->get_post('meet_date');
		$meeting_id = $this->input->get_post('meeting_id');
		
		if (empty($meet_id))
		{
			if (!empty($meeting_id))
			{
				$meet_id = $meeting_id;
				$confirm = 'Yes';
			}
			else
			{
				$this->phpsession->flashsave('error', 'No dates were specified for deletion.');
				header('Location: ' . $_SERVER['HTTP_REFERER']);
				die();
			}
		}
		
		$msg = is_array($meet_id) ? count($meet_id) . ' posts were ' : '<em>' . $meet_date . '</em> was';
		
		if ($confirm == 'Yes')
		{
			$this->Mt_as_meetings_model->delete_meeting_by_id($meet_id);
			$this->phpsession->flashsave('msg', $msg . ' deleted.');
		}
		elseif ($confirm == 'No')
		{
			$this->phpsession->flashsave('msg', $msg . ' not deleted.');
		}
		
		header('Location: /index.php/austinstories/post/browse/');
		die();
	}
	
	// Private methods
}

?>