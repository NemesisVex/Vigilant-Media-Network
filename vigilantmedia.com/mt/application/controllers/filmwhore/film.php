<?php

class Film extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('MtLib');
		$this->load->library('MyAmazon');
		$this->load->model('Mt_mw_film_model');
		$this->mysmarty->assign('session', $this->phpsession);
		$this->mtlib->mt_config['amazon_locale'] = $this->myamazon->amazon_locale;
	}
	
	// View methods
	
	function index()
	{
		header('Location: /index.php/mt/filmwhore/');
	}
	
	function get()
	{
		$film_id = $this->input->get_post('film_id');
		header('Location: /index.php/filmwhore/film/info/' . $film_id . '/');
	}
	
	function options()
	{
		$this->mtlib->_format_section_head('Filmwhore.org', 'Main administration', 'Add a film');
		$this->mtlib->_smarty_display_mt_page('mt_filmwhore_film_options.tpl');
	}
	
	function info($film_id)
	{
		$rsFilm = $this->mtlib->_format_fw_section_head($film_id);
		$film_title = $this->vigilantecorelib->format_film_title_object($rsFilm);
		
		$this->mysmarty->assign('film_id', $film_id);
		$this->mysmarty->assign('film_title', $film_title);
		$this->mysmarty->assign('rsFilm', $rsFilm);
		$this->mtlib->_smarty_display_mt_page('mt_filmwhore_film_info.tpl');
	}
	
	function add()
	{
		$this->mtlib->_format_section_head('Filmwhore.org', 'Main administration', 'Add a film');
		$this->mtlib->_smarty_display_mt_page('mt_filmwhore_film_edit.tpl');
	}
	
	function edit($film_id, $template = 'mt_filmwhore_film_edit.tpl', $header = 'Edit film')
	{
		$rsFilm = $this->mtlib->_format_fw_section_head($film_id, $header);
		
		if (!empty($rsFilm))
		{
			foreach ($rsFilm as $field => $value)
			{
				$this->mysmarty->assign($field, $value);
			}
		}
		
		$this->mysmarty->assign('film_id', $film_id);
		$this->mysmarty->assign('rsFilm', $rsFilm);
		$this->mtlib->_smarty_display_mt_page($template);
	}
	
	function delete($film_id)
	{
		$this->edit($film_id, 'mt_filmwhore_film_delete.tpl', 'Delete a film');
	}
	
	// Processing methods
	
	function update($film_id)
	{
		$rsFilm = $this->Mt_mw_film_model->get_film_by_id($film_id);
		$input = $this->vigilantedblib->_db_build_update_data($rsFilm);
		$film_title = $this->input->get_post('film_title');
		
		if (!empty($input))
		{
			$input['film_id'] = $film_id;
			if (false !== $this->Mt_mw_film_model->update_film_by_id($film_id, $input))
			{
				$this->phpsession->flashsave('msg', '<em>' . $film_title . '</em> was updated.');
			}
		}
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		die();
	}
	
	function create()
	{
		$rsArtist = $this->db->get('mw_artists', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsArtist);
		$film_title = $this->input->get_post('film_title');
		
		if (false !== $this->Mt_mw_film_model->add_film($input))
		{
			$this->phpsession->flashsave('msg', '<em>' . $film_title . '</em> was created.');
			$film_id = $this->db->insert_id();
		}
		
		header('Location: /index.php/filmwhore/film/info/' . $film_id . '/');
		die();
	}
	
	function remove($film_id)
	{
		$confirm = $this->input->get_post('confirm');
		$film_title = $this->input->get_post('film_title');
		
		if ($confirm == 'Yes')
		{
			$this->Mt_mw_film_model->delete_film_by_id($film_id);
			
			$this->phpsession->flashsave('msg', '<em>' . $film_title . '</em> was deleted.');
			header('Location: /index.php/mt/musicwhore/');
		}
		elseif ($confirm == 'No')
		{
			$this->phpsession->flashsave('msg', '<em>' . $film_title . '</em> was not deleted.');
			header('Location: /index.php/filmwhore/film/info/' . $film_id . '/');
		}
		
		die();
	}
}

?>