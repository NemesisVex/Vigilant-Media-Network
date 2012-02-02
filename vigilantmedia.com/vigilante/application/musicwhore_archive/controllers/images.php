<?php
class Images extends CI_Controller
{
	var $artist_uri_base = '/images/artists';
	var $album_uri_base = '/images/discog';
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('ArchiveLib');
	}
	
	function index()
	{
		header("Location: /images/dont_steal.gif");
	}
	
	function artist($file_system)
	{
		$artist_image = $file_system . '.jpg';
		$image_path = $this->archivelib->mw_config['img_artist_root'] . '/' . $artist_image;
		$image_uri = $this->artist_uri_base . '/' . $artist_image;
		list ($width, $height) = getimagesize($image_path);
		
		$query_string = '';
		$query_string .= 'artist_img=' . $image_uri;
		$query_string .= '&width=' . $width;
		$query_string .= '&height=' . $height;
		
		echo $query_string;
		die();
	}
	
	function album($file_system, $album_image)
	{
		$sort_dir = substr($file_system, 0, 1);
		$image_path = $this->archivelib->mw_config['img_discog_root'] . '/' . $sort_dir . '/' . $file_system . '/' . $album_image;
		$image_uri = $this->album_uri_base . '/' . $sort_dir . '/' . $file_system . '/' . $album_image;
		list ($width, $height) = getimagesize($image_path);
		
		$query_string = '';
		$query_string .= 'album_img=' . $image_uri;
		$query_string .= '&width=' . $width;
		$query_string .= '&height=' . $height;
		
		echo $query_string;
		die();
	}
}

?>