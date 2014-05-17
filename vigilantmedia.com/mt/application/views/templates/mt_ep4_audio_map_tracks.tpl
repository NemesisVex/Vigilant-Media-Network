<h4 class="admin_head">Audio administration</h4>

{if $rsTracks}
<form action="/index.php/ep4/audio/map/{$release_id}/" method="post">
<table class="Admin">
<tr>
	<th>TRACK #</th>
	<th>SONG TITLE</th>
	<th>FILE NAME</th>
	<th>DELETE</th>
</tr>
{foreach key=o item=rsTrack from=$rsTracks}
<tr>
	<td>{$rsTrack->track_track_num}</td>
	<td>{$rsTrack->song_title}<input type="hidden" name="map_in[{$o}][map_track_id]" value="{$rsTrack->track_id}"></td>
	<td>
<select name="map_in[{$o}][map_audio_id]">
<option value="0">&nbsp;
{foreach key=s item=rsFile from=$rsFiles}
<option value="{$rsFile->audio_id}"{if $rsTrack->map_audio_id==$rsFile->audio_id} selected{/if} title="{$rsFile->audio_mp3_file_path}/{$rsFile->audio_mp3_file_name}"> {$rsFile->audio_mp3_file_name|truncate:40}
{/foreach}
</select>	
	</td>
	<td>
{if $rsTrack->map_id}<input type="checkbox" name="map_in[{$o}][delete]" value="1"><input type="hidden" name="map_in[{$o}][map_id]" value="{$rsTrack->map_id}">{/if}
	</td>
</tr>
{/foreach}
</table>

<p>
<input type="submit" value="Update">
</p>

</form>

{else}
<p>You must <a href="/index.php/ep4/tracks/check/{$release_id}/">add tracks</a> to this album before you can map files to them.</p>
{/if}