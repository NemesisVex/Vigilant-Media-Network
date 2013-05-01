<?php

/**
 * Artist
 *
 * @author Greg Bueno
 */
class Artist extends CI_Controller
{
	public function __construct() {
		parent::__construct();

		$this->load->library('ObservantView');
		$this->load->library('VmSession');
		$this->load->model('Obr_Artist');
		$this->load->model('Obr_Album');
	}
	
	public function browse() {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$this->vmview->format_section_head('Artists');
			
			$rsArtists = $this->Obr_Artist->retrieve_all();
			$this->mysmarty->assign('rsArtists', $rsArtists);
		}

		$this->vmview->display('admin/obr_artist_list.tpl', true);
	}
	
	public function view($artist_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$rsArtist = $this->Obr_Artist->retrieve_by_id($artist_id);
			$this->mysmarty->assign('rsArtist', $rsArtist);
			$this->vmview->format_section_head($rsArtist->artist_display_name);
			
			$this->Obr_Album->set_config('fetch_releases', false);
			$rsAlbums = $this->Obr_Album->retrieve_by_artist_id($artist_id);
			$this->mysmarty->assign('rsAlbums', $rsAlbums);
			
			$this->mysmarty->assign('artist_id', $artist_id);
		}

		$this->vmview->display('admin/obr_artist_view.tpl', true);
	}

	public function add() {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			if (empty($this->vmview->section_head)) {
				$this->vmview->format_section_head('Create an artist');
			}
		}
		
		$this->vmview->display('admin/obr_artist_edit.tpl', true);
	}

	public function edit($artist_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$rsArtist = $this->Obr_Artist->retrieve_by_id($artist_id);
			$this->vmview->format_section_head($rsArtist->artist_display_name);
			$this->mysmarty->assign('rsArtist', $rsArtist);
			$this->mysmarty->assign('artist_id', $artist_id);
		}

		$this->add();
	}
	
	public function delete($artist_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$rsArtist = $this->Obr_Artist->retrieve_by_id($artist_id);
			$this->vmview->format_section_head($rsArtist->artist_display_name);
			$this->mysmarty->assign('rsArtist', $rsArtist);
			$this->mysmarty->assign('artist_id', $artist_id);
		}
		
		$this->vmview->display('', true);
	}

	public function create() {
		$redirect = $_SERVER['HTTP_REFERER'];
		if (false !== ($artist_id = $this->Obr_Artist->create())) {
			$redirect = '/index.php/admin/artist/view/' . $artist_id . '/';
			$this->phpsession->flashset('msg', 'You successfully created an artist.');
		} else {
			$this->phpsession->flashset('error', 'You failed to create an artist.');
		}

		header('Location: ' . $redirect);
		die();
	}

	public function update($artist_id) {
		$redirect = $_SERVER['HTTP_REFERER'];
		if (false !== $this->Obr_Artist->update_by_id($artist_id)) {
			$redirect = '/index.php/admin/artist/view/' . $artist_id . '/';
			$this->phpsession->flashsave('msg', 'You successfully updated an artist.');
		} else {
			$this->phpsession->flashsave('error', 'You failed to create an artist.');
		}

		header('Location: ' . $redirect);
		die();
	}

	public function remove($artist_id) {

	}
}

?>
