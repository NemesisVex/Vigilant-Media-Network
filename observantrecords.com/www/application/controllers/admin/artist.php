<?php

/**
 * Artist
 * 
 * Artist is a controller for maintaining Observant Records artists.
 *
 * @author Greg Bueno
 */
class Artist extends CI_Controller
{
	/**
	 * Artist is a controller for maintaining Observant Records artists.
	 */
	public function __construct() {
		parent::__construct();
		
		// Configure the view defaults.
		$this->load->library('ObservantView');
		// Load session data.
		$this->load->library('VmSession');
		// Load models.
		$this->load->model('Obr_Artist');
		$this->load->model('Obr_Album');
		// Load helpers.
		$this->load->helper('model');
	}
	
	/**
	 * browse
	 * 
	 * browse() displays a list of Observant Records artists.
	 */
	public function browse() {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$this->vmview->format_section_head('Artists');
			
			$rsArtists = $this->Obr_Artist->get_all();
			$this->mysmarty->assign('rsArtists', $rsArtists);
		}

		$this->vmview->display('admin/obr_artist_list.tpl', true);
	}
	
	/**
	 * view
	 * 
	 * view() lists the details of an individual Observant Records artist.
	 * 
	 * @param int $artist_id
	 */
	public function view($artist_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			// Retrieve artist info.
			$rsArtist = $this->Obr_Artist->get($artist_id);
			
			$this->mysmarty->assign('rsArtist', $rsArtist);
			$this->vmview->format_section_head($rsArtist->artist_display_name);
			
			$this->Obr_Album->set_config('fetch_releases', false);
			$rsAlbums = $this->Obr_Album->retrieve_by_artist_id($artist_id);
			$this->mysmarty->assign('rsAlbums', $rsAlbums);
			
			$this->mysmarty->assign('artist_id', $artist_id);
		}

		$this->vmview->display('admin/obr_artist_view.tpl', true);
	}
	
	/**
	 * add
	 * 
	 * add() displays a form with which to create an Observant Records artist.
	 */
	public function add() {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			if (empty($this->vmview->section_head)) {
				$this->vmview->format_section_head('Create an artist');
			}
		}
		
		$this->vmview->display('admin/obr_artist_edit.tpl', true);
	}
	
	/**
	 * edit
	 * 
	 * edit() displays a form with which to update an Observant Records artist.
	 * 
	 * @param int $artist_id
	 */
	public function edit($artist_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$rsArtist = $this->Obr_Artist->get($artist_id);
			$this->vmview->format_section_head($rsArtist->artist_display_name);
			$this->mysmarty->assign('rsArtist', $rsArtist);
			$this->mysmarty->assign('artist_id', $artist_id);
		}

		$this->add();
	}
	
	/**
	 * delete
	 * 
	 * delete() displays a form to confirm the deletion of an Observant Records
	 * artist.
	 * 
	 * @param int $artist_id
	 */
	public function delete($artist_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$rsArtist = $this->Obr_Artist->get($artist_id);
			$this->vmview->format_section_head($rsArtist->artist_display_name);
			$this->mysmarty->assign('rsArtist', $rsArtist);
			$this->mysmarty->assign('artist_id', $artist_id);
		}
		
		$this->vmview->display('admin/obr_artist_delete.tpl', true);
	}
	
	/**
	 * create
	 * 
	 * create() saves changes made to a newly-added Observant Records artist.
	 * 
	 */
	public function create() {
		$redirect = $_SERVER['HTTP_REFERER'];
		$input = build_update_data($this->Obr_Artist->_table);
		if (false !== ($artist_id = $this->Obr_Artist->insert($input))) {
			$redirect = '/index.php/admin/artist/view/' . $artist_id . '/';
			$this->phpsession->flashsave('msg', 'You successfully created an artist.');
		} else {
			$this->phpsession->flashsave('error', 'You failed to create an artist.');
		}

		header('Location: ' . $redirect);
		die();
	}
	
	/**
	 * update
	 * 
	 * update() saves changes made to an Observant Records artist.
	 * 
	 * @param int $artist_id
	 */
	public function update($artist_id) {
		$redirect = $_SERVER['HTTP_REFERER'];
		$input = build_update_data($this->Obr_Artist->_table);
		if (false !== $this->Obr_Artist->update($artist_id, $input)) {
			$redirect = '/index.php/admin/artist/view/' . $artist_id . '/';
			$this->phpsession->flashsave('msg', 'You successfully updated an artist.');
		} else {
			$this->phpsession->flashsave('error', 'You failed to create an artist.');
		}

		header('Location: ' . $redirect);
		die();
	}

	/**
	 * remove
	 * 
	 * remove() performs a soft delete on an artist and his/her works.
	 * 
	 * @param int $artist_id
	 */
	public function remove($artist_id) {
		// Remove audio.
		
		// Remove tracks.
		
		// Remove releases.
		
		// Remove albums.
		
		// Remove artist.

	}
}

?>
