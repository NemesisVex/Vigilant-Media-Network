<?php

/**
 * Description of song
 *
 * @author Greg Bueno
 */
class Song extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->library('ObservantView');
		$this->load->library('VmSession');
		$this->load->model('Obr_Artist');
		$this->load->model('Obr_Song');
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
			$rsSong = $this->Obr_Song->get($song_id);
			$this->observantview->_set_artist_header($rsSong->song_primary_artist_id, $rsSong->song_title);
			$this->mysmarty->assign('rsAlbum', $rsSong);
			$this->mysmarty->assign('song_id', $song_id);
		}

	}

	public function create() {
		$redirect = $_SERVER['HTTP_REFERER'];
		if (false !== ($song_id = $this->Obr_Song->create())) {
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
		if (false !== $this->Obr_Song->update_by_id($song_id)) {
			$redirect = '/index.php/admin/song/view/' . $song_id . '/';
			$this->phpsession->flashsave('msg', 'You successfully updated a song.');
		} else {
			$this->phpsession->flashsave('error', 'You failed to udpate a song.');
		}

		header('Location: ' . $redirect);
		die();
	}

	public function remove() {

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
