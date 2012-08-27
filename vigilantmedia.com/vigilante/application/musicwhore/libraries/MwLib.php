<?php

class MwLib
{
	var $webmaster_email = 'greg@gregbueno.com';
	var $page_title;
	var $section_head;
	var $section_label;
	var $section_sublabel;
	var $mw_config = array();
	var $blog_id = 8;

	function __construct()
	{
		$CI =& get_instance();
		switch (ENVIRONMENT)
		{
			case 'development':
				$this->mw_config['to_vigilante'] = 'http://dev.vigilante.vigilantmedia.com';
				$this->mw_config['to_gregbueno'] = 'http://dev.dev.gregbueno.com';
				$this->mw_config['to_archive'] = 'http://dev.archive.musicwhore.org';
				$this->mw_config['to_musicwhore'] = 'http://dev.musicwhore.org';
				$this->mw_config['to_filmwhore'] = 'http://dev.film.musicwhore.org';
				$this->mw_config['to_tvwhore'] = 'http://dev.tv.musicwhore.org';
				$this->mw_config['to_eponymous4'] = 'http://dev.eponymous4.com';
				$this->mw_config['to_mt'] = 'http://dev.mt.vigilantmedia.com';
				$this->mw_config['img_artist_root'] = MUSICWHORE_IMAGES_ARTISTS_PATH_DEV;
				$this->mw_config['img_discog_root'] = MUSICWHORE_IMAGES_DISCOG_PATH_DEV;
				break;
			case 'testing':
				$this->mw_config['to_vigilante'] = 'http://test.vigilante.vigilantmedia.com';
				$this->mw_config['to_gregbueno'] = 'http://test.gregbueno.com';
				$this->mw_config['to_archive'] = 'http://test.archive.musicwhore.org';
				$this->mw_config['to_musicwhore'] = 'http://test.musicwhore.org';
				$this->mw_config['to_filmwhore'] = 'http://test.film.musicwhore.org';
				$this->mw_config['to_tvwhore'] = 'http://test.tv.musicwhore.org';
				$this->mw_config['to_eponymous4'] = 'http://test.eponymous4.com';
				$this->mw_config['to_mt'] = 'http://test.mt.vigilantmedia.com';
				$this->mw_config['img_artist_root'] = MUSICWHORE_IMAGES_ARTISTS_PATH_TEST;
				$this->mw_config['img_discog_root'] = MUSICWHORE_IMAGES_DISCOG_PATH_TEST;
				break;
			case 'production':
				$this->mw_config['to_vigilante'] = 'http://vigilante.vigilantmedia.com';
				$this->mw_config['to_gregbueno'] = 'http://www.gregbueno.com';
				$this->mw_config['to_archive'] = 'http://archive.musicwhore.org';
				$this->mw_config['to_musicwhore'] = 'http://www.musicwhore.org';
				$this->mw_config['to_filmwhore'] = 'http://www.filmwhore.org';
				$this->mw_config['to_tvwhore'] = 'http://www.tvwhore.org';
				$this->mw_config['to_eponymous4'] = 'http://www.eponymous4.com';
				$this->mw_config['to_mt'] = 'http://mt.vigilantmedia.com';
				$this->mw_config['img_artist_root'] = MUSICWHORE_IMAGES_ARTISTS_PATH_PROD;
				$this->mw_config['img_discog_root'] = MUSICWHORE_IMAGES_DISCOG_PATH_PROD;
				break;
		}
		$this->mw_config['blog_id'] = $this->blog_id;
		$this->mw_config['img_artist_base_uri'] = '/images/artists';
		$this->mw_config['img_discog_base_uri'] = '/images/discog';
		$this->mw_config['mp3_dir_path'] = $_SERVER['DOCUMENT_ROOT'] . '/_mp3';
		$this->mw_config['album_format_mask'] = array(2 => 'album', 4 => 'single', 8 => 'ep', 16 => 'compilation', 32 => 'video', 64 => 'book');
		if ($CI->agent->is_mobile() == true) {
			$CI->mysmarty->template_dir = APPPATH . "/views/templates_mobile/";
			$CI->mysmarty->compile_dir = APPPATH . '/views/templates_mobile_c';
		}
	}

	function email($hidden_fields, $shown_fields, $site_name = 'Musicwhore.org', $redirect = '/index.php/mw/contact/sent/')
	{
		$CI =& get_instance();
		$CI->vigilantecorelib->email($this->webmaster_email, $hidden_fields, $shown_fields, $site_name, $redirect);
	}

	function get_archive_categories($blog_id = '', $category_id = '', $return_type = '')
	{
		$CI =& get_instance();

		if (empty($blog_id)) {$blog_id = $this->blog_id;}
		$rowCategories = $CI->Mw_mt_model->get_categories_with_entries($blog_id);
		$rsCategories = $CI->vigilantedblib->_db_return_smarty_array($rowCategories);

		return $rsCategories;
	}

	function _build_buy_links($release_id, $locale = 'us', $ecommerce_field_type = 'release_id', $album_format_mask = 2)
	{
		$CI =& get_instance();

		$rowLinks = $CI->Mw_ecommerce_model->get_ecommerce_links_by_field_type($release_id, $ecommerce_field_type);
		if ($rowLinks->num_rows() > 0)
		{
			foreach ($rowLinks->result() as $i => $rs)
			{
				$merchant_id = $rs->ecommerce_merchant_id;

				$rsEcommerce[$i]['merchant_id'] = $merchant_id;
				$rsEcommerce[$i]['merchant_name'] = $rs->merchant_name;
				$rsEcommerce[$i]['ecommerce_url'] = $merchant_id==2 ? $CI->myamazon->build_amazon_url($rs->ecommerce_ecomm_id, $locale) : $CI->myecommerce->build_ecommerce_url($rs->ecommerce_ecomm_id, $rs->ecommerce_merchant_id, $locale, $album_format_mask);
			}
			return $rsEcommerce;
		}
		return false;
	}

	function _format_side_navigation($blog_id)
	{
		$CI =& get_instance();

		if (empty($blog_id))
		{
			$blog_id = $this->blog_id;
		}

		$rsCategories = $this->get_archive_categories($blog_id);
		$CI->mysmarty->assign('rsCategories', $rsCategories);
	}

	function _format_section_head($section_head = '', $section_label = '', $section_sublabel = '')
	{
		$this->section_head = $section_head;
		$this->section_label = $section_label;
		$this->section_sublabel = $section_sublabel;

		if (!empty($section_head)) {$this->page_title .= $section_head;}
		if (!empty($section_label)) {$this->page_title .= ': ' . $section_label;}
		if (!empty($section_sublabel)) {$this->page_title .= ': ' . $section_sublabel;}
	}

	function _smarty_display_fw_page($page)
	{
		$this->_smarty_display_mw_page($page, 'fw_global_layout.tpl', 'fw_global_page.tpl');
	}

	function _smarty_display_tw_page($page)
	{
		$this->_smarty_display_mw_page($page, 'tw_global_layout.tpl', 'tw_global_page.tpl');
	}

	function _smarty_display_mw_page($page, $layout = 'mw_global_layout.tpl', $wrapper = 'mw_global_page.tpl')
	{
		$CI =& get_instance();

		$CI->mysmarty->assign('page_title', $this->page_title);
		$CI->mysmarty->assign('section_head', $this->section_head);
		$CI->mysmarty->assign('section_label', $this->section_label);
		$CI->mysmarty->assign('section_sublabel', $this->section_sublabel);
		$CI->mysmarty->assign('config', $this->mw_config);
		$CI->vigilantesmartylib->_smarty_display_page($page, $wrapper, $layout);
	}
}

?>