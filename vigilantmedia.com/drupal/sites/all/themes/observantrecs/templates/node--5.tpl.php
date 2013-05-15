<?php
$artists = array();
if (class_exists('OR_Artist')) {
	$artist_info = new OR_Artist();
	$artists = $artist_info->get_artists();
}

$albums = array();
if (class_exists('OR_Albums')) {
	$album_info = new OR_Albums();
	$albums = $album_info->get_albums(null, array('order_by' => 'al.album_release_date desc'));

	$node_ids = db_query('select * from {node} where type = :type', array(':type' => 'album'))->fetchAllAssoc('nid', PDO::FETCH_ASSOC);
	$album_aliases = array();

	foreach ($node_ids as $node_id => $node_info) {
		$node = node_load($node_id);
		if (!empty($node->field_album_alias)) {
			$album_aliases[] = $node->field_album_alias[$node->language][0]['value'];
		}
	}

}
?>

<?php if (!empty($albums)):?>
<?php $r = 1; ?>
<div class="release-row">
	<?php foreach ($albums as $album): ?>
		<?php if (false !== array_search($album['album_alias'], $album_aliases)): ?>
	<div class="release<?php if ($r % 4 == 0):?>-last<?php endif; ?>">
		<a href="releases/<?php echo $album['album_alias'];?>"><img src="sites/observantrecords.com/files/images/_covers/_exm_front_200_<?php echo $album['album_image'];?>" alt="<?php echo $album['album_title'] ?>" title="<?php echo $album['album_title']; ?>" /></a>
		<ul class="release-list-info">
			<li><strong><a href="releases/<?php echo $album['album_alias']; ?>"><?php echo $album['album_title']; ?></a></strong></li>
			<li><?php echo $album['artist_display_name']; ?></li>
		</ul>
	</div>
		<?php $r++; ?>
		<?php endif; ?>
	<?php endforeach; ?>
</div>
<?php else: ?>
<p>Albums for this artist are not yet available.</p>
<?php endif; ?>
