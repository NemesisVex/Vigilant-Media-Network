<?php
$albums = array();
if (class_exists('OR_Albums')) {
	$album_info = new OR_Albums();
	$albums = $album_info->get_albums('eponymous-4');

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
<ul class="album-list">
	<?php foreach ($albums as $album): ?>
		<?php if (false !== array_search($album['album_alias'], $album_aliases)): ?>
	<li>
		<pre>
		<?php print_r($album); ?>
		</pre>
		<a href="/music/<?php echo $album['album_alias'];?>"><img src="sites/eponymous4.com/files/images/_covers/_exm_front_200_<?php echo $album['album_image'];?>" alt="<?php echo $album['album_title'] ?>" title="<?php echo $album['album_title']; ?>" /></a>
	</li>
		<?php endif; ?>
	<?php endforeach; ?>
</ul>
<?php else: ?>
<p>Albums for this artist are not yet available.</p>
<?php endif; ?>
