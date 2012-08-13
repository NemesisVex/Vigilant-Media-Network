<?php

class OR_Albums extends OR_Model {
	
	public function __construct() {
		parent::__construct();
		$this->connect();
	}
	
	public function get_albums($artist_alias) {
		$this->activate();
		
		$query = '';
		$query .= 'select al.* from {ep4_albums} as al ';
		$query .= 'left join {ep4_artists} as ar ';
		$query .= 'on al.album_artist_id = ar.artist_id ';
		$query .= 'where ar.artist_alias = :artist_alias ';
		$query .= 'and al.album_is_visible = 1 ';
		$query .= 'order by al.album_release_date';
		
		$args = array(':artist_alias' => $artist_alias);
		
		$rsAlbums = db_query($query, $args)->fetchAllAssoc('album_alias', PDO::FETCH_ASSOC);
		
		$this->deactivate();
		return $rsAlbums;
	}
	
	public function get_album($album_alias) {
		$this->activate();

		$query = '';
		$query .= 'select * from {ep4_albums} as al ';
		$query .= 'where al.album_alias = :album_alias ';
		
		$args = array(':album_alias' => $album_alias);
		
		$rsAlbum = db_query($query, $args)->fetchAssoc();
		$rsAlbum['releases'] = $this->get_releases($album_alias);
		
		$this->deactivate();
		return $rsAlbum;
	}
	
	public function get_releases($album_alias, $order_by = 'r.release_release_date desc') {
		$this->activate();
		
		$query = '';
		$query .= 'select r.* from {ep4_albums_releases} as r ';
		$query .= 'left join {ep4_albums} as al ';
		$query .= 'on r.release_album_id = al.album_id ';
		$query .= 'where al.album_alias = :album_alias ';
		$query .= 'order by :order_by';
		
		$args = array(':album_alias' => $album_alias, ':order_by' => $order_by);
		
		$rsReleases = db_query($query, $args)->fetchAllAssoc('release_alias', PDO::FETCH_ASSOC);
		
		$this->deactivate();
		return $rsReleases;
	}
	
	public function get_release($release_alias) {
		$this->activate();
		
		$query = '';
		$query .= 'select r.* from {ep4_albums_releases} as r ';
		$query .= 'left join {ep4_albums} as al ';
		$query .= 'on r.release_album_id = al.album_id ';
		$query .= 'where r.release_alias = :release_alias ';
		
		$args = array(':release_alias' => $release_alias);
		
		$rsReleases = db_query($query, $args)->fetchAssoc();
		
		$this->deactivate();
		return $rsReleases;
	}
	
	public function get_album_block_content($node) {
		$content = array();
		
		if (!empty($node->type)) {
			$node_view = node_view($node);
			
			$album_alias = $node_view['field_album_alias']['#items'][0]['value'];
			$artist_alias = $node_view['field_artist_alias']['#items'][0]['value'];
			
			if (!empty($album_alias)) {
				$content = array($this->get_album($album_alias));
			} elseif (!empty($artist_alias)) {
				$content = $this->get_albums($artist_alias);
			}
		}
		
		return $content;
	}
	
	public function get_album_node_content($node) {
		$content = array();
		
		if (!empty($node->field_album_alias)) {
			$album_alias = $node->field_album_alias[$node->language][0]['value'];
			$content = array($this->get_album($album_alias));
		} elseif (!empty($node->field_artist_alias)) {
			$artist_alias = $node->field_artist_alias[$node->language][0]['value'];
			$content = $this->get_albums($artist_alias);
		}

		return $content;
	}
	
	public function get_release_block_content($node) {
		$content = array();
		
		if (!empty($node->type)) {
			$node_view = node_view($node);
			
			$release_alias = $node_view['field_release_alias']['#items'][0]['value'];
			
			if (!empty($release_alias)) {
				$content = array($this->get_release($release_alias));
			}
		}
		
		return $content;
	}
	
	public function get_release_node_content($node) {
		$content = array();
		
		if (!empty($node->field_release_alias)) {
			$release_alias = $node->field_release_alias[$node->language][0]['value'];
			$content = array($this->get_release($release_alias));
		}

		return $content;
	}
	
	public function __destruct() {
		$this->deactivate();
	}
}