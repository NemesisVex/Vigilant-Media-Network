<?php

/**
 * Audio
 * 
 * Audio is a controller to maintain Observant Records audio files.
 *
 * @author Greg Bueno
 */
class Audio extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Configure the view defaults.
		$this->load->library('ObservantView');
		// Load session data.
		$this->load->library('VmSession');
		// Load MP3 tag editing library.
		$this->load->library('MyId3');
		// Load models.
		$this->load->model('Obr_Artist');
		$this->load->model('Obr_Audio');
		$this->load->model('Obr_Audio_Isrc');
		$this->load->model('Obr_Audio_Log');
		$this->load->model('Obr_Audio_Map');
		// Load helpers.
		$this->load->helper('model');

		$this->production_file_path = '/home/nemesisv/websites/prod/observantrecords.com/www';

		$this->myid3->setOption(array('encoding' => 'UTF-8'));
	}
	
	/**
	 * browse
	 * 
	 * browse() displays a list of audio files by an Observant Records artist.
	 * 
	 * @param type $artist_id
	 */
	public function browse($artist_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$this->observantview->_set_artist_header($artist_id, 'Audio');
			$rsFiles = $this->Obr_Audio->retrieve_by_artist_id($artist_id);
			$this->mysmarty->assign('rsFiles', $rsFiles);
			$this->mysmarty->assign('artist_id', $artist_id);
		}

		$this->vmview->display('admin/obr_audio_list.tpl', true);
	}
	
	/**
	 * view
	 * 
	 * view() lists the details of an individual audio file.
	 * 
	 * @param type $audio_id
	 */
	public function view($audio_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$rsFile = $this->Obr_Audio->with('song')->with('isrc')->get($audio_id);
			$this->observantview->_set_artist_header($rsFile->audio_artist_id, $rsFile->song->song_title);
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
	
	/**
	 * add
	 * 
	 * add() displays a form with which to create an audio file.
	 * 
	 * @param int $artist_id
	 */
	public function add($artist_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			if (empty($this->vmview->section_head)) {
				$this->observantview->_set_artist_header($artist_id, 'Create audio file');
			}

			$rsArtists = $this->Obr_Artist->get_all();
			$this->mysmarty->assign('rsArtists', $rsArtists);
			
			$this->mysmarty->assign('audio_artist_id', $artist_id);
			
			$this->Obr_Song->order_by('song_title');
			$rsSongs = $this->Obr_Song->get_all();
			$this->mysmarty->assign('rsSongs', $rsSongs);
		}

		$this->vmview->display('admin/obr_audio_edit.tpl', true);
	}
	
	/**
	 * edit
	 * 
	 * edit() displays a form with which to update an audio file.
	 * 
	 * @param type $audio_id
	 */
	public function edit($audio_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$rsFile = $this->Obr_Audio->with('song')->with('isrc')->get($audio_id);
			$this->observantview->_set_artist_header($rsFile->audio_artist_id, $rsFile->song->song_title);
			$this->mysmarty->assign('rsFile', $rsFile);
			$this->mysmarty->assign('audio_id', $audio_id);
		}

		$this->add($rsFile->audio_artist_id);
	}
	
	/**
	 * delete
	 * 
	 * delete() displays a form to confirm the deletion of an audio file.
	 * 
	 */
	public function delete($audio_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$rsAudio = $this->Obr_Audio->with('maps')->with('song')->get($audio_id);
			$this->observantview->_set_artist_header($rsAudio->audio_artist_id, $rsAudio->song->song_title);
			$this->mysmarty->assign('rsAudio', $rsAudio);
			$this->mysmarty->assign('audio_id', $audio_id);
		}

		$this->vmview->display('admin/obr_audio_delete.tpl');
	}
	
	/**
	 * generate_isrc
	 * 
	 * generate_isrc() is an AJAX callback method to return the next available
	 * ISRC code in a pool.
	 */
	public function generate_isrc() {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$audio_isrc_code = (object) array('isrc_code' => $this->Obr_Audio_Isrc->generate_code());
			echo json_encode($audio_isrc_code);
		}
	}
	
	/**
	 * create
	 * 
	 * create() saves changes made to a newly-added audio_file.
	 * 
	 */
	public function create() {
		$redirect = $_SERVER['HTTP_REFERER'];
		$audio_isrc_code = $this->input->get_post('audio_isrc_num');
		
		if (false !== ($audio_id = $this->Obr_Audio->create())) {
			if (!empty($audio_isrc_code)) {
				$this->Obr_Audio_Isrc->update('audio_isrc_code', $audio_isrc_code, array(
					'audio_isrc_audio_id' => $audio_id,
					));
			}
			$redirect = '/index.php/admin/audio/view/' . $audio_id . '/';
			$this->phpsession->flashsave('msg', 'You successfully created an audio file.');
		} else {
			$this->phpsession->flashsave('error', 'You failed to create an audio file.');
		}

		header('Location: ' . $redirect);
		die();
	}
	
	/**
	 * update
	 * 
	 * update() saves changes made to an audio file.
	 * 
	 * @param type $audio_id
	 */
	public function update($audio_id) {
		$redirect = $_SERVER['HTTP_REFERER'];
		$input = build_update_data($this->Obr_Audio->_table);
		$audio_isrc_code = $this->input->get_post('audio_isrc_num');
		
		if (false !== $this->Obr_Audio->update($audio_id, $input)) {
			if (!empty($audio_isrc_code)) {
				$this->Obr_Audio_Isrc->update_by('audio_isrc_code', $audio_isrc_code, array(
					'audio_isrc_audio_id' => $audio_id,
					));
			}
			
			$redirect = '/index.php/admin/audio/view/' . $audio_id . '/';
			$this->phpsession->flashsave('msg', 'You successfully updated an audio file.');
		} else {
			$this->phpsession->flashsave('error', 'You failed to update an audio file. ' . mysql_error());
		}

		header('Location: ' . $redirect);
		die();
	}
	
	/**
	 * remove
	 * 
	 * remove() performs a soft delete on an audio file.
	 * 
	 */
	public function remove($audio_id) {
		$confirm = $this->input->get_post('confirm');
		$redirect = $this->input->get_post('redirect');
		$remove_file = $this->input->get_post('remove_file');
		
		if ($confirm == true) {
			$rsAudio = $this->Obr_Audio->with('maps')->get($audio_id);
			$artist_id = $rsAudio->audio_artist_id;
			
			// Remove maps.
			$this->Obr_Audio_Map->delete_by('map_audio_id', $audio_id);
			
			// Remove log.
			$this->Obr_Audio_Log->delete_by('log_audio_id', $audio_id);
			
			// Remove audio.
			$this->Obr_Audio->delete($audio_id);
			
			$remove_file_message = null;
			if ($remove_file == true) {
				$audio_full_path = $this->production_file_path . $rsAudio->audio_mp3_file_path . '/' . $rsAudio->audio_mp3_file_name;
				if (file_exists($audio_full_path)) {
					if (ENVIRONMENT === 'production') {
						unlink($audio_file_path);
					}
					$remove_file_message .= ' File was removed from server.';
				}
			}

			$this->phpsession->flashsave('msg', 'Audio file was deleted.' . $remove_file_message);
			$redirect = '/index.php/admin/audio/browse/' . $artist_id . '/';
		} else {
			$this->phpsession->flashsave('msg', 'Deletion was canceled.');
		}
		
		header('Location: ' . $redirect);
	}
}
