<?php
class As_favorites_model extends CI_Model
{
	var $favorite_table = 'as_users_favorites';
	var $favorite_table_index = 'favorite_id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_all_visible_sites()
	{
		$this->db->from('as_sites as s');
		$this->db->join('vm_users as u', 's.site_user_id=u.user_id', 'left');
		$this->db->where('s.site_in_directory', true);
		$this->db->order_by('s.site_name', 'asc');
		if (false !== ($rowSites = $this->db->get()))
		{
			return $rowSites;
		}
		return false;
	}
	
	function get_favorites_by_user_id($favorite_user_id)
	{
		$this->db->from('as_users_favorites as f');
		$this->db->join('as_sites as s', 'f.favorite_site_id=s.site_id', 'left');
		$this->db->join('vm_users as u', 's.site_user_id=u.user_id', 'left');
		$this->db->where('f.favorite_user_id', $favorite_user_id);
		$this->db->order_by('s.site_name', 'asc');
		if (false !== ($rowFavorites = $this->db->get()))
		{
			return $rowFavorites;
		}
		return false;
	}
	
	function get_favorite_by_id($favorite_id, $simple = false)
	{
		if ($simple == true)
		{
			if (false !== ($rowFavorite = $this->vigilantedblib->_get_record($this->favorite_table, $this->favorite_table_index, $favorite_id)))
			{
				$rsFavorite = $this->vigilantedblib->_db_return_rs($rowFavorite);
				return $rsFavorite;
			}
		}
		else
		{
			$this->db->from('as_users_favorites as f');
			$this->db->join('as_sites as s', 'f.favorite_site_id=s.site_id', 'left');
			$this->db->join('vm_users as u', 's.site_user_id=u.user_id', 'left');
			$this->db->where('f.favorite_id', $favorite_id);
			$this->db->order_by('s.site_name', 'asc');
			if (false !== ($rowFavorite = $this->db->get()))
			{
				$rsFavorite = $this->vigilantedblib->_db_return_rs($rowFavorite);
				return $rsFavorite;
			}
		}
		return false;
	}
	
	function get_posts_from_favorite_sites($favorite_user_id, $limit = 5)
	{
		$this->db->from($this->favorite_table . ' as f');
		$this->db->join('as_portal as p', 'f.favorite_site_id=p.portal_site_id', 'left');
		$this->db->join('as_sites as s', 'p.portal_site_id=s.site_id', 'left');
		$this->db->join('vm_users as u', 's.site_user_id=u.user_id', 'left');
		$this->db->join('as_users_aliases as a', 's.site_alias_id=a.alias_id', 'left outer');
		$this->db->where('s.site_in_directory', true);
		$this->db->where('p.portal_publish_status', true);
		$this->db->where('f.favorite_user_id', $favorite_user_id);
		$this->db->order_by('p.portal_date_added', 'desc');
		if (!empty($limit)) {$this->db->limit($limit);}
		if (false !== ($rowPosts = $this->db->get()))
		{
			return $rowPosts;
		}
	}
	
	function add_favorite($input)
	{
		if (false !== ($id = $this->vigilantedblib->_add_record($this->favorite_table, $input)))
		{
			return $id;
		}
		return false;
	}
	
	function update_favorite_by_id($favorite_id, $input)
	{
		if (false !== $this->vigilantedblib->_update_record($this->favorite_table, $this->favorite_table_index, $favorite_id, $input))
		{
			return true;
		}
		return false;
	}
	
	function delete_favorite_by_id($favorite_id)
	{
		$where_function = is_array($favorite_id) ? 'where_in' : 'where';
		$this->db->$where_function('favorite_id', $favorite_id);
		if (false !== $this->db->delete($this->favorite_table))
		{
			return true;
		}
		return false;
	}
	
	function delete_favorite_by_site_id($favorite_site_id)
	{
		$where_function = is_array($favorite_site_id) ? 'where_in' : 'where';
		$this->db->$where_function('favorite_site_id', $favorite_site_id);
		if (false !== $this->db->delete($this->favorite_table))
		{
			return true;
		}
		return false;
	}
	
	function delete_favorite_by_user_id($favorite_user_id)
	{
		$where_function = is_array($favorite_user_id) ? 'where_in' : 'where';
		$this->db->$where_function('favorite_user_id', $favorite_user_id);
		if (false !== $this->db->delete($this->favorite_table))
		{
			return true;
		}
		return false;
	}
}
?>