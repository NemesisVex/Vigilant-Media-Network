<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MtLib
{
	var $page_title = 'Central Administration';
	var $section_head;
	var $section_label;
	var $section_sublabel;
	var $mt_config;
	var $google_map_key = 'ABQIAAAAenOcDWY3GB5qVSPOQiBt_xQB1EnTXPr4XWEEqW2K_PtACNY_fxR8nN7paOqcMjPWEwbPP2dj1DgdxA';

	function __construct()
	{
		$CI =& get_instance();
		switch (ENVIRONMENT)
		{
			case 'development':
				$this->mt_config['to_vigilantmedia'] = 'http://dev.vigilantmedia.com';
				$this->mt_config['to_vigilante'] = 'http://dev.vigilante.vigilantmedia.com';
				$this->mt_config['to_gregbueno'] = 'http://dev.gregbueno.com';
				$this->mt_config['to_eponymous4'] = 'http://dev.eponymous4.com';
				$this->mt_config['ep4_mp3_file_root'] = OBSERVANTRECORDS_MP3_PATH;
				$this->mt_config['ep4_cover_root_path'] = OBSERVANTRECORDS_COVERS_PATH_DEV;
				//$this->mt_config['google_map_key'] = 'ABQIAAAAenOcDWY3GB5qVSPOQiBt_xRYgBa5qr4ok_UN7j0bcQkTnH7_0hQ7D7lmeKWY1Ws1kmvAwIeusA1jGg';
				$this->mt_config['google_map_key'] = $this->google_map_key;
				break;
			case 'testing':
				$this->mt_config['to_vigilantmedia'] = 'http://test.vigilantmedia.com';
				$this->mt_config['to_vigilante'] = 'http://test.vigilante.vigilantmedia.com';
				$this->mt_config['to_gregbueno'] = 'http://test.gregbueno.com';
				$this->mt_config['to_eponymous4'] = 'http://test.eponymous4.com';
				$this->mt_config['ep4_mp3_file_root'] = OBSERVANTRECORDS_MP3_PATH;
				$this->mt_config['ep4_cover_root_path'] = OBSERVANTRECORDS_COVERS_PATH_TEST;
				$this->mt_config['google_map_key'] = $this->google_map_key;
				break;
			case 'production':
				$this->mt_config['to_vigilantmedia'] = 'http://www.vigilantmedia.com';
				$this->mt_config['to_vigilante'] = 'http://vigilante.vigilantmedia.com';
				$this->mt_config['to_gregbueno'] = 'http://www.gregbueno.com';
				$this->mt_config['to_eponymous4'] = 'http://www.eponymous4.com';
				$this->mt_config['ep4_mp3_file_root'] = OBSERVANTRECORDS_MP3_PATH;
				$this->mt_config['ep4_cover_root_path'] = OBSERVANTRECORDS_COVERS_PATH_PROD;
				$this->mt_config['google_map_key'] = $this->google_map_key;
				break;
		}

		$this->mtconfig['sites']['8'] = array('site_name' => 'Austin Stories', 'site_alias' => 'as');
		$this->mtconfig['sites']['64'] = array('site_name' => 'Gregbueno.com', 'site_alias' => 'gb');
	}

	// Private methods
	function _smarty_display_mt_page($page, $charset = 'utf-8')
	{
		$CI =& get_instance();

		$CI->mysmarty->assign('config', $this->mt_config);
		$CI->mysmarty->assign('page_title', $this->page_title);
		$CI->mysmarty->assign('section_head', $this->section_head);
		$CI->mysmarty->assign('section_label', $this->section_label);
		$CI->mysmarty->assign('section_sublabel', $this->section_sublabel);
		$CI->vigilantesmartylib->_smarty_display_protected_page('root_content', $page, 'mt_root_content.tpl', 'mt_global_page.tpl', 'mt_global_layout.tpl', $charset);
	}

	function _format_ep4_section_head($artist_id = '', $section_sublabel = '')
	{
		$CI =& get_instance();

		$this->section_head = 'Observant Records';
		$this->page_title .= ' &#8212; Observant Records';

		if (!empty($artist_id))
		{
			$rsArtist = $this->_format_music_section_head($artist_id, 'Mt_ep4_artist_model', $section_sublabel);
			return $rsArtist;
		}
	}

	function _format_mw_section_head($artist_id = '', $section_sublabel = '')
	{
		$CI =& get_instance();

		$this->section_head = 'Musicwhore.org';
		$this->page_title .= ' &#8212; Musicwhore.org';

		if (!empty($artist_id))
		{
			$rsArtist = $this->_format_music_section_head($artist_id, 'Mt_mw_artist_model', $section_sublabel);
			return $rsArtist;
		}
	}

	function _format_music_section_head($artist_id, $model = 'Mt_ep4_artist_model', $section_sublabel = '')
	{
		$CI =& get_instance();

		$rsArtist = $CI->$model->get_artist_by_id($artist_id);
		if (!empty($rsArtist))
		{
			$artist_name = $CI->vigilantecorelib->format_artist_name_object($rsArtist);

			$this->section_label = $artist_name;
			$this->page_title .= ' &#8212; ' . $artist_name;
			if ($section_sublabel)
			{
				$this->page_title .= ' &#8212; ' . $section_sublabel;
				$this->section_sublabel = $section_sublabel;
			}
			return $rsArtist;
		}
		else
		{
			if ($section_sublabel)
			{
				$this->page_title .= ' &#8212; ' . $section_sublabel;
				$this->section_label = $section_sublabel;
			}
		}
	}

	function _format_fw_section_head($film_id, $section_sublabel = '')
	{
		$CI =& get_instance();

		$this->section_head = 'Filmwhore.org';
		$this->page_title .= ' &#8212; Filmwhore.org';

		$rsFilm = $CI->Mt_mw_film_model->get_film_by_id($film_id);
		if (!empty($rsFilm))
		{
			$film_title = $CI->vigilantecorelib->format_film_title_object($rsFilm);

			$this->section_label = $film_title;
			$this->page_title .= ' &#8212; ' . $film_title;
			if ($section_sublabel)
			{
				$this->page_title .= ' &#8212; ' . $section_sublabel;
				$this->section_sublabel = $section_sublabel;
			}
			return $rsFilm;
		}
		else
		{
			if ($section_sublabel)
			{
				$this->page_title .= ' &#8212; ' . $section_sublabel;
				$this->section_label = $section_sublabel;
			}
		}
	}

	function _format_austinstories_section_head($user_id = '', $section_sublabel = '')
	{
		$CI =& get_instance();

		$this->section_head = 'Austin Stories';
		$this->page_title .= ' &#8212; Austin Stories';

		if (false !== ($rsUser = $CI->Mt_user_model->get_user_by_id($user_id)))
		{
			$user_name = $rsUser->user_login;

			$this->section_label = $user_name;
			$this->page_title .= ' &#8212; ' . $user_name;
			if ($section_sublabel)
			{
				$this->page_title .= ' &#8212; ' . $section_sublabel;
				$this->section_sublabel = $section_sublabel;
			}
			return $rsUser;
		}
		else
		{
			$this->section_label = 'Member administration';
		}
	}

	function _format_ddn_section_head($section_label = '', $section_sublabel = '')
	{
		$this->_format_section_head('Duran Duran Networks', $section_label, $section_sublabel);
	}

	function _format_ecommerce_section_head($section_label = 'Ecommerce administration', $section_sublabel = '')
	{
		$this->_format_section_head('Central administration', $section_label, $section_sublabel);
	}

	function _format_members_section_head($section_label = 'Members administration', $section_sublabel = '')
	{
		$this->_format_section_head('Central administration', $section_label, $section_sublabel);
	}

	function _format_section_head($section_head = 'Central administration', $section_label = '', $section_sublabel = '')
	{
		$this->section_head = $section_head;
		$this->section_label = $section_label;
		$this->section_sublabel = $section_sublabel;

		$this->page_title .= ' &#8212; ' . $section_head . ' &#8212; ' . $section_label;
	}

	function _lookup_asin($asin = '', $locale = 'us', $response_group = 'ItemAttributes')
	{
		$CI =& get_instance();

		$params['ResponseGroup'] = $response_group;

		$CI->myamazon->__construct($locale);
		$CI->myamazon->item_lookup($asin, $params);
		//$CI->vigilantecorelib->debug_trace('<a href="' . $CI->myamazon->auth_request_uri . '">XML URL</a>');
		$results = $CI->myamazon->results;

		$CI->mysmarty->assign('request_uri', $CI->myamazon->auth_request_uri);
		$CI->mysmarty->assign('locale', $locale);
		return $results;
	}
}
?>