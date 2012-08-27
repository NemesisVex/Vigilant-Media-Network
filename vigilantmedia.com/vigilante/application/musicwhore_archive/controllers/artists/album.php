<?php

class Album extends CI_Controller
{
	var $artist_id = 1;

	function __construct()
	{
		parent::__construct();
		$this->load->library('ArchiveLib');
		$this->load->library('MyAmazon');
		$this->load->library('MyEcommerce');
		$this->load->library('MyMusicbrainz');
		$this->load->model('Mw_artist_model');
		//$this->load->model('Mw_album_model');
		$this->load->model('Mw_release_model');
		$this->load->model('Mw_tracks_model');
		$this->load->model('Mw_ecommerce_model');
		$this->load->model('Mw_content_model');
		$this->load->model('Mw_lyrics_model');
		$this->load->model('Mw_mt_model');

		$this->archivelib->_format_side_navigation();
		$this->archivelib->mw_config['album_format_mask'] = array(2 => 'album', 4 => 'single', 8 => 'ep', 16 => 'compilation', 32 => 'video', 64 => 'book');
		$this->archivelib->mw_config['amazon_locale'] = $this->myamazon->amazon_locale;
	}

	// View methods

	function index()
	{
		header('Location: /index.php/artists/artist/browse/a/');
	}

	function browse($album_artist_id, $format_mask = 2)
	{
		$rsArtist = $this->archivelib->_format_mw_section_head($album_artist_id, 'Discography');

		$rowFormats = $this->Mw_release_model->get_artist_releases_by_format_mask($album_artist_id);
		if ($rowFormats->num_rows > 0)
		{
			$rsFormats = $this->vigilantedblib->_db_return_smarty_array($rowFormats);

			if (empty($format_mask)) {$format_mask = $rsFormats[0]->album_format_mask;}

			$rowAlbums = $this->Mw_release_model->get_releases_by_artist_id($album_artist_id, $format_mask);
			$rsAlbums = $this->vigilantedblib->_db_return_smarty_array($rowAlbums);
			//$this->vigilantecorelib->debug_trace($this->db->last_query());

			$this->mysmarty->assign('rsArtist', $rsArtist);
			$this->mysmarty->assign('rsAlbums', $rsAlbums);
			$this->mysmarty->assign('rsFormats', $rsFormats);
		}
		$this->mysmarty->assign('album_artist_id', $album_artist_id);
		$this->mysmarty->assign('artist_id', $album_artist_id);
		$this->archivelib->_smarty_display_mw_page('amwb_artists_artist_album.tpl');
	}

	function tracks($release_id, $album_artist_id = '')
	{
		$rsRelease = $this->Mw_release_model->get_release_by_id($release_id);
		$asin = $rsRelease->release_asin_num;
		//$this->vigilantecorelib->debug_trace($this->db->last_query());

		if (empty($album_artist_id))
		{
			$album_artist_id = $rsRelease->album_artist_id;
		}

		$rsArtist = $this->archivelib->_format_mw_section_head($album_artist_id, 'Discography');
		$locale = $rsArtist->artist_default_amazon_locale;

		$track_out = array();
		if (false !== ($rowTracks = $this->Mw_tracks_model->get_tracks_by_release_id($release_id)))
		{
			//$rsTracks = $this->vigilantedblib->_db_return_smarty_array($rowTracks);
			//$this->vigilantecorelib->debug_trace($this->db->last_query());
			foreach ($rowTracks->result() as $rs)
			{
				//$rsTracks[] = $rs;
				$disc_num = $rs->track_disc_num;
				$track_num = $rs->track_track_num;
				$track_out[$disc_num][$track_num]['track_song_title'] = ($locale=='jp') ? '' : $rs->track_song_title;
				$track_out[$disc_num][$track_num]['track_l10n_furigana'] = ($locale=='jp') ? $rs->track_song_title : '';
				$track_out[$disc_num][$track_num]['track_alt_title'] = $rs->track_alt_title;
				$track_out[$disc_num][$track_num]['lyric_map_lyric_id'] = $rs->lyric_map_lyric_id;
			}
		}

		if (!empty($asin))
		{
			$amazon_url = $this->myamazon->build_amazon_url($asin, $locale);
			$this->mysmarty->assign('amazon_url', $amazon_url);

			$items = $this->_lookup($asin, $locale, 'Large');
			$display = empty($items->Request->Errors) ? true : false;

			if (!empty($items))
			{
				if ($display == true)
				{
					$amazon_discs = $items->Item->Tracks->Disc;
					foreach ($amazon_discs as $disc)
					{
						$disc_num = intval($disc['Number']);
						foreach ($disc->Track as $track)
						{
							$track_num = intval($track['Number']);
							if (empty($track_out[$disc_num][$track_num]['track_song_title'])) {$track_out[$disc_num][$track_num]['track_song_title'] = $track;}
						}
					}
				}

				$image_uri = $items->Item->SmallImage->URL;
			}

		}
		elseif (false !== ($rowBrainz = $this->Mw_release_model->get_mb_gids_by_release_id($release_id)))
		{
			foreach ($rowBrainz->result() as $rs)
			{
				if (!empty($rs->mb_album_mb_gid))
				{
					$this->mymusicbrainz->get_release_by_id($rs->mb_album_mb_gid, 'tracks');
					//$this->vigilantecorelib->debug_trace('<a href="' . $this->mymusicbrainz->request_uri . '">XML URL</a>');
					$disc_num = (preg_match("/\(disc ([0-9]*)\)/", $this->mymusicbrainz->results->release->title, $match)) ? $match[1] : 1;
					if (!empty($this->mymusicbrainz->results->release->{'track-list'}->track))
					{
						$track_num = 1;
						foreach ($this->mymusicbrainz->results->release->{'track-list'}->track as $track)
						{
							$track_out[$disc_num][$track_num]['track_song_title'] = $track->title;
							$track_num++;
						}
					}
				}
			}
		}

		if ($locale == 'jp')
		{
			if (!empty($track_out))
			{
				foreach ($track_out as $disc_num => $disc)
				{
					foreach ($disc as $track_num => $track)
					{
						if (!empty($track_out[$disc_num][$track_num]['track_song_title']) && !empty($track_out[$disc_num][$track_num]['track_l10n_furigana']))
						{
							$compare_song = preg_replace("/ /", "" , $track_out[$disc_num][$track_num]['track_song_title']);
							$compare_alt = preg_replace("/ /", "" , $track_out[$disc_num][$track_num]['track_l10n_furigana']);
							$compare_song = strtolower($compare_song);
							$compare_alt = strtolower($compare_alt);
							if (strcmp($compare_song, $compare_alt)==0)
							{
								$track_out[$disc_num][$track_num]['track_l10n_furigana'] = null;
							}
						}
						elseif (empty($track_out[$disc_num][$track_num]['track_song_title']) && !empty($track_out[$disc_num][$track_num]['track_l10n_furigana']))
						{
							$track_out[$disc_num][$track_num]['track_song_title'] = $track_out[$disc_num][$track_num]['track_l10n_furigana'];
							$track_out[$disc_num][$track_num]['track_l10n_furigana'] = null;
						}
					}
				}
			}
		}

		if (false !== ($rsReleaseEcomm = $this->Mw_release_model->get_itunes_by_release_id($release_id)))
		{
			$rowITunesTracks = $this->Mw_tracks_model->get_itunes_tracks_by_release_id($release_id);
			if (false !== ($rowITunesTracks->num_rows() > 0))
			{
				foreach ($rowITunesTracks->result() as $rs)
				{
					$disc_num = $rs->track_disc_num;
					$track_num = $rs->track_track_num;

					$itunes_url = $this->myecommerce->build_itunes_album_url($rsReleaseEcomm->ecommerce_ecomm_id, $rs->ecommerce_ecomm_id, $locale);
					//$this->vigilantecorelib->debug_trace($itunes_url);

					$track_out[$disc_num][$track_num]['itunes_url'] = $itunes_url;
				}
			}
		}

		if (false !== ($rsLinks = $this->archivelib->_build_buy_links($release_id, $locale)))
		{
			$this->mysmarty->assign('rsLinks', $rsLinks);
		}

		if (!empty($disc_num))
		{
			$num_discs = $disc_num;
			$this->mysmarty->assign("num_discs", $num_discs);
		}

		if (empty($image_uri))
		{
			$image_uri = '/images/1pixel.gif';

			$image_artist_subdir = strtolower(substr($rsArtist->artist_file_system, 0, 1)) . '/' . $rsArtist->artist_file_system;
			$release_image = $rsRelease->release_image ? $rsRelease->release_image : $rsRelease->album_image;

			$image_file_path = $this->archivelib->mw_config['img_discog_root'] . '/' . $image_artist_subdir . '/' . $release_image;
			if (!empty($release_image) && file_exists($image_file_path))
			{
				//$image_uri = $this->archivelib->mw_config['img_discog_base_uri'] . '/'. $image_artist_subdir . '/' . $release_image;
				$this->mysmarty->assign('release_image', $release_image);
			}
		}

		$this->mysmarty->assign('image_uri', $image_uri);
		$this->mysmarty->assign("track_out", $track_out);
		$this->mysmarty->assign('rsRelease', $rsRelease);
		$this->mysmarty->assign('rsArtist', $rsArtist);
		$this->mysmarty->assign('album_artist_id', $album_artist_id);
		$this->mysmarty->assign('artist_id', $album_artist_id);
		$this->archivelib->_smarty_display_mw_page('amwb_artists_artist_album_tracks.tpl');
	}

	// Private methods

	function _lookup($asin = '', $locale = 'us', $response_group = 'ItemAttributes')
	{
		$params['ResponseGroup'] = $response_group;

		$this->myamazon->__construct($locale);
		$this->myamazon->item_lookup($asin, $params);
		//$this->vigilantecorelib->debug_trace('<a href="' . $this->myamazon->request_uri . '">XML URL</a>');
		$items = $this->myamazon->results->Items;

		$this->mysmarty->assign('request_uri', $this->myamazon->request_uri);
		$this->mysmarty->assign('locale', $locale);
		return $items;
	}

}
?>