<?php

class Personell extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('MtLib');
		$this->load->model('Mt_mw_artist_model');
		$this->load->model('Mt_mw_personell_model');
		$this->mysmarty->assign('session', $this->phpsession);
		$this->mysmarty->assign('side_template', 'mt_musicwhore_artist_side.tpl');
	}
	
	// View methods
	
	function index()
	{
		header('Location: /index.php/mt/musicwhore/');
	}
	
	function browse($member_artist_id, $function = 'edit')
	{
		$header = $function == 'delete' ? 'Delete members' : 'Edit members';
		$rsArtist = $this->mtlib->_format_mw_section_head($member_artist_id, $header);
		
		$rowMembers = $this->Mt_mw_personell_model->get_members_by_artist_id($member_artist_id);
		$rsMembers = $this->vigilantedblib->_db_return_smarty_array($rowMembers);
		
		$this->mysmarty->assign('rsMembers', $rsMembers);
		$this->mysmarty->assign('member_artist_id', $member_artist_id);
		$this->mysmarty->assign('function', $function);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_artist_personell_browse.tpl');
	}
	
	function edit($member_artist_id)
	{
		$is_add_more = $this->input->get_post('is_add_more');
		$more_members = $this->input->get_post('more_members');
		
		$rsArtist = $this->mtlib->_format_mw_section_head($member_artist_id, 'Add/edit members');
		
		$rowMembers = $this->Mt_mw_personell_model->get_members_by_artist_id($member_artist_id);
		$rsMembers = $this->vigilantedblib->_db_return_smarty_array($rowMembers);
		
		if ($is_add_more == true)
		{
			$member_num = count($rsMembers) + 1;
			for ($i=0; $i < $more_members; $i++)
			{
				array_push($rsMembers, array('new_member_setup' => $member_num));
				$member_num++;
			}
			
		}
		
		$this->mysmarty->assign('rsArtist', $rsArtist);
		$this->mysmarty->assign('rsMembers', $rsMembers);
		$this->mysmarty->assign('member_artist_id', $member_artist_id);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_artist_personell_edit.tpl');
	}
	
	function add($member_artist_id)
	{
		$number_of_members = $this->input->get_post('number_of_members');
		
		$rsArtist = $this->mtlib->_format_mw_section_head($member_artist_id, 'Add/edit members');
		
		for ($i=0; $i<$number_of_members; $i++)
		{
			$rsMembers[$i]['new_member_setup'] = $i+1;
		}
		
		$this->mysmarty->assign('rsMembers', $rsMembers);
		$this->mysmarty->assign('member_artist_id', $member_artist_id);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_artist_personell_edit.tpl');
	}
	
	// Processing methods
	
	function update($member_artist_id)
	{
		$member_in = $this->input->get_post('member_in');
		
		foreach ($member_in as $member)
		{
			if (!empty($member['member_id']))
			{
				!empty($member['delete']) ? $this->_delete_member($member) : $this->_update_member($member, $member_artist_id);
			}
			else
			{
				$this->_add_member($member, $member_artist_id);
			}
		}
		
		$this->phpsession->flashsave('msg', 'Member information was updated.');
		
		header('Location: /index.php/musicwhore/personell/edit/' . $member_artist_id . '/');
		die();
	}
	
	// Private methods
	
	function _add_member($member, $member_artist_id)
	{
		$rsMember = $this->db->get('mw_artists_personell', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsMember, $member);
		$input['member_artist_id'] = $member_artist_id;
		
		$this->Mt_mw_personell_model->add_member($input);
	}
	
	function _update_member($member, $member_artist_id)
	{
		$member_id = $member['member_id'];
		$rsMember = $this->Mt_mw_personell_model->get_member_by_id($member_id);
		$input = $this->vigilantedblib->_db_build_update_data($rsMember, $member);
		
		if (!empty($input))
		{
			$input['member_artist_id'] = $member_artist_id;
			$this->Mt_mw_personell_model->update_member_by_id($member_id, $input);
		}
	}
	
	function _delete_member($member)
	{
		$member_id = $member['member_id'];
		$this->Mt_mw_personell_model->delete_member_by_id($member_id);
	}
}

?>