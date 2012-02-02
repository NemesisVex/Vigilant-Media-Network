<?php
class Gb_model extends CI_Model
{
	var $blog_id = 6;
	var $artist_id = 1;
	
	function __construct()
	{
		parent::__construct();
	}
	
	// News methods
	function get_latest_entries($limit = 5)
	{
		$contentQuery = '';
		$contentQuery .= 'Select e.*, cat.*, au.*, b.*, s.blog_site_url as site_url ';
		$contentQuery .= 'From ((((mt_entry as e Left Join mt_author as au on e.entry_author_id=au.author_id) ';
		$contentQuery .= 'Left Outer Join mt_placement as p on e.entry_id=p.placement_entry_id) ';
		$contentQuery .= 'Left Outer Join mt_category as cat on p.placement_category_id=cat.category_id) ';
		$contentQuery .= 'Left Outer Join mt_blog as b on e.entry_blog_id=b.blog_id) ';
		$contentQuery .= 'Left Outer Join mt_blog as s on b.blog_parent_id=s.blog_id ';
		$contentQuery .= 'Where e.entry_status=2 Order By e.entry_authored_on Desc Limit ' . $limit . ' ';
		if (false !== ($rowEntries = $this->db->query($contentQuery)))
		{
			return $rowEntries;
		}
		return false;
	}
}
?>