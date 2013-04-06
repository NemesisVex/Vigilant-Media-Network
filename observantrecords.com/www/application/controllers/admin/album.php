<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of album
 *
 * @author Greg Bueno
 */
class Album extends CI_Controller {
	
	public function __construct() {
		parent::__construct();

		$this->load->library('ObservantView');
		$this->load->library('VmSession');
		$this->load->model('Obr_Artist');
		$this->load->model('Obr_Album');
		$this->load->model('Obr_Album_Format');
	}
	
	public function browse($album_artist_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$rsAlbums = $this->Obr_Album->retrieve_by_artist_id($album_artist_id);
			$this->mysmarty->assign('rsAlbums', $rsAlbums);
		}
		
		$this->vmview->display('admin/obr_album_browse.tpl', true);
	}
	
	public function view($album_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$this->Obr_Album->set_config('fetch_releases', true);
			$rsAlbum = $this->Obr_Album->retrieve_by_id($album_id);
			$this->observantview->_set_artist_header($rsAlbum->album_artist_id, $rsAlbum->album_title);
			$this->mysmarty->assign('rsAlbum', $rsAlbum);
			
			$this->mysmarty->assign('album_id', $album_id);
		}
		
		$this->vmview->display('admin/obr_album_view.tpl', true);
	}
	
	public function add($album_artist_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			if (empty($this->vmview->section_head)) {
				$this->observantview->_set_artist_header($album_artist_id, 'Create an album');
			}
			
			$rsFormats = $this->Obr_Album_Format->retrieve_all();
			$this->mysmarty->assign('rsFormats', $rsFormats);
			
			$this->mysmarty->assign('album_artist_id', $album_artist_id);
		}
		
		$this->vmview->display('admin/obr_album_edit.tpl', true);
	}
	
	public function edit($album_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$rsAlbum = $this->Obr_Album->retrieve_by_id($album_id);
			$this->observantview->_set_artist_header($rsAlbum->album_artist_id, $rsAlbum->album_title);
			$this->mysmarty->assign('rsAlbum', $rsAlbum);
			$this->mysmarty->assign('album_id', $album_id);
		}
		
		$this->add($rsAlbum->album_artist_id);
	}
	
	public function delete($album_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$rsAlbum = $this->Obr_Album->retrieve_by_id($album_id);
			$this->observantview->_set_artist_header($rsAlbum->album_artist_id, $rsAlbum->album_title);
			$this->mysmarty->assign('rsAlbum', $rsAlbum);
			$this->mysmarty->assign($album_id);
		}
		
	}
	
	public function create() {
		$redirect = $_SERVER['HTTP_REFERER'];
		if (false !== ($album_id = $this->Obr_Album->create())) {
			$redirect = '/index.php/admin/album/view/' . $album_id . '/';
			$this->phpsession->flashsave('msg', 'You successfully created an album.');
		} else {
			$this->phpsession->flashsave('error', 'You failed to create an album.');
		}

		header('Location: ' . $redirect);
		die();
	}
	
	public function update($album_id) {
		$redirect = $_SERVER['HTTP_REFERER'];
		if (false !== $this->Obr_Album->update_by_id($album_id)) {
			$redirect = '/index.php/admin/album/view/' . $album_id . '/';
			$this->phpsession->flashsave('msg', 'You successfully updated an album.');
		} else {
			$this->phpsession->flashsave('error', 'You failed to update an album.');
		}

		header('Location: ' . $redirect);
		die();
	}
	
	public function remove() {
		
	}
}

?>
