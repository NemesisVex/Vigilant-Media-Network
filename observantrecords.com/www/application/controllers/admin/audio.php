<?php

/**
 * Description of audio
 *
 * @author Greg Bueno
 */
class Audio extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->library('MyId3');
		$this->load->library('ObservantView');
		$this->load->library('VmSession');
		$this->load->model('Obr_Artist');
		$this->load->model('Obr_Audio');

		$this->production_file_path = '/home/nemesisv/websites/prod/observantrecords.com/www';

		$this->myid3->setOption(array('encoding' => 'UTF-8'));
	}

	public function browse($artist_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$this->observantview->_set_artist_header($artist_id, 'Audio');
			$rsFiles = $this->Obr_Audio->retrieve_by_artist_id($artist_id);
			$this->mysmarty->assign('rsFiles', $rsFiles);
			$this->mysmarty->assign('artist_id', $artist_id);
		}

		$this->vmview->display('admin/obr_audio_list.tpl', true);
	}

	public function view($audio_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$rsFile = $this->Obr_Audio->retrieve_by_id($audio_id);
			$this->observantview->_set_artist_header($rsFile->audio_artist_id, $rsFile->song_title);
			$this->mysmarty->assign('rsFile', $rsFile);

			$this->mysmarty->assign('audio_id', $audio_id);

			if (!empty($rsFile))
			{
				$audio_full_path = $this->production_file_path . $rsFile->audio_mp3_file_path . '/' . $rsFile->audio_mp3_file_name;
				$audio_tags = $this->myid3->analyze($audio_full_path);

				if (!empty($audio_tags['tags'])) {
					$id3v1 = $audio_tags['tags']['id3v1'];
					$id3v2 = $audio_tags['tags']['id3v2'];

					$this->mysmarty->assign('id3v1', $id3v1);
					$this->mysmarty->assign('id3v2', $id3v2);
				}
			}
		}

		$this->vmview->display('admin/obr_audio_view.tpl', true);
	}

	public function add($artist_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			if (empty($this->vmview->section_head)) {
				$this->observantview->_set_artist_header($artist_id, 'Create audio file');
			}

			$rsArtists = $this->Obr_Artist->retrieve_all();
			$this->mysmarty->assign('rsArtists', $rsArtists);

			$this->mysmarty->assign('audio_artist_id', $artist_id);

			$rsSongs = $this->Obr_Song->retrieve_all();
			$this->mysmarty->assign('rsSongs', $rsSongs);
		}

		$this->vmview->display('admin/obr_audio_edit.tpl', true);
	}

	public function edit($audio_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$rsFile = $this->Obr_Audio->retrieve_by_id($audio_id);
			$this->observantview->_set_artist_header($rsFile->audio_artist_id, $rsFile->song_title);
			$this->mysmarty->assign('rsFile', $rsFile);
			$this->mysmarty->assign('audio_id', $audio_id);
		}

		$this->add($rsFile->audio_artist_id);
	}

	public function delete() {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {

		}

	}

	public function create() {
		$redirect = $_SERVER['HTTP_REFERER'];
		if (false !== ($audio_id = $this->Obr_Audio->create())) {
			$redirect = '/index.php/admin/audio/view/' . $audio_id . '/';
			$this->phpsession->flashsave('msg', 'You successfully created an audio file.');
		} else {
			$this->phpsession->flashsave('error', 'You failed to create an audio file.');
		}

		header('Location: ' . $redirect);
		die();
	}

	public function update($audio_id) {
		$redirect = $_SERVER['HTTP_REFERER'];
		if (false !== $this->Obr_Audio->update_by_id($audio_id)) {
			$redirect = '/index.php/admin/audio/view/' . $audio_id . '/';
			$this->phpsession->flashsave('msg', 'You successfully updated an audio file.');
		} else {
			$this->phpsession->flashsave('error', 'You failed to update an audio file.');
		}

		header('Location: ' . $redirect);
		die();
	}

	public function remove() {

	}
}

?>
