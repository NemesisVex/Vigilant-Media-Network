<?php

class Demos extends CI_Controller
{
	var $webmaster_email = 'greg@gregbueno.com';
	var $error_codes = array('401' => 'Authentication required', '403' => 'Forbidden', '404' => 'Not found', '500' => 'Internal server error');
	
	function __construct()
	{
		parent::__construct();	
		$this->load->library('GbLib');
		$this->load->model('Ep4gb_release_model');
	}
	
	function index()
	{
		$query = '';
		$query .= 'Select * From (((((ep4_songs as s Left Join ep4_audio as au on au.audio_song_id=s.song_id) ';
		$query .= 'Left Outer Join ep4_audio_map as m on m.map_audio_id=au.audio_id) ';
		$query .= 'Left Outer Join ep4_tracks as t on m.map_track_id=t.track_id) ';
		$query .= 'Left Outer Join ep4_albums_releases as r on t.track_release_id=r.release_id) ';
		$query .= 'Left Outer Join ep4_albums as al on r.release_album_id=al.album_id) ';
		$query .= 'Group By s.song_id, al.album_artist_id ';
		$query .= 'Order By s.song_id, al.album_artist_id Desc, au.audio_mp3_file_path';
		
		$rowTracks = $this->db->query($query);
		$rsTracks = array();
		
		foreach ($rowTracks->result() as $rsTrack)
		{
			//$this->vigilantecorelib->debug_trace("$rsTrack->audio_song_id: $rsTrack->audio_mp3_file_path . '/' . $rsTrack->audio_mp3_file_name ($rsTrack->song_title)");
			if ($rsTrack->album_artist_id==2)
			{
				if (!empty($rsTrack->audio_mp3_file_name))
				{
					$rsTracks[$rsTrack->song_id]['song_id'] = $rsTrack->song_id;
					$rsTracks[$rsTrack->song_id]['demo_audio_id'] = $rsTrack->audio_id;
					$rsTracks[$rsTrack->song_id]['song_title'] = $rsTrack->song_title;
				}
			}
			else
			{
				if (!empty($rsTracks[$rsTrack->song_id]['demo_audio_id']) && empty($rsTracks[$rsTrack->song_id]['release_audio_id']))
				{
					$rsTracks[$rsTrack->song_id]['release_audio_id'] = $rsTrack->audio_id;
				}
			}
		}
		//$rsTracks = $this->vigilantedblib->_db_return_smarty_array($rowTracks);
		
		$this->mysmarty->assign('rsTracks', $rsTracks);
		$this->gblib->_smarty_display_demos_page('gb_demos_index.tpl');
	}
	
	function error($code)
	{
		$this->gblib->_format_section_head('Error', $code, $this->error_codes[$code]);
		$this->gblib->_smarty_display_gb_page('vm_error_' . $code . '.tpl');
	}
	
	//Processing methods
}
?>