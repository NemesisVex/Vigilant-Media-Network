<h4 class="admin_head">Track information</h4>

<form action="/index.php/musicwhore/tracks/update/{$track_release_id}/" method="post" name="ep4_tracks">

{if $track_release_id}<input type="hidden" name="track_release_id" value="{$track_release_id}">{/if}

{if $track_album_id}<input type="hidden" name="track_album_id" value="{$track_album_id}">{/if}

<p>You are currently editing track information for <strong><em>{$rsRelease->album_title}{if $rsAlbum->detail_alt_title} ({$rsAlbum->detail_alt_title}){/if}</em></strong>.</p>


<table class="Admin">
<tr>
	<th>DISC #</th>
	<th>TRACK #</th>
	<th>SONG TITLE</th>
	<th>ALTERNATE TITLE</th>
	<th>DELETE TRACK</th>
</tr>
{foreach key=t item=rsTrack from=$rsTracks}
<tr>
	<td><input type="text" name="track_in[{$t}][track_disc_num]" value="{if $rsTrack->track_disc_num}{$rsTrack->track_disc_num}{else}1{/if}" size="2"></td>
	<td><input type="text" name="track_in[{$t}][track_track_num]" value="{if $rsTrack->track_track_num}{$rsTrack->track_track_num}{elseif $rsTrack.new_track_setup}{$rsTrack.new_track_setup}{/if}" size="2"></td>
	<td><input type="text" name="track_in[{$t}][track_song_title]" value="{$rsTrack->track_song_title}" size="30"></td>
	<td><input type="text" name="track_in[{$t}][track_alt_title]" value="{$rsTrack->track_alt_title}" size="30"></td>
	<td>{if $rsTrack->track_id}<input type="checkbox" name="track_in[{$t}][delete]" value="1"><input type="hidden" name="track_in[{$t}][track_id]" value="{$rsTrack->track_id}">{/if}</td>
</tr>
{/foreach}
</table>

<p>
<input type="submit" name="do" value="Update">
</p>

</form>