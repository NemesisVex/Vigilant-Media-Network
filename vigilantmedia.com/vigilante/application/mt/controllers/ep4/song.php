<?php

class Song extends CI_Controller
{
	var $artist_id = 1;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('MtLib');
		$this->load->model('Mt_ep4_song_model');
		$this->load->model('Mt_ep4_tracks_model');
		$this->load->model('Mt_ep4_audio_model');
		$this->mysmarty->assign('session', $this->phpsession);
	}
	
	// View methods
	
	function index()
	{
		header('Location: /index.php/mt/ep4/');
	}
	
	function browse($function = 'edit')
	{
		$header = $function == 'delete' ? 'Delete a song' : 'Edit a song';
		$this->mtlib->_format_section_head('Observant Records', $header);
		
		$rowSongs = $this->Mt_ep4_song_model->get_all_songs();
		$rsSongs = $this->vigilantedblib->_db_return_smarty_array($rowSongs);
		
		$this->mysmarty->assign('rsSongs', $rsSongs);
		$this->mysmarty->assign('function', $function);
		$this->mtlib->_smarty_display_mt_page('mt_ep4_song_browse.tpl');
	}
	
	function add($template = 'mt_ep4_song_edit.tpl', $header = 'Add a song')
	{
		$this->mtlib->_format_section_head('Observant Records', $header);
		$this->mtlib->_smarty_display_mt_page($template);
	}
	
	function edit($song_id, $template = 'mt_ep4_song_edit.tpl', $header = 'Edit a song')
	{
		$rsSong = $this->Mt_ep4_song_model->get_song_by_id($song_id);
		
		$this->mysmarty->assign('rsSong', $rsSong);
		$this->mysmarty->assign('song_id', $song_id);
		$this->add($template, $header);
	}
	
	function delete($song_id)
	{
		$this->edit($song_id, 'mt_ep4_song_delete.tpl', 'Delete a song');
	}
	
	function save_lyrics($song_id)
	{
		$rsSong = $this->Mt_ep4_song_model->get_song_by_id($song_id);
		$file = 'Eponymous 4 - ' . $rsSong->song_title . '.txt';
		
		header('Cache-Control: private');
		header('Content-Disposition: attachment; filename="' . $file . '"');
		header("Content-Type: text/plain; charset=utf-8");
		echo $rsSong->song_title . "\r\n";
		if (!empty($rsSong->song_written_date)) {echo $rsSong->song_written_date . "\r\n";}
		echo "\r\n";
		echo strip_tags($rsSong->song_lyrics);
		die();
	}
	
	// Processing methods
	
	function update($song_id)
	{
		$rsSong = $this->Mt_ep4_song_model->get_song_by_id($song_id);
		$input = $this->vigilantedblib->_db_build_update_data($rsSong);
		
		if (!empty($input))
		{
			if (false !== $this->Mt_ep4_song_model->update_song_by_id($song_id, $input))
			{
				$this->phpsession->flashsave('msg', '"' . $rsSong->song_title . '" was updated.');
			}
		}
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		die();
	}
	
	function create()
	{
		$rsSong = $this->db->get('ep4_songs', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsSong);
		
		if (false !== $this->Mt_ep4_song_model->add_song($input))
		{
			$this->phpsession->flashsave('msg', '"' . $input['song_title'] . '" was created.');
			$song_id = $this->db->insert_id();
		}
		
		header('Location: /index.php/ep4/song/edit/' . $song_id . '/');
		die();
	}
	
	function remove($song_id)
	{
		$confirm = $this->input->get_post('confirm');
		$song_title = $this->input->get_post('song_title');
		
		if ($confirm == 'Yes')
		{
			$this->Mt_ep4_tracks_model->delete_tracks_by_song_id($song_id);
			$this->Mt_ep4_audio_model->delete_audio_by_song_id($song_id);
			$this->Mt_ep4_song_model->delete_song_by_id($song_id);
			
			$this->phpsession->flashsave('msg', '"' . $song_title . '" was deleted.');
		}
		elseif ($confirm == 'No')
		{
			$this->phpsession->flashsave('msg', '"' . $song_title . '" was not deleted.');
		}
		
		header('Location: /index.php/mt/ep4/');
		die();
	}
}

?>