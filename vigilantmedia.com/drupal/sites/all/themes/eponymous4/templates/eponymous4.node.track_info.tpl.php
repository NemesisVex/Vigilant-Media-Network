<?php if (count($tracks) > 0): ?>
<table class="track-table">
	<thead>
		<tr>
			<th class="track-column">Track</th>
			<th>Title</th>
			<th class="play-column">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($tracks as $track): ?>
		<tr>
			<td class="track-column"><?php echo $track['track_track_num'] ?></td>
			<td>
				<?php if ((boolean) $track['track_is_visible'] === true && !empty($track['track_alias'])): ?>
				<a href="/music/track/<?php echo $track['track_alias']; ?>/"><?php echo $track['song_title']; ?></a>
				<?php else: ?>
				<?php echo $track['song_title']; ?>
				<?php endif; ?>
			</td>
			<td class="play-column">
				<?php if ((boolean) $track['track_audio_is_linked'] === true && !empty($track['audio'])): ?>
				<audio id="track-<?php echo $track['track_recording_id']; ?>" preload="none">
				<?php foreach ($track['audio'] as $audio):
				?>
					<source src="/audio/<?php echo $audio['audio_id']; ?>/" type="<?php echo $audio['audio_file_type'];?>" />
				<?php
				endforeach;
				?>
				</audio>
				<a href="#" id="button-<?php echo $track['track_recording_id']; ?>" class="play-button"><img src="<?php echo eponymous4_get_vigilante_uri(); ?>/images/icons/speaker-grey.gif" alt="[Play]" title="[Play]" /></a>
				<?php endif; ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<p>
	<audio controls id="page-playback"></audio>
</p>

<script type="text/javascript">
	(function ($) {
		$('.play-button').click(function () {
			var page_playback = document.getElementById('page-playback');
			page_playback.pause();
			$(page_playback).find('source').remove();
			
			var recording_id = String(this.id).split('-')[1];
			$('#track-' + recording_id).children('source').each(function () {
				var source = $(this).clone();
				if (page_playback.canPlayType($(this).attr('type')) != '') {
					source.appendTo(page_playback);
					return false;
				}
			});
			
			if ($(page_playback).children('source').length < 1) {
				alert('A file supported by this browser is not yet available to play.');
				return false;
			}
			
			page_playback.play();
			return false;
		});
	})(jQuery);
</script>
<?php endif; ?>

