<?php if (count($albums) > 0): ?>
	<?php foreach ($albums as $album): ?>

<?php if (!empty($album['releases'])): ?>
	<?php if (!empty($release_alias)): ?>
<p>
	<img src="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/' . variable_get('file_public_path', conf_path() . '/files');?>/images/_covers/_exm_front_200_<?php echo $album['album_image']; ?>" title="<?php echo $album['album_title']; ?>" /><br/>
	<a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/' . variable_get('file_public_path', conf_path() . '/files');?>/images/_covers/_exm_front_342_<?php echo $album['album_image']; ?>" rel="facebox" class="smaller">View larger image</a>
</p>

<ul>
	<?php if (!empty($album['releases'][$release_alias]['release_release_date'])): ?>
	<li>
		Release date: <?php echo date('m/d/Y', strtotime($album['releases'][$release_alias]['release_release_date'])); ?>
	</li>
	<?php endif; ?>
	<?php if (!empty($album['releases'][$release_alias]['release_label'])): ?>
	<li>
		Label: <?php echo $album['releases'][$release_alias]['release_label']; ?>
	</li>
	<?php endif; ?>
</ul>
	<?php else: ?>
		<?php foreach ($album['releases'] as $release): ?>
<ul>
	<?php if(!empty($release['release_release_date'])): ?>
	<li>
		Release date: <?php echo date('m/d/Y', strtotime($release['release_release_date'])); ?>
	</li>
	<?php endif; ?>
	<?php if(!empty($release['release_label'])): ?>
	<li>
		Label: <?php echo $release['release_label']; ?>
	</li>
	<?php endif; ?>
</ul>
		<?php endforeach; ?>
	<?php endif; ?>
<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>
