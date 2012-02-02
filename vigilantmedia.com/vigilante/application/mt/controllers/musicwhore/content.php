<?php

class Content extends CI_Controller
{
	var $artist_id = 1;
	var $blog_id = 8;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('MtLib');
		$this->load->model('Mt_mw_artist_model');
		$this->load->model('Mt_mw_album_model');
		$this->load->model('Mt_mw_release_model');
		$this->load->model('Mt_mw_tracks_model');
		$this->load->model('Mt_mw_ecommerce_model');
		$this->load->model('Mt_mw_content_model');
		$this->load->model('Mt_mw_lyrics_model');
		$this->load->model('Mt_mt_model');
		$this->mysmarty->assign('session', $this->phpsession);
		$this->mysmarty->assign('side_template', 'mt_musicwhore_artist_side.tpl');
	}
	
	// View methods
	
	function index()
	{
		header('Location: /index.php/gregbueno/');
	}
	
	function categories($artist_id = '')
	{
		!empty($artist_id) ? $this->mtlib->_format_mw_section_head($artist_id, 'Map an entry') : $this->mtlib->_format_section_head('Musicwhore.org', 'Map an entry');
		
		$rowCategories = $this->Mt_mt_model->get_all_categories($this->blog_id);
		$rsCategories = $this->vigilantedblib->_db_return_smarty_array($rowCategories);
		
		$this->mysmarty->assign('rsCategories', $rsCategories);
		$this->mysmarty->assign('artist_id', $artist_id);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_content_categories.tpl');
	}
	
	function entries($entry_category_id, $artist_id = '')
	{
		!empty($artist_id) ? $this->mtlib->_format_mw_section_head($artist_id, 'Map an entry') : $this->mtlib->_format_section_head('Musicwhore.org', 'Map an entry');
		
		$rowEntries = $this->Mt_mt_model->get_entries_by_category_id($entry_category_id);
		$rsEntries = $this->vigilantedblib->_db_return_smarty_array($rowEntries);
		
		$this->mysmarty->assign('rsEntries', $rsEntries);
		$this->mysmarty->assign('artist_id', $artist_id);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_content_entries.tpl');
	}
	
	function entry($entry_id, $artist_id = '')
	{
		if (!empty($artist_id))
		{
			$rsArtist = $this->mtlib->_format_mw_section_head($artist_id, 'Map an entry');
			$this->mysmarty->assign('rsArtist', $rsArtist);
		}
		else
		{
			$this->mtlib->_format_section_head('Musicwhore.org', 'Map an entry');
			
			$rowArtists = $this->Mt_mw_artist_model->get_all_artists();
			$rsArtists = $this->vigilantedblib->_db_return_smarty_array($rowArtists);
			$this->mysmarty->assign('rsArtists', $rsArtists);
		}
		
		$rsEntry = $this->Mt_mt_model->get_entry_by_id($entry_id);
		
		$rowMaps = $this->Mt_mw_content_model->get_maps_by_entry_id($entry_id);
		$rsMaps = $this->vigilantedblib->_db_return_smarty_array($rowMaps);
		
		$this->mysmarty->assign('rsEntry', $rsEntry);
		$this->mysmarty->assign('rsMaps', $rsMaps);
		$this->mysmarty->assign('entry_id', $entry_id);
		$this->mysmarty->assign('artist_id', $artist_id);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_content_entry.tpl');
	}
	
	function releases($entry_id, $artist_id = '', $edit = false)
	{
		if (empty($artist_id)) {$artist_id = $this->artist_id;}
		$this->mtlib->_format_mw_section_head($artist_id, 'Map an entry');
		
		$rowReleases = $this->Mt_mw_release_model->get_releases_by_artist_id($artist_id);
		$rsReleases = $this->vigilantedblib->_db_return_smarty_array($rowReleases);
		
		$this->mysmarty->assign('rsReleases', $rsReleases);
		$this->mysmarty->assign('entry_id', $entry_id);
		$this->mysmarty->assign('artist_id', $artist_id);
		$this->mysmarty->assign('edit', $edit);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_content_releases.tpl');
	}
	
	function edit($content_id, $artist_id = '')
	{
		if (empty($artist_id)) {$artist_id = $this->artist_id;}
		
		$rsContent = $this->Mt_mw_content_model->get_content_map_by_id($content_id);
		$entry_id = $rsContent->content_entry_id;
		
		$this->mysmarty->assign('rsContent', $rsContent);
		$this->mysmarty->assign('content_id', $content_id);
		$this->releases($entry_id, $artist_id, true);
	}
	
	function map($entry_id, $release_id = '', $artist_id = '', $edit = false)
	{
		if (empty($artist_id)) {$artist_id = $this->artist_id;}
		$this->mtlib->_format_mw_section_head($artist_id, 'Map an entry');
		
		$rsEntry = $this->Mt_mt_model->get_entry_by_id($entry_id);
		$rsRelease = $this->Mt_mw_release_model->get_release_by_id($release_id);
		
		$rowTracks = $this->Mt_mw_tracks_model->get_tracks_by_release_id($release_id);
		$rsTracks = $this->vigilantedblib->_db_return_smarty_array($rowTracks);
		
		$this->mysmarty->assign('rsEntry', $rsEntry);
		$this->mysmarty->assign('rsRelease', $rsRelease);
		$this->mysmarty->assign('rsTracks', $rsTracks);
		$this->mysmarty->assign('entry_id', $entry_id);
		$this->mysmarty->assign('release_id', $release_id);
		$this->mysmarty->assign('artist_id', $artist_id);
		$this->mysmarty->assign('edit', $edit);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_content_map.tpl');
	}
	
	function remap($content_id, $release_id, $artist_id = '')
	{
		if (empty($artist_id)) {$artist_id = $this->artist_id;}
		
		$rsContent = $this->Mt_mw_content_model->get_content_map_by_id($content_id);
		
		$entry_id = $rsContent->content_entry_id;
		if (!empty($entry_id))
		{
			$rsEntry = $this->Mt_mt_model->get_entry_by_id($entry_id);
			$this->mysmarty->assign('rsEntry', $rsEntry);
		}
		
		$this->mysmarty->assign('rsContent', $rsContent);
		$this->mysmarty->assign('content_id', $content_id);
		$this->map($entry_id, $release_id, $artist_id, true);
	}
	
	function unmap($content_id, $artist_id = '')
	{
		$rsContent = $this->Mt_mw_content_model->get_content_map_by_id($content_id);
		$this->mtlib->_format_mw_section_head($artist_id, 'Map an entry');
		
		$this->mysmarty->assign('rsContent', $rsContent);
		$this->mysmarty->assign('content_id', $content_id);
		$this->mysmarty->assign('artist_id', $artist_id);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_content_unmap.tpl');
	}
	
	// Processing methods
	
	function update($content_id, $artist_id = '', $release_id = '')
	{
		$entry_id = $this->input->get_post('content_entry_id');
		
		$rsContent = $this->Mt_mw_content_model->get_content_map_by_id($content_id);
		$input = $this->vigilantedblib->_db_build_update_data($rsContent);
		
		if (!empty($release_id)) {$input['content_release_id'] = $release_id;}
		if (!empty($artist_id)) {$input['content_artist_id'] = $artist_id;}
		$input['content_entry_id'] = $entry_id;
		
		if (!empty($input))
		{
			if (false !== $this->Mt_mw_content_model->update_content_map_by_id($content_id, $input))
			{
				$this->phpsession->flashsave('msg', 'Map from entry to release was updated.');
			}
		}
		
		header('Location: /index.php/musicwhore/content/entry/' . $entry_id . '/' . $artist_id . '/');
		die();
	}
	
	function create($entry_id, $artist_id = '', $release_id = '')
	{
		$rsContent = $this->db->get('mw_content', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsContent);
		
		if (!empty($release_id)) {$input['content_release_id'] = $release_id;}
		if (!empty($artist_id)) {$input['content_artist_id'] = $artist_id;}
		$input['content_entry_id'] = $entry_id;
		
		if (false !== $this->Mt_mw_content_model->add_content_map($input))
		{
			$this->phpsession->flashsave('msg', 'Map from entry to release was created.');
			$content_id = $this->db->insert_id();
		}
		
		header('Location: /index.php/musicwhore/content/entry/' . $entry_id . '/' . $artist_id . '/');
		die();
	}
	
	function remove($content_id, $artist_id)
	{
		$confirm = $this->input->get_post('confirm');
		$entry_id = $this->input->get_post('entry_id');
		
		if ($confirm == 'Yes')
		{
			$this->Mt_mw_content_model->delete_content_map_by_id($content_id);
			
			$this->phpsession->flashsave('msg', 'The content mapping was deleted.');
			header('Location: /index.php/musicwhore/content/categories/' . $artist_id . '/');
		}
		elseif ($confirm == 'No')
		{
			$this->phpsession->flashsave('msg', 'The content mapping was not deleted.');
			header('Location: /index.php/musicwhore/content/entry/' . $entry_id . '/' . $artist_id . '/');
		}
		
		die();
	}
	
	// Private methods
	
}

?>