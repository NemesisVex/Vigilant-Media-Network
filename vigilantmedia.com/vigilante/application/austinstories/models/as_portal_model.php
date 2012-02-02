<?php
class As_portal_model extends CI_Model
{
	var $portal_table = 'as_portal';
	var $portal_table_index = 'portal_id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_posts_by_user_id($site_user_id, $limit = '')
	{
		$this->db->from('as_portal as p');
		$this->db->join('as_sites as s', 'p.portal_site_id=s.site_id', 'left');
		$this->db->join('vm_users as u', 's.site_user_id=u.user_id', 'left');
		$this->db->where('s.site_user_id', $site_user_id);
		$this->db->order_by('p.portal_date_added', 'desc');
		if (!empty($limit)) {$this->db->limit($limit);}
		if (false !== ($rowPosts = $this->db->get()))
		{
			return $rowPosts;
		}
		return false;
	}
	
	function get_posts_by_site_id($portal_site_id, $limit = '')
	{
		$this->db->from('as_portal as p');
		$this->db->join('as_sites as s', 'p.portal_site_id=s.site_id');
		$this->db->where('s.site_id', $portal_site_id);
		$this->db->where('s.site_in_directory', true);
		$this->db->order_by('p.portal_date_added', 'desc');
		if (!empty($limit)) {$this->db->limit($limit);}
		if (false !== ($rowPosts = $this->db->get()))
		{
			return $rowPosts;
		}
		return false;
	}
	
	function get_post_by_id($portal_id, $simple = false)
	{
		if ($simple == true)
		{
			if (false !== ($rowPost = $this->vigilantedblib->_get_record($this->portal_table, $this->portal_table_index, $portal_id)))
			{
				$rsPost = $this->vigilantedblib->_db_return_rs($rowPost);
				return $rsPost;
			}
		}
		else
		{
			$this->db->from('as_portal as p');
			$this->db->join('as_sites as s', 'p.portal_site_id=s.site_id', 'left');
			$this->db->join('vm_users as u', 's.site_user_id=u.user_id', 'left');
			$this->db->where('p.portal_id', $portal_id);
			if (false !== ($rowPost = $this->db->get()))
			{
				$rsPost = $this->vigilantedblib->_db_return_rs($rowPost);
				return $rsPost;
			}
		}
		return false;
	}
	
	function check_rss_entry($portal_headline, $portal_url)
	{
		$this->db->from($this->portal_table);
		$this->db->like('portal_headline', $portal_headline);
		$this->db->or_like('portal_url', $portal_url);
		if (false !== ($rowPost = $this->db->get()))
		{
			$rsPost = $this->vigilantedblib->_db_return_rs($rowPost);
			return $rsPost;
		}
	}
	
	function get_directory_posts()
	{
		$localSQL = '';
		$localSQL .= 'Select s.*, u.*, p.*, a.*, Sum(portal_publish_status) as PostNumber ';
		$localSQL .= 'From ((as_sites as s Left Outer Join as_portal as p on p.portal_site_id=s.site_id) ';
		$localSQL .= 'Left Outer Join vm_users as u on s.site_user_id=u.user_id) ';
		$localSQL .= 'Left Outer Join as_users_aliases as a on s.site_alias_id=a.alias_id ';
		$localSQL .= 'Where s.site_in_directory=1 ';
		$localSQL .= 'And ((u.user_level_mask & 1)=0 And (u.user_level_mask & 2)=0 And (u.user_level_mask & 4)=0) ';
		$localSQL .= 'Group By s.site_id Order By s.site_name';
		if (false !== ($rowPosts = $this->db->query($localSQL)))
		{
			return $rowPosts;
		}
	}
	
	function get_recent_posts($limit = 20)
	{
		$portalSQL = '';
		$portalSQL .= 'Select P.*, S.*, U.*, A.* ';
		$portalSQL .= 'From ((as_portal as P Left Join as_sites as S on P.portal_site_id=S.site_id) ';
		$portalSQL .= 'Left Join vm_users as U on S.site_user_id=U.user_id) ';
		$portalSQL .= 'Left Outer Join as_users_aliases as A on S.site_alias_id=A.alias_id ';
		$portalSQL .= 'Where S.site_in_directory=1 And P.portal_publish_status=1 ';
		$portalSQL .= 'Order By P.portal_date_added Desc ';
		if (!empty($limit)) {$portalSQL .= 'Limit ' . $limit;}
		if (false !== ($rowPosts = $this->db->query($portalSQL)))
		{
			return $rowPosts;
		}
	}
	
	function add_post($input)
	{
		if (false !== ($id = $this->vigilantedblib->_add_record($this->portal_table, $input)))
		{
			return $id;
		}
		return false;
	}
	
	function update_post_by_id($portal_id, $input)
	{
		if (false !== $this->vigilantedblib->_update_record($this->portal_table, $this->portal_table_index, $portal_id, $input))
		{
			return true;
		}
		return false;
	}
	
	function delete_post_by_id($portal_id)
	{
		$where_function = is_array($portal_id) ? 'where_in' : 'where';
		$this->db->$where_function('portal_id', $portal_id);
		if (false !== $this->db->delete($this->portal_table))
		{
			return true;
		}
		return false;
	}
	
	function delete_post_by_site_id($portal_site_id)
	{
		$where_function = is_array($portal_site_id) ? 'where_in' : 'where';
		$this->db->$where_function('portal_site_id', $portal_site_id);
		if (false !== $this->db->delete($this->portal_table))
		{
			return true;
		}
		return false;
	}
	
	function delete_post_by_user_id($site_user_id)
	{
		$deleteQuery = '';
		$deleteQuery .= 'Delete p.* From as_portal as p, as_sites as s ';
		$deleteQuery .= 'Where p.portal_site_id=s.site_id ';
		$deleteQuery .= is_array($site_user_id) ? 'And s.site_user_id In (' . join(',', $site_user_id) . ')' : 'And s.site_user_id = ' . intval($site_user_id);
		if (false !== $this->db->query($deleteQuery))
		{
			return true;
		}
		return false;
	}
	
	function delete_post_by_alias_id($site_alias_id)
	{
		$deleteQuery = '';
		$deleteQuery .= 'Delete p.* From as_portal as p, as_sites as s ';
		$deleteQuery .= 'Where p.portal_site_id=s.site_id ';
		$deleteQuery .= is_array($site_alias_id) ? 'And s.site_alias_id In (' . join(',', $site_alias_id) . ')' : 'And s.site_alias_id = ' . intval($site_alias_id);
		if (false !== $this->db->query($deleteQuery))
		{
			return true;
		}
		return false;
	}
}
?>