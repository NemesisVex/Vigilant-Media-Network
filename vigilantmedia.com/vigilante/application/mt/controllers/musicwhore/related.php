<?php

class Related extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('MtLib');
		$this->load->model('Mt_mw_artist_model');
		$this->load->model('Mt_mw_related_model');
		$this->mysmarty->assign('session', $this->phpsession);
		$this->mysmarty->assign('side_template', 'mt_musicwhore_artist_side.tpl');
	}
	
	// View methods
	
	function index()
	{
		header('Location: /index.php/mt/musicwhore/');
	}
	
	function browse($related_artist_id, $filter = 'a')
	{
		$rsArtist = $this->mtlib->_format_mw_section_head($related_artist_id, 'Link an artist');
		
		$rowRelations = $this->Mt_mw_related_model->get_related_by_artist_id($related_artist_id);
		$rsRelations = $this->vigilantedblib->_db_return_smarty_array($rowRelations);
		//$this->vigilantecorelib->debug_trace($this->db->last_query());
		
		$rowReciprocals = $this->Mt_mw_related_model->get_reciprocal_related_by_artist_id($related_artist_id);
		$rsReciprocals = $this->vigilantedblib->_db_return_smarty_array($rowReciprocals);
		//$this->vigilantecorelib->debug_trace($this->db->last_query());
		
		$rowArtists = $this->Mt_mw_artist_model->get_all_artists($filter);
		$rsArtists = $this->vigilantedblib->_db_return_smarty_array($rowArtists);
		
		$rowNav = $this->Mt_mw_artist_model->get_all_artists_group_by_initial();
		$rsNav = $this->vigilantedblib->_db_return_smarty_array($rowNav);
		
		$this->mysmarty->assign('rsNav', $rsNav);
		$this->mysmarty->assign('rsRelations', $rsRelations);
		$this->mysmarty->assign('rsReciprocals', $rsReciprocals);
		$this->mysmarty->assign('rsArtists', $rsArtists);
		$this->mysmarty->assign('rsArtist', $rsArtist);
		$this->mysmarty->assign('related_artist_id', $related_artist_id);
		$this->mysmarty->assign('filter', $filter);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_artist_related_browse.tpl');
	}
	
	// Processing methods
	
	function update($artist_id, $filter = '')
	{
		$related_in = $this->input->get_post('related_in');
		$msg = '';
		
		foreach ($related_in as $related)
		{
			$related_id = $related['related_id'];
			$artist_name = $related['artist_name'];
			
			if (!empty($related_id))
			{
				if (!empty($related['delete']))
				{
					if (false !== $this->_delete_related($related)) {$msg .= 'Relationship with ' . $artist_name . ' was deleted.<br>' . "\n";}
				}
				else
				{
					if (false !== $this->_update_related($related)) {$msg .= 'Relationship with ' . $artist_name . ' was updated.<br>' . "\n";}
				}
			}
		}
		
		$this->phpsession->flashsave('msg', $msg);
		
		$location = 'Location: /index.php/musicwhore/related/browse/' . $artist_id . '/';
		if (!empty($filter)) {$location .= $filter . '/';}
		header($location);
		die();
	}
	
	function create($artist_id, $filter = '')
	{
		$relation_direction = $this->input->get_post('relation_direction');
		$relation_id = $this->input->get_post('relation_id');
		$related_relation = $this->input->get_post('related_relation');
		
		if ($relation_direction == 'direct')
		{
			$input['related_artist_id'] = $artist_id;
			$input['related_relation_id'] = $relation_id;
		}
		elseif ($relation_direction == 'reciprocal')
		{
			$input['related_artist_id'] = $relation_id;
			$input['related_relation_id'] = $artist_id;
		}
		$input['related_relation'] = $related_relation;
		
		if (false != ($related_id = $this->Mt_mw_related_model->add_related($input)))
		{
			$this->phpsession->flashsave('msg', 'Relationship was created.');
		}
		
		$location = 'Location: /index.php/musicwhore/related/browse/' . $artist_id . '/';
		if (!empty($filter)) {$location .= $filter . '/';}
		header($location);
	}
	
	// Private methods
	
	function _update_related($related)
	{
		$related_id = $related['related_id'];
		$rsRelated = $this->Mt_mw_related_model->get_related_by_id($related_id);
		$input = $this->vigilantedblib->_db_build_update_data($rsRelated, $related);
		
		if (!empty($input))
		{
			if (false !== $this->Mt_mw_related_model->update_related_by_id($related_id, $input))
			{
				return true;
			}
		}
		return false;
	}
	
	function _delete_related($related)
	{
		$related_id = $related['related_id'];
		if (false !== $this->Mt_mw_related_model->delete_related_by_id($related_id))
		{
			return true;
		}
		return false;
	}
}
?>