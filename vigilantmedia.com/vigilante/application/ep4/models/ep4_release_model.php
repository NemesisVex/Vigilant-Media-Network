<?php
class Ep4_release_model extends CI_Model
{
	var $blog_id = 12;
	var $artist_id = 1;
	var $category_news = 35;
	var $category_wrp_release = 36;
	var $category_wrp_track = 37;
	var $mt_db;

	function __construct()
	{
		parent::__construct();
		$this->mt_db = $this->load->database('mt', true);
	}

	// Music methods
	function get_releases($format_id = 2, $order_by = 'desc')
	{
		$this->_build_base_release_query();
		$this->db->where('r.release_format_id', $format_id);
		$this->db->order_by('r.release_release_date', $order_by);
		if (false !== ($rowReleases = $this->db->get()))
		{
			return $rowReleases;
		}
		return false;
	}

	function get_release_by_id($release_id)
	{
		$this->_build_base_release_query();
		$this->db->where('r.release_id', $release_id);
		if (false !== ($rowRelease = $this->db->get()))
		{
			return $rowRelease;
		}
		return false;
	}

	function get_release_by_alias($album_alias, $release_format_id = 2)
	{
		$this->_build_base_release_query();
		$this->db->where('al.album_alias', $album_alias);
		$this->db->where('r.release_format_id', $release_format_id);
		if (false !== ($rowReleases = $this->db->get()))
		{
			return $rowReleases;
		}
		return false;
	}

	function get_latest_release()
	{
		$this->_build_base_release_query();
		$this->db->where('release_is_visible', 1);
		$this->db->order_by('r.release_release_date', 'desc');
		$this->db->limit(1);
		if (false !== ($rowReleases = $this->db->get()))
		{
			return $rowReleases;
		}
		return false;
	}

	function get_tracks_mapped_to_audio($release_id)
	{
		$this->db->select('*');
		$this->db->from('ep4_tracks as t');
		$this->db->join('ep4_albums_releases as r', 't.track_release_id=r.release_id', 'left');
		$this->db->join('ep4_songs as s', 't.track_song_id=s.song_id', 'left');
		$this->db->join('ep4_audio_map as m', 'm.map_track_id=t.track_id', 'left outer');
		$this->db->join('ep4_audio as au', 'm.map_audio_id=au.audio_id', 'left outer');
		$this->db->where('r.release_id', $release_id);
		$this->db->order_by('t.track_disc_num', 'asc');
		$this->db->order_by('t.track_track_num', 'asc');

		if (false !== ($rowTracks = $this->db->get()))
		{
			return $rowTracks;
		}
		return false;
	}

	function get_track_by_id($track_id)
	{
		$this->db->select('*');
		$this->db->from('ep4_tracks as t');
		$this->db->join('ep4_songs as s', 't.track_song_id=s.song_id', 'left');
		$this->db->where('t.track_id', $track_id);

		if (false !== ($rowTrack = $this->db->get()))
		{
			return $rowTrack;
		}
		return false;
	}

	function get_audio_by_id($audio_id)
	{
		$this->db->from('ep4_audio as a');
		$this->db->join('ep4_songs as s', 'a.audio_song_id=s.song_id', 'left');
		$this->db->where('a.audio_id', $audio_id);

		if (false !== ($rowAudio = $this->db->get()))
		{
			return $rowAudio;
		}
		return false;
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

	function get_audio_by_track_id($track_id)
	{
		$this->db->from('ep4_tracks as t');
		$this->db->join('ep4_audio_map as m', 'm.map_track_id=t.track_id', 'left');
		$this->db->join('ep4_audio as au', 'm.map_audio_id=au.audio_id', 'left outer');
		$this->db->where('t.track_id', $track_id);

		if (false !== ($rowTrack = $this->db->get()))
		{
			return $rowTrack;
		}
		return false;
	}

	function get_entry_by_track_id($track_id)
	{
		$this->_build_base_content_query();
		$this->mt_db->where('c.content_track_id', $track_id);
		$this->mt_db->where('cat.category_id', $this->category_wrp_track);

		if (false !== ($rowTrack = $this->mt_db->get()))
		{
			return $rowTrack;
		}
		return false;
	}

	function get_wrp_by_entry_id($entry_id)
	{
		$this->_build_base_content_query();
		$this->mt_db->where('c.content_entry_id', $entry_id);

		if (false !== ($rowTrack = $this->mt_db->get()))
		{
			return $rowTrack;
		}
		return false;
	}

	function get_entry_by_release_id($release_id)
	{
		$this->_build_base_content_query();
		$this->mt_db->where('c.content_release_id', $release_id);
		$this->mt_db->where('c.content_track_id', 0);
		$this->mt_db->where('cat.category_id', $this->category_wrp_release);

		if (false !== ($rowTrack = $this->mt_db->get()))
		{
			return $rowTrack;
		}
		return false;
	}

	function add_audio_log($input)
	{
		if (false !== ($id = $this->vigilantedblib->_add_record('ep4_audio_log', $input)))
		{
			return $id;
		}
		return false;
	}

	// Private methods
	function _build_base_content_query()
	{
		$this->mt_db->from('ep4_content as c');
		$this->mt_db->join('mt_entry as e', 'c.content_entry_id=e.entry_id', 'left');
		$this->mt_db->join('mt_placement as p', 'p.placement_entry_id=e.entry_id', 'left outer');
		$this->mt_db->join('mt_category as cat', 'p.placement_category_id=cat.category_id', 'left outer');
	}

	function _build_base_release_query($artist_id = null)
	{
		if (empty($artist_id)) {$artist_id = $this->artist_id;}
		$this->db->select('*');
		$this->db->from('ep4_albums_releases as r');
		$this->db->join('ep4_albums as al', 'r.release_album_id=al.album_id', 'left');
		$this->db->where('r.release_is_visible', true);
		$this->db->where('al.album_is_visible', true);
		$this->db->where('al.album_artist_id', $artist_id);
	}
}
?>