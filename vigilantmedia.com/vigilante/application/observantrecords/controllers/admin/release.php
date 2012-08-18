<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of release
 *
 * @author Greg Bueno
 */
class Release extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->library('ObservantView');
		$this->load->library('VmSession');
		$this->load->model('Obr_Artist');
		$this->load->model('Obr_Album');
		$this->load->model('Obr_Release');
	}
	
	public function browse($release_album_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			
		}
		
		$this->vmview->display('', true);
	}
	
	public function view($release_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$this->Obr_Release->set_config('fetch_tracks', true);
			$rsRelease = $this->Obr_Release->retrieve_by_id($release_id);
			
			$this->mysmarty->assign('rsRelease', $rsRelease);
			$this->mysmarty->assign('release_id', $release_id);
			
			$this->observantview->_set_artist_header($rsRelease->album_artist_id, $rsRelease->album_title);
		}
		
		$this->vmview->display('admin/obr_release_view.tpl', true);
	}
	
	public function add($album_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			if (empty($this->vmview->section_head)) {
				$rsAlbum = $this->Obr_Album->retrieve_by_id($album_id);
				$this->observantview->_set_artist_header($rsAlbum->album_artist_id, $rsAlbum->album_title);
			}
		}
		
		$this->vmview->display('admin/obr_release_edit.tpl', true);
	}
	
	public function edit($release_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$rsRelease = $this->Obr_Release->retrieve_by_id($release_id);
			$this->observantview->_set_artist_header($rsRelease->album_artist_id, $rsRelease->album_title);
			$this->mysmarty->assign('rsRelease', $rsRelease);
		}
		
		$this->add($rsRelease->release_album_id);
	}
	
	public function delete() {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			
		}
		
	}
	
	public function create() {
		$redirect = $_SERVER['HTTP_REFERER'];
		if (false !== ($artist_id = $this->Obr_Release->create())) {
			$redirect = '/index.php/admin/artist/view/' . $artist_id . '/';
			$this->phpsession->flashset('msg', 'You successfully created an album.');
		} else {
			$this->phpsession->flashset('error', 'You failed to create an album.');
		}

		header('Location: ' . $redirect);
		die();
	}
	
	public function update() {
		$redirect = $_SERVER['HTTP_REFERER'];
		if (false !== $this->Obr_Release->update_by_id($artist_id)) {
			$redirect = '/index.php/admin/artist/view/' . $artist_id . '/';
			$this->phpsession->flashsave('msg', 'You successfully updated an artist.');
		} else {
			$this->phpsession->flashsave('error', 'You failed to create an artist.');
		}

		header('Location: ' . $redirect);
		die();
	}
	
	public function remove() {
		
	}
}

?>
