<h2>Introduction</h2>

<p>In the early '90s, my parents bought me a Kawai K4 synthesizer and a Kawai Q-80 sequencer as a high school graduation gift. From 1991 through 1998, I recorded a number of songs on that workstation. In 1998, it was stolen in a burglary, and thanks to renter's insurance, I replaced it with my current <a href="/index.php/studio/">studio setup</a>.</p>

<p>Only one cassette tape of those recordings, which I titled <em>a loss for words</em>, survived the burglary, and in the late '90s, I attempted to transfer that cassette to digital. The sound quality really sucked. In 2009, I replaced a missing power adapter for an old Tascam 424 Portastudio and gave transfering those recordings another shot. I like the results far better, and I even went so far to give them some light mastering.</p>

<p>I've since re-recorded most of the tracks on that cassette, and I present them here as a way to compare and contrast my very first draft with the current demos.</p>

<p>I'm actually surprised many of these tracks remain faithful to their originals.</p>

<h3>Listen</h3>

{if $rsTracks}
<table>
	<tr>
		<th>Song</th>
		<th>Demo</th>
		<th>Release</th>
	</tr>
{foreach item=rsTrack from=$rsTracks}
{if $rsTrack.release_file}
	<tr>
		<td>{$rsTrack.song_title}</td>
		<td>
			<div id="demo_{$rsTrack.song_id}"></div>
			<script type="text/javascript">
			$(document).ready(function () {ldelim}
			var demo_file = build_audio_url('{$rsTrack.demo_file}', 'vocals');
			jq_load_file($('#demo_{$rsTrack.song_id}'), demo_file, '{$rsTrack.song_title}', 'Greg Bueno');
			{rdelim});
			</script>
		</td>
		<td>
			<div id="release_{$rsTrack.song_id}"></div>
			<script type="text/javascript">
			$(document).ready(function () {ldelim}
			var release_file = build_audio_url('{$rsTrack.release_file}', 'vocals');
			jq_load_file($('#release_{$rsTrack.song_id}'), release_file, '{$rsTrack.song_title}', 'Eponymous 4');
			{rdelim});
			</script>
		</td>
	</tr>
{/if}
{/foreach}
</table>



{/if}
