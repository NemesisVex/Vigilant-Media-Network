<?php

class Audio extends CI_Controller
{
	var $artist_id = 1;
	var $production_file_path;

	function __construct()
	{
		parent::__construct();
		$this->load->library('MtLib');
		$this->load->library('MyId3');
		$this->load->model('Mt_ep4_artist_model');
		$this->load->model('Mt_ep4_album_model');
		$this->load->model('Mt_ep4_release_model');
		$this->load->model('Mt_ep4_tracks_model');
		$this->load->model('Mt_ep4_song_model');
		$this->load->model('Mt_ep4_audio_model');

		$this->production_file_path = OBSERVANTRECORDS_ROOT_PATH;

		$this->myid3->setOption(array('encoding' => 'UTF-8'));
		$this->mysmarty->assign('session', $this->phpsession);
	}

	// View methods

	function index()
	{
		header('Location: /index.php/mt/ep4/');
	}

	function browse($audio_artist_id, $function = 'edit')
	{
		$header = $function == 'delete' ? 'Delete audio file' : 'Edit audio file';
		$rsArtist = $this->mtlib->_format_ep4_section_head($audio_artist_id, $header);

		$rowFiles = $this->Mt_ep4_audio_model->get_files_by_artist_id($audio_artist_id);
		$rsFiles = $this->vigilantedblib->_db_return_smarty_array($rowFiles);

		$this->mysmarty->assign('rsFiles', $rsFiles);
		$this->mysmarty->assign('audio_artist_id', $audio_artist_id);
		$this->mysmarty->assign('function', $function);
		$this->mtlib->_smarty_display_mt_page('mt_ep4_audio_browse.tpl');
	}

	function add($audio_artist_id, $template = 'mt_ep4_audio_edit.tpl', $header = 'Add audio file')
	{
		if (empty($audio_artist_id)) {$audio_artist_id = $this->artist_id;}
		$rsArtist = $this->mtlib->_format_ep4_section_head($audio_artist_id, $header);

		$rowArtists = $this->Mt_ep4_artist_model->get_all_artists();
		$rsArtists = $this->vigilantedblib->_db_return_smarty_array($rowArtists);

		$rowSongs = $this->Mt_ep4_song_model->get_all_songs();
		$rsSongs = $this->vigilantedblib->_db_return_smarty_array($rowSongs);

		$this->mysmarty->assign('rsArtists', $rsArtists);
		$this->mysmarty->assign('rsSongs', $rsSongs);
		$this->mysmarty->assign('audio_artist_id', $audio_artist_id);
		$this->mtlib->_smarty_display_mt_page($template);
	}

	function edit($audio_id, $audio_artist_id, $template = 'mt_ep4_audio_edit.tpl', $header = 'Edit audio file')
	{
		$rsAudio = $this->Mt_ep4_audio_model->get_audio_by_id($audio_id);

		if (empty($audio_artist_id))
		{
			$audio_artist_id = !empty($rsAudio->audio_artist_id) ? $rsAudio->audio_artist_id : $this->artist_id;
		}

		if (!empty($rsAudio))
		{
			$audio_full_path = $this->production_file_path . $rsAudio->audio_mp3_file_path . '/' . $rsAudio->audio_mp3_file_name;
			$audio_tags = $this->myid3->analyze($audio_full_path);
			$this->mysmarty->assign('audio_tags', $audio_tags);
		}

		$this->mysmarty->assign('rsAudio', $rsAudio);
		$this->mysmarty->assign('audio_id', $audio_id);
		$this->add($audio_artist_id, $template, $header);
	}

	function delete($audio_id, $audio_artist_id)
	{
		$this->edit($audio_id, $audio_artist_id, 'mt_ep4_audio_delete.tpl', 'Delete an audio file');
	}

	function tag($audio_id, $path = '_vocals', $version = 'id3v2')
	{
		$rsAudio = $this->Mt_ep4_audio_model->get_audio_by_id($audio_id);
		$rsArtist = $this->mtlib->_format_ep4_section_head($rsAudio->audio_artist_id, 'Edit audio file');

		$audio_path = $rsAudio->audio_mp3_file_path . '/' . $rsAudio->audio_mp3_file_name;
		$audio_full_path = $this->production_file_path . $audio_path;
		$file_tags = $this->myid3->analyze($audio_full_path);
		//print_r($file_tags);

		$this->mysmarty->assign('rsAudio', $rsAudio);
		$this->mysmarty->assign('audio_id', $audio_id);
		$this->mysmarty->assign('file', $audio_path);
		$this->mysmarty->assign('path', $audio_full_path);
		$this->mysmarty->assign('file_tags', $file_tags);
		$this->mysmarty->assign('version', $version);
		$this->mtlib->_smarty_display_mt_page('mt_ep4_audio_edit_tag.tpl');
	}

	function releases($release_artist_id)
	{
		$rsArtist = $this->mtlib->_format_ep4_section_head($release_artist_id, 'Map file to track');

		$rowReleases = $this->Mt_ep4_release_model->get_releases_by_artist_id($release_artist_id);
		$rsReleases = $this->vigilantedblib->_db_return_smarty_array($rowReleases);

		$this->mysmarty->assign('rsReleases', $rsReleases);
		$this->mysmarty->assign('release_artist_id', $release_artist_id);
		$this->mtlib->_smarty_display_mt_page('mt_ep4_audio_map_releases.tpl');
	}

	function tracks($release_id)
	{
		$rsRelease = $this->Mt_ep4_release_model->get_release_by_id($release_id);
		$rsArtist = $this->mtlib->_format_ep4_section_head($rsRelease->album_artist_id, 'Map file to track');

		$rowTracks = $this->Mt_ep4_tracks_model->get_tracks_mapped_to_audio($release_id);
		$rsTracks = $this->vigilantedblib->_db_return_smarty_array($rowTracks);

		$rowFiles = $this->Mt_ep4_audio_model->get_files_by_artist_id($rsRelease->album_artist_id);
		$rsFiles = $this->vigilantedblib->_db_return_smarty_array($rowFiles);

		$this->mysmarty->assign('rsTracks', $rsTracks);
		$this->mysmarty->assign('rsFiles', $rsFiles);
		$this->mysmarty->assign('rsRelease', $rsRelease);
		$this->mysmarty->assign('release_id', $release_id);
		$this->mysmarty->assign('artist_id', $rsRelease->album_artist_id);
		$this->mtlib->_smarty_display_mt_page('mt_ep4_audio_map_tracks.tpl');
	}

	// Processing methods

	function update($audio_id)
	{
		$audio_mp3_file_name = $this->input->get_post('audio_mp3_file_name');
		$audio_artist_id = $this->input->get_post('audio_artist_id');

		$karaoke = $this->input->get_post('karaoke');
		$vocals = $this->input->get_post('vocals');

		$rsAudio = $this->Mt_ep4_audio_model->get_audio_by_id($audio_id);
		$input = $this->vigilantedblib->_db_build_update_data($rsAudio);

		if (!empty($input))
		{
			$input['audio_id'] = $audio_id;
			if (false !== $this->Mt_ep4_audio_model->update_audio_by_id($audio_id, $input))
			{
				$this->phpsession->flashsave('msg', 'Audio file information was updated.');
			}
		}

		header('Location: /index.php/ep4/audio/edit/' . $audio_id . '/' . $audio_artist_id . '/');
		die();
	}

	function create($audio_artist_id)
	{
		// Prevent duplication
		$audio_mp3_file_name = $this->input->get_post('audio_mp3_file_name');
		$audio_mp3_file_path = $this->input->get_post('audio_mp3_file_path');

		$rowAudio = $this->Mt_ep4_audio_model->get_audio_by_file_path($audio_mp3_file_name, $audio_mp3_file_path);

		if ($rowAudio->num_rows() > 0) {
			$this->phpsession->flashsave('msg', 'A record was found with the same file path information.');
			header('Location: /index.php/ep4/audio/add/' . $audio_artist_id . '/');
			die();
		}

		$rsAudio = $this->db->get('ep4_audio', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsAudio);
		$input['audio_artist_id'] = $audio_artist_id;

		if (false !== $this->Mt_ep4_audio_model->add_audio($input))
		{
			$this->phpsession->flashsave('msg', 'Audio file information was created.');
			$audio_id = $this->db->insert_id();
		}

		header('Location: /index.php/ep4/audio/edit/' . $audio_id . '/' . $audio_artist_id . '/');
		die();
	}

	function remove($audio_id, $audio_artist_id)
	{
		$confirm = $this->input->get_post('confirm');
		$audio_mp3_file_name = $this->input->get_post('audio_mp3_file_name');

		if ($confirm == 'Yes')
		{
			$this->Mt_ep4_audio_model->delete_audio_maps_by_audio_id($audio_id);
			$this->Mt_ep4_audio_model->delete_audio_by_id($audio_id);

			$this->phpsession->flashsave('msg', $audio_mp3_file_name . ' was deleted.');
		}
		elseif ($confirm == 'No')
		{
			$this->phpsession->flashsave('msg', $audio_mp3_file_name . ' was not deleted.');
		}

		header('Location: /index.php/ep4/artist/info/' . $audio_artist_id . '/');
		die();
	}

	function map($release_id)
	{
		$map_in = $this->input->get_post('map_in');
		foreach ($map_in as $map)
		{
			if (!empty($map['map_id']))
			{
				!empty($map['delete']) ? $this->_delete_map($map) : $this->_update_map($map);
			}
			else
			{
				if (!empty($map['map_audio_id']))
				{
					$this->_add_map($map);
				}
			}
		}

		$this->phpsession->flashsave('msg', 'Your audio mapping is now saved.');

		header('Location: /index.php/ep4/audio/tracks/' . $release_id . '/');
		die();
	}

	function retag($audio_id)
	{
		$tag = $this->input->get_post('tag');
		$version = $this->input->get_post('version');
		$audio_artist_id = $this->input->get_post('audio_artist_id');

		$rsAudio = $this->Mt_ep4_audio_model->get_audio_by_id($audio_id);
		$path = $this->production_file_path . $rsAudio->audio_mp3_file_path . '/' . $rsAudio->audio_mp3_file_name;

		if (!empty($rsAudio->audio_mp3_file_name))
		{
			if (false !== $this->_update_tag($path, $tag, $version))
			{
				$this->phpsession->flashsave('msg', 'MP3 tag information is now saved.');

			}
		}

		header('Location: /index.php/ep4/audio/edit/' . $audio_id . '/' . $audio_artist_id . '/');
		die();
	}

	// Private methods
	function _update_map($map)
	{
		$map_id = $map['map_id'];
		$rsMap = $this->Mt_ep4_audio_model->get_audio_map_by_id($map_id);

		$input = $this->vigilantedblib->_db_build_update_data($rsMap, $map);

		if (!empty($input))
		{
			$this->Mt_ep4_audio_model->update_audio_map_by_id($map_id, $input);
		}
	}

	function _add_map($map)
	{
		$rsMap = $this->db->get('ep4_audio_map', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsMap, $map);

		if (!empty($input))
		{
			$this->Mt_ep4_audio_model->add_audio_map($input);
		}
	}

	function _delete_map($map)
	{
		$map_id = $map['map_id'];
		$this->Mt_ep4_audio_model->delete_audio_map_by_id($map_id);
	}

	function _update_tag($file, $input, $version = 'id3v1')
	{
		switch ($version)
		{
			case 'id3v2':
				$tag_format = 'UTF-8';
				$version_array = array('id3v2.4');
				break;
			default:
				$tag_format = 'ISO-8859-1';
				$version_array = array('id3v1');
		}

		$this->myid3->setOption(array('encoding' => $tag_format));
		foreach ($input as $field => $value)
		{
			$tag_data[$field][]  = $value;
		}

		if (!empty($tag_data))
		{
			$tagwriter = $this->myid3->id3_tagwriter();
			$tagwriter->filename = $file;
			$tagwriter->tagformats = $version_array;
			$tagwriter->overwrite_tags = true;
			$tagwriter->tag_encoding   = $tag_format;
			$tagwriter->remove_other_tags = false;
			$tagwriter->tag_data = $tag_data;

			$tagwriter->WriteTags();
			if (!empty($tagwriter->warnings)) {
				echo 'There were some warnings:<br>'.implode('<br><br>', $tagwriter->warnings);
			}
			return true;
		}
		return false;
	}


}

?>