<h2>Introduction</h2>

<p>In the early '90s, my parents bought me a Kawai K4 synthesizer and a Kawai Q-80 sequencer as a high school graduation gift. From 1991 through 1998, I recorded a number of songs on that workstation. In 1998, it was stolen in a burglary, and thanks to renter's insurance, I replaced it with my current studio setup.</p>

<p>Only one cassette tape of those recordings, which I titled <em>a loss for words</em>, survived the burglary, and in the late '90s, I attempted to transfer that cassette to digital. The sound quality really sucked. In 2009, I replaced a missing power adapter for an old Tascam 424 Portastudio and gave transfering those recordings another shot. I like the results far better, and I even went so far to master them.</p>

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
{if $rsTrack.release_audio_id}
	<tr>
		<td>{$rsTrack.song_title}</td>
		<td><a href="http://eponymous4.com/index.php/music/play/{$rsTrack.demo_audio_id}/audio/" type="audio/mpeg" title="{$rsTrack.song_title} (Demo)" class="htrack"></a></td>
		<td><a href="http://eponymous4.com/index.php/music/play/{$rsTrack.release_audio_id}/audio/" type="audio/mpeg" title="{$rsTrack.song_title} (Release)" class="htrack"></a></td>
	</tr>
{/if}
{/foreach}
</table>

<script type="text/javascript" src="http://webplayer.yahooapis.com/player-beta.js"></script>

{/if}
