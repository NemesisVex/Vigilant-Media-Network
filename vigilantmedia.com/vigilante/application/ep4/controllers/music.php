<?php
class Music extends CI_Controller
{
	var $page_title;
	var $ep4_config = array();
	var $per_page = 10;
	var $digital_format_id = 14;
	var $ep4_audio_url_base;
	var $ep4_audio_file_base;
	var $ep4_audio_path_base;

	function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('Ep4View');
		$this->load->model('Ep4_release_model');
		$this->load->model('Ep4_ecommerce_model');
		$this->page_title .= 'Music';
		$this->mysmarty->assign('bgImage', 'RL000796.jpg');

		$this->ep4_audio_file_base = '/home/nemesisv/websites/prod/eponymous4.com/www';
		$this->ep4_audio_url_base = 'http://eponymous4.com';
		$this->ep4_audio_path_base = '/music/audio';
	}

	// View methods

	function index()
	{
		$this->vmview->format_section_head('Music');

		if (false !== ($rowDigitals = $this->Ep4_release_model->get_releases($this->digital_format_id, 'asc')))
		{
			$rsDigitals = $this->vigilantedblib->_db_return_smarty_array($rowDigitals);
			$this->mysmarty->assign('rsDigitals', $rsDigitals);
		}
		
		$this->vmview->display('ep4_music_index.tpl');
	}

	function cd($album_alias)
	{
		$rowRelease = $this->Ep4_release_model->get_release_by_alias($album_alias);
		$rsRelease = $this->vigilantedblib->_db_return_rs($rowRelease);
		$album_title = !empty($rsRelease->release_alternate_title) ? $rsRelease->release_alternate_title : $rsRelease->album_title;
		$this->mysmarty->assign('album_title', $album_title);
		$this->vmview->format_section_head('Music', 'CD', $album_title);

		$release_id = $rsRelease->release_id;
		$album_id = $rsRelease->release_album_id;

		$rowTracks = $this->Ep4_release_model->get_tracks_mapped_to_audio($release_id);
		$rsTracks = $this->vigilantedblib->_db_return_smarty_array($rowTracks);

		$rowCDLinks = $this->Ep4_ecommerce_model->get_cd_ecommerce_links($release_id);
		$rsCDLinks = $this->vigilantedblib->_db_return_smarty_array($rowCDLinks);

		$rowOtherLinks = $this->Ep4_ecommerce_model->get_ecommerce_links_by_album_id($album_id, 2);
		$rsOtherLinks = $this->vigilantedblib->_db_return_smarty_array($rowOtherLinks);

		$this->mysmarty->assign('rsRelease', $rsRelease);
		$this->mysmarty->assign('rsTracks', $rsTracks);
		$this->mysmarty->assign('rsCDLinks', $rsCDLinks);
		$this->mysmarty->assign('rsOtherLinks', $rsOtherLinks);
		$this->vmview->display('ep4_music_cd.tpl');
	}

	function digital($album_alias)
	{
		$rowRelease = $this->Ep4_release_model->get_release_by_alias($album_alias, $this->digital_format_id);
		$rsRelease = $this->vigilantedblib->_db_return_rs($rowRelease);

		if (!empty($rsRelease))
		{
			$album_title = !empty($rsRelease->release_alternate_title) ? $rsRelease->release_alternate_title : $rsRelease->album_title;
			$this->mysmarty->assign('album_title', $album_title);

			$this->vmview->format_section_head('Music');
			$release_id = $rsRelease->release_id;

			$rowTracks = $this->Ep4_release_model->get_tracks_mapped_to_audio($release_id);
			$total_tracks = $rowTracks->num_rows();
			$rsTracks = $this->vigilantedblib->_db_return_smarty_array($rowTracks);

			$rowEntry = $this->Ep4_release_model->get_entry_by_release_id($release_id);
			$rsEntry = $this->vigilantedblib->_db_return_rs($rowEntry);

			$rowDigitalLinks = $this->Ep4_ecommerce_model->get_cd_ecommerce_links($release_id);
			$rsDigitalLinks = $this->vigilantedblib->_db_return_smarty_array($rowDigitalLinks);

			$rowITunesLinks = $this->Ep4_ecommerce_model->get_ecommerce_links_with_tracks_by_release_id($release_id, '', 'iTunes');
			if ($rowITunesLinks->num_rows() > 0)
			{
				foreach ($rowITunesLinks->result() as $rs)
				{
					$rsITunesLinks[$rs->track_track_num] = $rs->ecommerce_url;
				}
				$this->mysmarty->assign('rsITunesLinks', $rsITunesLinks);
			}

			$this->mysmarty->assign('album_alias', $album_alias);
			$this->mysmarty->assign('total_tracks', $total_tracks);
			$this->mysmarty->assign('rsRelease', $rsRelease);
			$this->mysmarty->assign('rsTracks', $rsTracks);
			$this->mysmarty->assign('rsDigitalLinks', $rsDigitalLinks);
			$this->mysmarty->assign('rsEntry', $rsEntry);
		}
		else
		{
			$this->vmview->format_section_head('Music', 'Digital');
		}

		$this->vmview->display('ep4_music_digital.tpl');
	}

	function track($track_id)
	{
		$rowTrack = $this->Ep4_release_model->get_track_by_id($track_id);
		$rsTrack = $this->vigilantedblib->_db_return_rs($rowTrack);

		$this->vmview->format_section_head('Music', 'Digital', $rsTrack->song_title);

		if (!empty($rsTrack->track_release_id))
		{
			$rowRelease = $this->Ep4_release_model->get_release_by_id($rsTrack->track_release_id);
			$rsRelease = $this->vigilantedblib->_db_return_rs($rowRelease);
			$this->mysmarty->assign('rsRelease', $rsRelease);
		}

		$rowAudio = $this->Ep4_release_model->get_audio_by_track_id($track_id);
		$rsAudio = $this->vigilantedblib->_db_return_rs($rowAudio);

		$rowEntry = $this->Ep4_release_model->get_entry_by_track_id($track_id);
		$rsEntry = $this->vigilantedblib->_db_return_rs($rowEntry);

		$rowLinks = $this->Ep4_ecommerce_model->get_ecommerce_links_by_track_id($track_id);
		$rsLinks = $this->vigilantedblib->_db_return_smarty_array($rowLinks);

		$this->mysmarty->assign('track_id', $track_id);
		$this->mysmarty->assign('rsTrack', $rsTrack);
		$this->mysmarty->assign('rsAudio', $rsAudio);
		$this->mysmarty->assign('rsEntry', $rsEntry);
		$this->mysmarty->assign('rsLinks', $rsLinks);
		$this->vmview->display('ep4_music_track.tpl');
	}

	function video()
	{
		$this->vmview->format_section_head('Music', 'Video');
		$this->vmview->display('ep4_music_video.tpl');
	}

	// Processing methods
	function play($id, $type = null)
	{
		switch ($type)
		{
			case "audio":
				$this->play_audio($id);
				break;
			case "ex_machina":
			case "vocals":
				$path = $this->ep4_audio_path_base . '/_' . $type;
				$this->_redirect_to_audio($path, $id);
				break;
			default:
				$this->play_track($id);
				break;
		}
	}

	function play_track($track_id)
	{
		$rowTrack = $this->Ep4_release_model->get_audio_by_track_id($track_id);
		$rsTrack = $this->vigilantedblib->_db_return_rs($rowTrack);

		$this->_redirect_to_audio($rsTrack->audio_mp3_file_path, $rsTrack->audio_mp3_file_name);
	}

	function play_audio($audio_id)
	{
		$rowAudio = $this->Ep4_release_model->get_audio_by_id($audio_id);
		$rsAudio = $this->vigilantedblib->_db_return_rs($rowAudio);

		$this->_redirect_to_audio($rsAudio->audio_mp3_file_path, $rsAudio->audio_mp3_file_name);
	}

	function save($id, $type = null)
	{
		switch ($type)
		{
			case "audio":
				$this->save_audio($id);
				break;
			case "ex_machina":
			case "vocals":
				$path = $this->ep4_audio_path_base . '/_' . $type;
				$this->_output_audio_file($path, $filename);
				break;
			default:
				$this->save_track($id);
				break;
		}
	}

	function save_track($track_id)
	{
		$rowTrack = $this->Ep4_release_model->get_audio_by_track_id($track_id);
		$rsTrack = $this->vigilantedblib->_db_return_rs($rowTrack);

		$this->_output_audio_file($rsTrack->audio_mp3_file_path, $rsTrack->audio_mp3_file_name);
	}

	function save_audio($audio_id)
	{
		$rowAudio = $this->Ep4_release_model->get_audio_by_id($audio_id);
		$rsAudio = $this->vigilantedblib->_db_return_rs($rowAudio);

		$this->_output_audio_file($rsAudio->audio_mp3_file_path, $rsAudio->audio_mp3_file_name);
	}

	function log_audio($map_audio_id)
	{
		if (false !== ($rowSong = $this->Ep4_release_model->get_audio_file($map_audio_id)))
		{
			//$this->vigilantecorelib->debug_trace($this->db->last_query());
			$rsSong = $this->vigilantedblib->_db_return_rs($rowSong);
			$filename = $rsSong->audio_mp3_file_name;
			$result = $this->_log_audio_save($map_audio_id, $_SERVER['REMOTE_ADDR'], $filename);
			echo $result;
			die();
		}
		echo false;
		die();
	}

	function log_release($audio_zip_file_name)
	{
		if (!empty($audio_zip_file_name))
		{
			$this->_log_release_save($_SERVER['REMOTE_ADDR'], $audio_zip_file_name);
			echo true;
			die();
		}
		echo false;
		die();
	}

	// Private methods
	function _debug_trace($msg)
	{
		$this->vigilantecorelib->debug_trace($msg);
	}

	function _redirect_to_audio ($path, $file)
	{
		$audio_full_path = $this->ep4_audio_file_base . $path . '/' . $file;
		$audio_url = $this->ep4_audio_url_base . $path . '/' . $file;

		if (file_exists($audio_full_path))
		{
			header('Location: ' . $audio_url);
		}
		else
		{
			show_error("An audio file could not be retrieve");
		}
		die();
	}

	function _output_audio_file($path, $file = '', $save = true)
	{
		$full_path = $this->ep4_audio_file_base . $path . '/' . $file;
		$size = filesize($full_path);
		if (false !== ($fp = fopen($full_path, 'rb')))
		{
			$disposition = $save == true ? 'attachment' : 'inline';

			header('Cache-Control: private');
			header('Content-Disposition: ' . $disposition . '; filename="' . $file. '"');
			header('Content-Length: ' . $size);
			header('Content-Type: audio/mpeg');

			while (!feof($fp))
			{
				echo fread($fp, 131072);
			}
			fclose($fp);
		}
	}

	function _log_audio_save($log_audio_id, $log_ip, $audio_mp3_file_name)
	{
		$now = date('Y-m-d h:i:s');
		$input['log_ip'] = $log_ip;
		$input['log_date_added'] = $now;

		if (empty($audio_mp3_file_name))
		{
			$input['log_message'] = $log_ip . ' accessed the audio logging script without an audio file on ' . $now . '.';
			$this->Ep4_release_model->add_audio_log($input);
			return false;
		}
		else
		{
			$input['log_audio_id'] = $log_audio_id;
			$input['log_message'] = $audio_mp3_file_name . ' was saved from IP address ' . $log_ip . ' on ' . $now . '.';
			$this->Ep4_release_model->add_audio_log($input);
			return true;
		}

		//$this->vigilantecorelib->debug_trace($this->db->last_query());
	}

	function _log_release_save($log_ip, $audio_zip_file_name)
	{
		$now = date('Y-m-d h:i:s');

		$input['log_ip'] = $log_ip;
		$input['log_date_added'] = $now;
		$input['log_message'] = $audio_zip_file_name . ' was saved from IP address ' . $log_ip . ' on ' . $now . '.';

		$this->Ep4_release_model->add_audio_log($input);
		//$this->vigilantecorelib->debug_trace($this->db->last_query());
	}
}
?>