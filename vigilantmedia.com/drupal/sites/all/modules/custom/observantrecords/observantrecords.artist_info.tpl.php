<?php if (count($artists) > 0): ?>
<ul>
	<?php foreach ($artists as $artist): ?>
		<?php foreach ($artist as $field => $value): ?>
	<li><?php echo $field;?>: <?php echo $value; ?></li>
		<?php endforeach; ?>
	<?php endforeach; ?>
</ul>
<?php endif; ?>
