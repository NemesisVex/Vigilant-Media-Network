<?php if (count($tracks) > 0): ?>
<table>
	<thead>
		<tr>
			<th>Track</th>
			<th>Title</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($tracks[0] as $track): ?>
		<tr>
			<td><?php echo $track['track_track_num'] ?></td>
			<td><?php echo $track['song_title'] ?></td>
			<td>&nbsp;</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php endif; ?>
