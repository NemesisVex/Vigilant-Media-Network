<?php

class OR_Tracks extends OR_Model {
	
	public function __construct() {
		parent::__construct();
		$this->connect();
	}
	
	public function get_track($track_alias) {
		$this->activate();
		
		$query = '';
		$query .= 'select t.*, s.*, au.* from ';
		$query .= '((({ep4_tracks} as t ';
		$query .= 'left join {ep4_songs} as s ';
		$query .= 'on t.track_song_id = s.song_id) ';
		$query .= 'left join {ep4_albums_releases} as r ';
		$query .= 'on t.track_release_id = r.release_id) ';
		$query .= 'left join {ep4_albums} as al ';
		$query .= 'on r.release_album_id = al.album_id) ';
		$query .= 'left outer join {ep4_audio} as au ';
		$query .= 'on t.track_audio_id = au.audio_id ';
		$query .= 'where t.track_alias = :track_alias ';
		$query .= 'order by t.track_disc_num, t.track_track_num';
		
		$args = array(':track_alias' => $track_alias);
		
		$rsTrack = db_query($query, $args)->fetchAssoc();
		
		$this->deactivate();
		
		return $rsTrack;
	}
	
	public function get_release_tracks($release_alias) {
		$this->activate();
		
		$query = '';
		$query .= 'select t.*, s.*, au.* from ';
		$query .= '((({ep4_tracks} as t ';
		$query .= 'left join {ep4_songs} as s ';
		$query .= 'on t.track_song_id = s.song_id) ';
		$query .= 'left join {ep4_albums_releases} as r ';
		$query .= 'on t.track_release_id = r.release_id) ';
		$query .= 'left join {ep4_albums} as al ';
		$query .= 'on r.release_album_id = al.album_id) ';
		$query .= 'left outer join {ep4_audio} as au ';
		$query .= 'on t.track_audio_id = au.audio_id ';
		$query .= 'where r.release_alias = :release_alias ';
		$query .= 'order by t.track_disc_num, t.track_track_num';
		
		$args = array(':release_alias' => $release_alias);
		
		$rsTrack = db_query($query, $args)->fetchAllAssoc('track_id', PDO::FETCH_ASSOC);
		
		$this->deactivate();
		
		return $rsTrack;
	}
	
	public function get_album_tracks($album_alias) {
		$this->activate();
		
		$query = '';
		$query .= 'select t.*, s.* from ';
		$query .= '(({ep4_tracks} as t ';
		$query .= 'left join {ep4_songs} as s ';
		$query .= 'on t.track_song_id = s.song_id) ';
		$query .= 'left join {ep4_albums_releases} as r ';
		$query .= 'on t.track_release_id = r.release_id) ';
		$query .= 'left join {ep4_albums} as al ';
		$query .= 'on r.release_album_id = al.album_id ';
		$query .= 'where al.album_alias = :release_alias ';
		$query .= 'order by t.track_disc_num, t.track_track_num';
		
		$args = array(':album_alias' => $album_alias);
		
		$rsTrack = db_query($query, $args)->fetchAllAssoc('track_id', PDO::FETCH_ASSOC);
		
		$this->deactivate();
		
		return $rsTrack;
	}
	
	public function get_track_block_content($node) {
		$content = array();
		
		if (!empty($node->type)) {
			$node_view = node_view($node);
			
			if (!empty($node_view['field_release_alias'])) {
				$release_alias = $node_view['field_release_alias']['#items'][0]['value'];
			}
			if (!empty($node_view['field_album_alias'])) {
				$album_alias = $node_view['field_album_alias']['#items'][0]['value'];
			}
			
			if (!empty($album_alias) && !empty($release_alias)) {
				$content = array($this->get_release_tracks($release_alias));
			} elseif (!empty($album_alias)) {
				$content = array($this->get_album_tracks($album_alias));
			}
		}
		
		return $content;
	}
	
	public function get_track_node_content($node) {
		$content = array();
		
		if (!empty($node->field_track_alias)) {
			$track_alias = $node->field_track_alias[$node->language][0]['value'];
			$content = array($this->get_track($track_alias));
		} elseif (!empty($node->field_release_alias)) {
			$release_alias = $node->field_release_alias[$node->language][0]['value'];
			$content = $this->get_release_tracks($release_alias);
		} elseif (!empty($node->field_album_alias)) {
			$album_alias = $node->field_album_alias[$node->language][0]['value'];
			$content = $this->get_album_tracks($album_alias);
		}

		return $content;
	}
	
	public function __destruct() {
		$this->deactivate();
	}
}