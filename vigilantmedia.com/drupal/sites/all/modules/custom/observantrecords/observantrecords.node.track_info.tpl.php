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
		<?php foreach ($tracks as $track): ?>
		<tr>
			<td><?php echo $track['track_track_num'] ?></td>
			<td>
				<?php if ((boolean) $track['track_is_visible'] === true && !empty($track['track_alias'])): ?>
				<a href="/track/<?php echo $track['track_alias']; ?>/"><?php echo $track['song_title']; ?></a>
				<?php else: ?>
				<?php echo $track['song_title']; ?>
				<?php endif; ?>
			</td>
			<td>
				<?php if ((boolean) $track['track_audio_is_linked'] === true && !empty($track['audio_mp3_file_name'])): ?>
				<a href="/audio/<?php echo $track['audio_id']; ?>/" class="htrack" type="audio/mpeg" title="<?php echo $track['song_title']; ?>" ></a>
				<?php endif; ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php endif; ?>

