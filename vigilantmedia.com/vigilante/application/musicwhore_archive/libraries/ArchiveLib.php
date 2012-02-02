<?php

class ArchiveLib
{
	var $page_title;
	var $section_head;
	var $section_label;
	var $section_sublabel;
	var $mw_config = array();
	var $blog_id = 4;
	
	function __construct()
	{
		$CI =& get_instance();
		switch (ENVIRONMENT)
		{
			case 'dev':
				$this->mw_config['to_vigilante'] = 'http://dev.vigilante.vigilantmedia.com';
				$this->mw_config['to_gregbueno'] = 'http://dev.gregbueno.com';
				$this->mw_config['to_musicwhore'] = 'http://dev.musicwhore.org';
				$this->mw_config['to_filmwhore'] = 'http://dev.film.musicwhore.org';
				$this->mw_config['to_tvwhore'] = 'http://dev.tv.musicwhore.org';
				$this->mw_config['to_eponymous4'] = 'http://dev.eponymous4.com';
				$this->mw_config['to_mt'] = 'http://dev.mt.vigilantmedia.com';
				$this->mw_config['img_artist_root'] = '/home/nemesisv/websites/prod/musicwhore.org/archive/images/artists';
				$this->mw_config['img_discog_root'] = '/home/nemesisv/websites/prod/musicwhore.org/archive/images/discog';
				break;
			case 'test':
				$this->mw_config['to_vigilante'] = 'http://test.vigilante.vigilantmedia.com';
				$this->mw_config['to_gregbueno'] = 'http://test.gregbueno.com';
				$this->mw_config['to_musicwhore'] = 'http://test.musicwhore.org';
				$this->mw_config['to_filmwhore'] = 'http://test.film.musicwhore.org';
				$this->mw_config['to_tvwhore'] = 'http://test.tv.musicwhore.org';
				$this->mw_config['to_eponymous4'] = 'http://test.eponymous4.com';
				$this->mw_config['to_mt'] = 'http://test.mt.vigilantmedia.com';
				$this->mw_config['img_artist_root'] = '/home/nemesisv/websites/prod/musicwhore.org/archive/images/artists';
				$this->mw_config['img_discog_root'] = '/home/nemesisv/websites/prod/musicwhore.org/archive/images/discog';
				break;
			case 'prod':
				$this->mw_config['to_vigilante'] = 'http://vigilante.vigilantmedia.com';
				$this->mw_config['to_gregbueno'] = 'http://www.gregbueno.com';
				$this->mw_config['to_musicwhore'] = 'http://www.musicwhore.org';
				$this->mw_config['to_filmwhore'] = 'http://www.filmwhore.org';
				$this->mw_config['to_tvwhore'] = 'http://www.tvwhore.org';
				$this->mw_config['to_eponymous4'] = 'http://www.eponymous4.com';
				$this->mw_config['to_mt'] = 'http://mt.vigilantmedia.com';
				$this->mw_config['img_artist_root'] = '/home/nemesisv/websites/prod/musicwhore.org/archive/images/artists';
				$this->mw_config['img_discog_root'] = '/home/nemesisv/websites/prod/musicwhore.org/archive/images/discog';
				break;
		}
		$this->mw_config['blog_id'] = $this->blog_id;
		$this->mw_config['img_artist_base_uri'] = '/images/artists';
		$this->mw_config['img_discog_base_uri'] = '/images/discog';
	}
	
	function get_archive_artists()
	{
		$CI =& get_instance();
		
		$rowArtists = $CI->Mw_artist_model->get_all_artists_group_by_initial();
		$rsArtists = $CI->vigilantedblib->_db_return_smarty_array($rowArtists);
		
		return $rsArtists;
	}
	
	function get_archive_categories($blog_id = '', $category_id = '', $return_type = '')
	{
		$CI =& get_instance();
		
		if (empty($blog_id)) {$blog_id = $this->blog_id;}
		$rowCategories = $CI->Mw_mt_model->get_categories_with_entries($blog_id);
		$rsCategories = $CI->vigilantedblib->_db_return_smarty_array($rowCategories);
		
		return $rsCategories;
	}
	
	function _build_buy_links($release_id, $locale = 'us')
	{
		$CI =& get_instance();
		
		$rowLinks = $CI->Mw_ecommerce_model->get_ecommerce_links_by_field_type($release_id, 'release_id');
		if ($rowLinks->num_rows() > 0)
		{
			foreach ($rowLinks->result() as $i => $rs)
			{
				$merchant_id = $rs->ecommerce_merchant_id;
				
				$rsEcommerce[$i]['merchant_id'] = $merchant_id;
				$rsEcommerce[$i]['merchant_name'] = $rs->merchant_name;
				$rsEcommerce[$i]['ecommerce_url'] = $merchant_id==2 ? $CI->myamazon->build_amazon_url($rs->ecommerce_ecomm_id, $locale) : $CI->myecommerce->build_ecommerce_url($rs->ecommerce_ecomm_id, $rs->ecommerce_merchant_id, $locale);
			}
			return $rsEcommerce;
		}
		return false;
	}
	
	function _format_side_navigation()
	{
		$CI =& get_instance();
		
		$rsArtistsNav = $this->get_archive_artists();
		$CI->mysmarty->assign('rsArtistsNav', $rsArtistsNav);
		
		$rsCategories = $this->get_archive_categories();
		$CI->mysmarty->assign('rsCategories', $rsCategories);
	}
	
	function _format_mw_section_head($artist_id = '', $section_sublabel = '')
	{
		$CI =& get_instance();
		
		$this->section_head = 'Artists';
		$this->page_title .= 'Artists';
		
		if (!empty($artist_id))
		{
			$rsArtist = $this->_format_music_section_head($artist_id, 'Mw_artist_model', $section_sublabel);
			return $rsArtist;
		}
	}
	
	function _format_music_section_head($artist_id, $model = 'Mw_artist_model', $section_sublabel = '')
	{
		$CI =& get_instance();
		
		$rsArtist = $CI->$model->get_artist_by_id($artist_id);
		if (!empty($rsArtist))
		{
			$artist_name = $CI->vigilantecorelib->format_artist_name_object($rsArtist);
			
			$this->section_label = $artist_name;
			$this->page_title .= ': ' . $artist_name;
			if ($section_sublabel)
			{
				$this->page_title .= ': ' . $section_sublabel;
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
	
	function _format_section_head($section_head = '', $section_label = '', $section_sublabel = '')
	{
		$this->section_head = $section_head;
		$this->section_label = $section_label;
		$this->section_sublabel = $section_sublabel;
		
		if (!empty($section_head)) {$this->page_title .= $section_head;}
		if (!empty($section_label)) {$this->page_title .= ': ' . $section_label;}
		if (!empty($section_sublabel)) {$this->page_title .= ': ' . $section_sublabel;}
	}
	
	function _smarty_display_mw_page($page)
	{
		$CI =& get_instance();
		
		$CI->mysmarty->assign('page_title', $this->page_title);
		$CI->mysmarty->assign('section_head', $this->section_head);
		$CI->mysmarty->assign('section_label', $this->section_label);
		$CI->mysmarty->assign('section_sublabel', $this->section_sublabel);
		$CI->mysmarty->assign('config', $this->mw_config);
		$CI->vigilantesmartylib->_smarty_display_page($page, 'amwb_global_page.tpl', 'amwb_global_layout.tpl');
	}
}

?>