<?php

class Content extends CI_Controller
{
	var $artist_id = 1;
	var $blog_id = 12;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('MtLib');
		$this->load->model('Mt_ep4_artist_model');
		$this->load->model('Mt_ep4_album_model');
		$this->load->model('Mt_ep4_release_model');
		$this->load->model('Mt_ep4_tracks_model');
		$this->load->model('Mt_ep4_song_model');
		$this->load->model('Mt_ep4_content_model');
		$this->load->model('Mt_mt_model');
		$this->mysmarty->assign('session', $this->phpsession);
	}
	
	// View methods
	
	function index()
	{
		header('Location: /index.php/mt/ep4/');
	}
	
	function unmap($content_id, $artist_id = '')
	{
		if (empty($artist_id)) {$artist_id = $this->artist_id;}
		
		$rsContent = $this->Mt_ep4_content_model->get_content_map_by_id($content_id);
		$this->mtlib->_format_ep4_section_head($artist_id, 'Map an entry');
		
		$this->mysmarty->assign('rsContent', $rsContent);
		$this->mysmarty->assign('content_id', $content_id);
		$this->mtlib->_smarty_display_mt_page('mt_ep4_content_unmap.tpl');
	}
	
	// AJAX methods
	function entry_list() {
		$category_id = $this->input->get_post('category_id');
		$rowEntries = $this->Mt_mt_model->get_entries_by_category_id($category_id);
		$rsEntries = $this->vigilantedblib->_db_return_smarty_array($rowEntries);
		
		$jsonEntries = json_encode($rsEntries);
		echo $jsonEntries;
	}
	
	// Processing methods
	
	function update($content_id)
	{
		$rsContent = $this->Mt_ep4_content_model->get_content_map_by_id($content_id);
		$input = $this->vigilantedblib->_db_build_update_data($rsContent);
		$release_id = $this->input->get_post('content_release_id');
		
		if (!empty($input)) {
			if (false !== $this->Mt_ep4_content_model->update_content_map_by_id($content_id, $input))
			{
				$this->phpsession->flashsave('msg', 'Map from entry to release was updated.');
			}
		}

		header('Location: /index.php/ep4/release/edit/' . $release_id . '/');
		die();
	}
	
	function create()
	{
		$rsContent = $this->db->get('ep4_content', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsContent);
		$release_id = $this->input->get_post('content_release_id');
		
		if (!empty($input)) {
			if (false !== $this->Mt_ep4_content_model->add_content_map($input))
			{
				$this->phpsession->flashsave('msg', 'Map from entry to release was created.');
				$content_id = $this->db->insert_id();
			}
		}
		
		
		header('Location: /index.php/ep4/release/edit/' . $release_id . '/');
		die();
	}
	
	function remove($content_id)
	{
		$confirm = $this->input->get_post('confirm');
		$release_id = $this->input->get_post('content_release_id');
		
		if ($confirm == 'Yes')
		{
			$this->Mt_ep4_content_model->delete_content_map_by_id($content_id);
			
			$this->phpsession->flashsave('msg', 'The content mapping was deleted.');
		}
		elseif ($confirm == 'No')
		{
			$this->phpsession->flashsave('msg', 'The content mapping was not deleted.');
		}
		header('Location: /index.php/ep4/release/edit/' . $release_id . '/');
		
		die();
	}
	
	// Private methods
	
}

?>