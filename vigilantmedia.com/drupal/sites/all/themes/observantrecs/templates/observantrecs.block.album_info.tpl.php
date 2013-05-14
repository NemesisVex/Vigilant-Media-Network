<?php if (count($albums) > 0): ?>
	<?php foreach ($albums as $album): ?>

		<?php if (!empty($album['releases'])): ?>
			<?php if (!empty($release_alias)): ?>
<p>
	<img src="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/' . variable_get('file_public_path', conf_path() . '/files');?>/images/_covers/_exm_front_1425_<?php echo $album['album_image']; ?>" title="<?php echo $album['album_title']; ?>" width="310" /><br/>
</p>

<ul>
				<?php if (!empty($album['releases'][$release_alias]['release_release_date'])): ?>
	<li>
		Release date: <?php echo date('m/d/Y', strtotime($album['releases'][$release_alias]['release_release_date'])); ?>
	</li>
				<?php endif; ?>
</ul>
				<?php if(!empty($album['releases'][$release_alias]['release_store_description'])): ?>
<h3>Buy</h3>
				<?php echo $album['releases'][$release_alias]['release_store_description']; ?>
				<?php endif; ?>
				<?php if(!empty($album['releases'][$release_alias]['release_credits'])): ?>
<h3>Credits</h3>
				<?php echo $album['releases'][$release_alias]['release_credits']; ?>
				<?php endif; ?>
			<?php else: ?>
				<?php foreach ($album['releases'] as $release): ?>
<ul>
					<?php if(!empty($release['release_release_date'])): ?>
	<li>
		Release date: <?php echo date('m/d/Y', strtotime($release['release_release_date'])); ?>
	</li>
					<?php endif; ?>
</ul>
					<?php if(!empty($release['release_store_description'])): ?>
<h3>Buy</h3>
					<?php echo $release['release_store_description']; ?>
					<?php endif; ?>
					<?php if(!empty($release['release_credits'])): ?>
<h3>Credits</h3>
					<?php echo $release['release_credits']; ?>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>
