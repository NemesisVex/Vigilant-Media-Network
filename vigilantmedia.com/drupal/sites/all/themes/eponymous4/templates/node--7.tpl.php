<?php
$albums = array();
if (class_exists('OR_Albums')) {
	$album_info = new OR_Albums();
	$albums = $album_info->get_albums('eponymous-4');

	$taxonomy = array_keys(taxonomy_get_term_by_name('Music'));
	$node_ids = taxonomy_select_nodes($taxonomy[0]);
	$album_aliases = array();

	foreach ($node_ids as $node_id) {
		$node = node_load($node_id);
		$album_aliases[] = $node->field_album_alias[$node->language][0]['value'];
	}

}
?>

<?php if (!empty($albums)):?>
<ul class="album-list">
	<?php foreach ($albums as $album): ?>
		<?php if (false !== array_search($album['album_alias'], $album_aliases)): ?>
	<li>
		<a href="/music/<?php echo $album['album_alias'];?>"><img src="sites/eponymous4.com/files/images/_covers/_exm_front_200_<?php echo $album['album_image'];?>" alt="<?php echo $album['album_title'] ?>" title="<?php echo $album['album_title']; ?>" /></a>
	</li>
		<?php endif; ?>
	<?php endforeach; ?>
</ul>
<?php else: ?>
<p>Albums for this artist are not yet available.</p>
<?php endif; ?>
