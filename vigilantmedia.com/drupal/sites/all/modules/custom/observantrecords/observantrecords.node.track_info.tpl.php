<?php if (count($tracks) > 0): ?>
<table class="track-table">
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
			<td>
				<?php if (!empty($track['audio_mp3_file_name'])): ?>
				<a href="/audio/<?php echo $track['audio_id']; ?>/" class="htrack" type="audio/mpeg" title="[<?php echo $track['song_title']; ?>]" ></a>
				<?php endif; ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php endif; ?>

