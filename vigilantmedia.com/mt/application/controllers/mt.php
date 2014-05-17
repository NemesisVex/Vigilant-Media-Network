<?php

class Mt extends CI_Controller
{
	var $webmaster_email = 'greg@gregbueno.com';
	var $per_page = 10;
	var $error_codes = array('401' => 'authentication required', '403' => 'forbidden', '404' => 'not found', '500' => 'internal server error');
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('MtLib');
		$this->load->library('pagination');
		$this->mysmarty->assign('session', $this->phpsession);
	}
	
	// View methods
	
	function index()
	{
		$this->mtlib->section_head = 'Central administration';
		$this->mtlib->section_label = 'Main administration';
		$this->mtlib->_smarty_display_mt_page('mt_root_index.tpl');
	}
	
	function php_info()
	{
		phpinfo();
	}
	
	function user_log()
	{
		$this->load->model('Mt_user_model');
		
		$this->mtlib->section_head = 'Central administration';
		$this->mtlib->section_label = 'Main administration';
		
		$offset = $this->uri->segment(3);
		$per_page = 50;
		
		$rowLogs = $this->Mt_user_model->get_user_log();
		$total_rows = $rowLogs->num_rows();
		
		$page_config['base_url'] = '/index.php/mt/user_log/';
		$page_config['total_rows'] = $total_rows;
		$page_config['per_page'] = $per_page;
		$page_config['uri_segment'] = 3;
		$page_config['num_links'] = 5;
		$this->pagination->initialize($page_config);
		
		$page_links = $this->pagination->create_links();
		
		$rsLogs = $this->vigilantedblib->_db_return_smarty_array($rowLogs, $per_page, $offset);
		
		$this->mysmarty->assign('page_links', $page_links);
		$this->mysmarty->assign('rsLogs', $rsLogs);
		$this->mtlib->_smarty_display_mt_page('mt_root_user_log.tpl');
	}
	
	function audio_log()
	{
		$this->load->model('Mt_ep4_audio_model');
		
		$this->mtlib->section_head = 'Central administration';
		$this->mtlib->section_label = 'Main administration';
		
		$offset = $this->uri->segment(3);
		$per_page = 50;
		
		$rowLogs = $this->Mt_ep4_audio_model->get_user_log();
		$total_rows = $rowLogs->num_rows();
		
		$page_config['base_url'] = '/index.php/mt/audio_log/';
		$page_config['total_rows'] = $total_rows;
		$page_config['per_page'] = $per_page;
		$page_config['uri_segment'] = 3;
		$page_config['num_links'] = 5;
		$this->pagination->initialize($page_config);
		
		$page_links = $this->pagination->create_links();
		
		$rsLogs = $this->vigilantedblib->_db_return_smarty_array($rowLogs, $per_page, $offset);
		
		$this->mysmarty->assign('page_links', $page_links);
		$this->mysmarty->assign('rsLogs', $rsLogs);
		$this->mtlib->_smarty_display_mt_page('mt_root_user_log.tpl');
	}
	
	function ep4()
	{
		$this->load->model('Mt_ep4_artist_model');
		$this->load->model('Mt_ep4_song_model');
		$this->load->model('Mt_ep4_file_model');
		
		$this->mtlib->_format_section_head('Observant Records', 'Main administration');
		
		$rowArtists = $this->Mt_ep4_artist_model->get_all_artists();
		$rsArtists = $this->vigilantedblib->_db_return_smarty_array($rowArtists);
		$this->mysmarty->assign('rsArtists', $rsArtists);
		
		$rowSongs = $this->Mt_ep4_song_model->get_all_songs();
		$rsSongs = $this->vigilantedblib->_db_return_smarty_array($rowSongs);
		$this->mysmarty->assign('rsSongs', $rsSongs);
		
		$rsObrFiles = $this->Mt_ep4_file_model->get_files();
		$this->mysmarty->assign('rsObrFiles', $rsObrFiles);
		
		$this->mtlib->_smarty_display_mt_page('mt_ep4_artist.tpl');
	}
	
	function austinstories()
	{
		$this->load->model('Mt_user_model');
		
		$per_page = 50;
		$offset = $this->uri->segment(3);
		
		$this->mtlib->_format_section_head('Austin Stories', 'Main administration');
		
		$rowUsers = $this->Mt_user_model->get_user_by_access_mask(8);
		$total_rows = $rowUsers->num_rows();
		
		$page_config['base_url'] = '/index.php/mt/austinstories/';
		$page_config['total_rows'] = $total_rows;
		$page_config['per_page'] = $per_page;
		$page_config['uri_segment'] = 3;
		$page_config['num_links'] = 5;
		$this->pagination->initialize($page_config);
		
		$page_links = $this->pagination->create_links();
		
		$rsUsers = $this->vigilantedblib->_db_return_smarty_array($rowUsers, $per_page, $offset);
		
		$this->mysmarty->assign('page_links', $page_links);
		$this->mysmarty->assign('rsUsers', $rsUsers);
		$this->mtlib->_smarty_display_mt_page('mt_austinstories.tpl');
	}
	
	function musicwhore($filter = 'a')
	{
		$this->mtlib->section_head = 'Musicwhore.org';
		$this->mtlib->section_label = 'Main administration';
		
		$this->load->model('Mt_mw_artist_model');
		
		$rowArtists = $this->Mt_mw_artist_model->get_all_artists($filter);
		$rsArtists = $this->vigilantedblib->_db_return_smarty_array($rowArtists);
		
		$rowNav = $this->Mt_mw_artist_model->get_all_artists_group_by_initial();
		$rsNav = $this->vigilantedblib->_db_return_smarty_array($rowNav);
		
		$this->mysmarty->assign('rsArtists', $rsArtists);
		$this->mysmarty->assign('rsNav', $rsNav);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore.tpl');
	}
	
	function filmwhore($filter = 'a')
	{
		$this->mtlib->section_head = 'Filmwhore.org';
		$this->mtlib->section_label = 'Main administration';
		
		$this->load->model('Mt_mw_film_model');
		
		$rowFilms = $this->Mt_mw_film_model->get_all_films($filter);
		$rsFilms = $this->vigilantedblib->_db_return_smarty_array($rowFilms);
		
		$rowNav = $this->Mt_mw_film_model->get_all_films_group_by_initial();
		$rsNav = $this->vigilantedblib->_db_return_smarty_array($rowNav);
		
		$this->mysmarty->assign('rsFilms', $rsFilms);
		$this->mysmarty->assign('rsNav', $rsNav);
		$this->mtlib->_smarty_display_mt_page('mt_filmwhore.tpl');
	}

	function ddn()
	{
		$this->mtlib->_format_section_head('Duran Duran Networks', 'Main administration');

		$this->mtlib->_smarty_display_mt_page('mt_ddn.tpl');
	}
	
	function unicode()
	{
		$this->mtlib->section_head = 'Central administration';
		$this->mtlib->section_label = 'Convert Unicode text';
		
		$this->mtlib->_smarty_display_mt_page('mt_root_unicode_encoding.tpl');
	}
	
	function unicode_encoding()
	{
		$encoding = $this->input->get_post('encoding');
		
		$this->mtlib->section_head = 'Central administration';
		$this->mtlib->section_label = 'Convert Unicode text';
		
		$this->mysmarty->assign('encoding', $encoding);
		$this->mysmarty->assign('charset', $encoding);
		
		$this->mtlib->_smarty_display_mt_page('mt_root_unicode_text.tpl', $encoding);
	}
	
	function unicode_text()
	{
		$encoding = $this->input->get_post('encoding');
		$text = $this->input->get_post('text');
		
		$this->mtlib->section_head = 'Central administration';
		$this->mtlib->section_label = 'Convert Unicode text';
		
		$display_text = $this->vigilantecorelib->parse_line_breaks($text);
		$convert_text = $this->vigilantecorelib->parse_line_breaks(htmlentities($text, ENT_NOQUOTES, 'ISO-8859-1'));
		
		$this->mysmarty->assign('encoding', 'ISO-8859-1');
		$this->mysmarty->assign('charset', $encoding);
		
		$this->mysmarty->assign('text', $text);
		$this->mysmarty->assign('display_text', $display_text);
		$this->mysmarty->assign('convert_text', $convert_text);
		
		$this->mtlib->_smarty_display_mt_page('mt_root_unicode_results.tpl', $encoding);
	}
	
	function error($code)
	{
		$this->page_title = 'error &raquo; ' . $code . ' &raquo; ' . $this->error_codes[$code];
		$this->mtlib->_smarty_display_mt_page('mt_error_' . $code . '.tpl');
	}
	
	// Processing methods
	
	// Private methods
}

?>