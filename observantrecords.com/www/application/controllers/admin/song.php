<?php

/**
 * Song is a controller for maintaining songs by Observant Records artists.
 *
 * @author Greg Bueno
 */
class Song extends CI_Controller {
	
	/**
	 * Song is a controller for maintaining songs by Observant Records artists.
	 */
	public function __construct() {
		parent::__construct();

		// Configure the view defaults.
		$this->load->library('ObservantView');
		// Load session data.
		$this->load->library('VmSession');
		// Load models.
		$this->load->model('Obr_Artist');
		$this->load->model('Obr_Audio');
		$this->load->model('Obr_Song');
		$this->load->model('Obr_Track');
		// Load helpers.
		$this->load->helper('model');
	}

	public function browse($artist_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$this->observantview->_set_artist_header($artist_id, 'Songs');
			$rsSongs = $this->Obr_Song->get_by_artist_id($artist_id);
			$this->mysmarty->assign('rsSongs', $rsSongs);
			$this->mysmarty->assign('artist_id', $artist_id);
		}

		$this->vmview->display('admin/obr_song_list.tpl');
	}

	public function view($song_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$rsSong = $this->Obr_Song->get($song_id);
			$this->observantview->_set_artist_header($rsSong->song_primary_artist_id, $rsSong->song_title);
			$this->mysmarty->assign('rsSong', $rsSong);
			$this->mysmarty->assign('song_id', $song_id);
		}

		$this->vmview->display('admin/obr_song_view.tpl');
	}

	public function add($artist_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			if (empty($this->vmview->section_head)) {
				$this->observantview->_set_artist_header($artist_id, 'Create a song');
			}
			$this->mysmarty->assign('artist_id', $artist_id);
		}

		$this->vmview->display('admin/obr_song_edit.tpl');
	}

	public function edit($song_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$rsSong = $this->Obr_Song->get($song_id);
			$this->observantview->_set_artist_header($rsSong->song_primary_artist_id, $rsSong->song_title);
			$this->mysmarty->assign('rsSong', $rsSong);
			$this->mysmarty->assign('song_id', $song_id);
		}

		$this->add($rsSong->song_primary_artist_id);
	}

	public function delete($song_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$rsSong = $this->Obr_Song->with('audio')->with('tracks')->get($song_id);
			$this->observantview->_set_artist_header($rsSong->song_primary_artist_id, $rsSong->song_title);
			$this->mysmarty->assign('rsSong', $rsSong);
			$this->mysmarty->assign('song_id', $song_id);
		}

		$this->vmview->display('admin/obr_song_delete.tpl');
	}

	public function create() {
		$redirect = $_SERVER['HTTP_REFERER'];
		$input = build_update_data($this->Obr_Song->_table);
		if (false !== ($song_id = $this->Obr_Song->insert($input))) {
			$redirect = '/index.php/admin/song/view/' . $song_id . '/';
			$this->phpsession->flashsave('msg', 'You successfully created a song.');
		} else {
			$this->phpsession->flashsave('error', 'You failed to create a song.');
		}

		header('Location: ' . $redirect);
		die();
	}

	public function update($song_id) {
		$redirect = $_SERVER['HTTP_REFERER'];
		$input = build_update_data($this->Obr_Song->_table);
		if (false !== $this->Obr_Song->update($song_id, $input)) {
			$redirect = '/index.php/admin/song/view/' . $song_id . '/';
			$this->phpsession->flashsave('msg', 'You successfully updated a song.');
		} else {
			$this->phpsession->flashsave('error', 'You failed to udpate a song.');
		}

		header('Location: ' . $redirect);
		die();
	}

	public function remove($song_id) {
		$confirm = $this->input->get_post('confirm');
		$redirect = $this->input->get_post('redirect');
		
		if ($confirm == true) {
			$rsSong = $this->Obr_Song->with('audio')->with('tracks')->get($song_id);
			$artist_id = $rsSong->song_primary_artist_id;
			
			// Remove audio.
			if (!empty($rsSong->audio)) {
				foreach ($rsSong->audio as $rsAudio) {
					$this->Obr_Audio->delete($rsAudio->audio_id);
				}
			}

			// Remove tracks.
			if (!empty($rsSong->tracks)) {
				foreach ($rsSong->tracks as $rsTrack) {
					$this->Obr_Track->delete($rsTrack->track_id);
				}
			}

			// Remove song.
			$this->Obr_Song->delete($song_id);

			$this->phpsession->flashsave('msg', 'Song was deleted.');
			$redirect = '/index.php/admin/song/browse/' . $artist_id . '/';
		} else {
			$this->phpsession->flashsave('msg', 'Deletion was canceled.');
		}
		
		header('Location: ' . $redirect);
	}

	public function save_lyrics($song_id)
	{
		$rsSong = $this->Obr_Song->get($song_id);
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
}

?>
