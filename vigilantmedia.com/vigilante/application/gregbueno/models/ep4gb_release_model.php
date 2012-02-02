<?php
class Ep4gb_release_model extends CI_Model
{
	var $blog_id = 6;
	var $artist_id = 2;
	
	function __construct()
	{
		parent::__construct();
	}
	
	// Music methods
	function get_album_release_by_id($release_id)
	{
		$projectQuery = $this->_build_base_album_query();
		$projectQuery .= 'Where audio_mp3_file_name Is Not Null ';
		$projectQuery .= 'And r.release_id=' . $release_id . ' ';
		$projectQuery .= 'Order By t.track_track_num';
		
		$rowProject = $this->db->query($projectQuery);
		return $rowProject;
	}
	
	function get_album_by_alias($alias, $release_format_id = 14)
	{
		$projectQuery = $this->_build_base_album_query();
		$projectQuery .= 'Where audio_mp3_file_name Is Not Null ';
		$projectQuery .= 'And r.release_format_id=' . $release_format_id . ' ';
		$projectQuery .= 'And al.album_alias=' . $this->db->escape($alias) . ' ';
		$projectQuery .= 'Order By t.track_track_num';
		
		$rowProject = $this->db->query($projectQuery);
		return $rowProject;
	}
	
	function get_albums()
	{
		$projectQuery = $this->_build_base_album_query($release_format_id = 14);
		$projectQuery .= 'Where audio_mp3_file_name Is Not Null ';
		$projectQuery .= 'And al.album_artist_id=' . $this->artist_id . ' ';
		$projectQuery .= 'And al.album_is_visible=1 ';
		$projectQuery .= 'And r.release_format_id=' . $release_format_id . ' ';
		$projectQuery .= 'Order By r.release_release_date Desc, al.album_title, t.track_track_num';
		
		$rowProjects = $this->db->query($projectQuery);
		return $rowProjects;
	}
	
	function get_song($song_id)
	{
		$rowSong = $this->vigilantedblib->_get_record('ep4_songs', 'song_id', $song_id);
		$rsSong = $this->vigilantedblib->_db_return_rs($rowSong);
		return $rsSong;
	}
	
	function get_audio_file($map_audio_id)
	{
		$projectQuery = '';
		$projectQuery .= 'Select * From ((ep4_tracks as t Left Join ep4_songs as s on t.track_song_id=s.song_id) ';
		$projectQuery .= 'Left Outer Join ep4_audio_map as m on m.map_track_id=t.track_id) ';
		$projectQuery .= 'Left Outer Join ep4_audio as au on au.audio_id=m.map_audio_id ';
		$projectQuery .= 'Where au.audio_artist_id=1 And au.audio_mp3_file_name Is Not Null ';
		$projectQuery .= 'And m.map_audio_id=' . intval($map_audio_id);
		
		$rowProject = $this->db->query($projectQuery);
		return $rowProject;
	}
	
	function get_audio_playlist_by_alias($project, $release_format_id = 14)
	{
		$projectQuery = '';
		$projectQuery .= 'Select * From ((((ep4_tracks as t Left Join ep4_albums_releases as r on t.track_release_id=r.release_id) ';
		$projectQuery .= 'Left Join ep4_albums as al on r.release_album_id=al.album_id) ';
		$projectQuery .= 'Left Join ep4_songs as s on t.track_song_id=s.song_id) ';
		$projectQuery .= 'Left Outer Join ep4_audio_map as m on m.map_track_id=t.track_id) ';
		$projectQuery .= 'Left Outer Join ep4_audio as au on au.audio_id=m.map_audio_id ';
		$projectQuery .= 'Where audio_mp3_file_name Is Not Null ';
		$projectQuery .= 'And r.release_format_id=' . $release_format_id . ' ';
		if (!empty($project))
		{
			$projectQuery .= 'And al.album_alias=' . $this->db->escape($project) . ' ';
			$projectQuery .= 'Order By t.track_track_num';
		}
		else
		{
			$projectQuery .= 'And al.album_artist_id=' . $this->artist_id . ' Order By al.album_id, t.track_track_num';
		}
		
		$rowProject = $this->db->query($projectQuery);
		return $rowProject;
	}
	
	function add_audio_log($input)
	{
		if (false !== ($id = $this->vigilantedblib->_add_record('ep4_audio_log', $input)))
		{
			return $id;
		}
		return false;
	}
	
	//Private methods
	function _build_base_album_query()
	{
		$projectQuery = '';
		$projectQuery .= 'Select * From ((((ep4_tracks as t Left Join ep4_albums_releases as r on t.track_release_id=r.release_id) ';
		$projectQuery .= 'Left Join ep4_albums as al on r.release_album_id=al.album_id) ';
		$projectQuery .= 'Left Join ep4_songs as s on t.track_song_id=s.song_id) ';
		$projectQuery .= 'Left Outer Join ep4_audio_map as m on m.map_track_id=t.track_id) ';
		$projectQuery .= 'Left Outer Join ep4_audio as au on au.audio_id=m.map_audio_id ';
		return $projectQuery;
	}
}
?>