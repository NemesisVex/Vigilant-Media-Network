<h4 class="admin_head">Track information</h4>

<form action="/index.php/ep4/tracks/update/{$track_release_id}/" method="post" name="ep4_tracks">

{if $track_release_id}<input type="hidden" name="track_release_id" value="{$track_release_id}">{/if}

{if $track_album_id}<input type="hidden" name="track_album_id" value="{$track_album_id}">{/if}

<p>You are currently editing track information for <strong><em>{$rsRelease->album_title}{if $rsAlbum->detail_alt_title} ({$rsAlbum->detail_alt_title}){/if}</em></strong>.</p>

<p>
Set all visibility: <a href="javascript:" id="set_visible_true">Show</a> | <a href="javascript:" id="set_visible_false">Hide</a><br>
Set all playable: <a href="javascript:" id="set_play_true">Yes</a> | <a href="javascript:" id="set_play_false">No</a><br>
Set all downloadble: <a href="javascript:" id="set_download_true">Yes</a> | <a href="javascript:" id="set_download_false">No</a><br>
</p>

<p>
<input type="submit" name="do" value="Update">
</p>

{foreach key=o item=rsTrack from=$rsTracks}
<table class="Admin">
<tr>
	<th>DISC #</th>
	<th>TRACK #</th>
	<th>SONG TITLE</th>
</tr>
<tr>
	<td><input type="text" name="track_in[{$o}][track_disc_num]" value="{if $rsTrack->track_disc_num}{$rsTrack->track_disc_num}{else}0{/if}" size="2"></td>
	<td><input type="text" name="track_in[{$o}][track_track_num]" value="{if $rsTrack->track_track_num}{$rsTrack->track_track_num}{elseif $rsTrack.new_track_setup}{$rsTrack.new_track_setup}{/if}" size="2"></td>
	<td>
<select name="track_in[{$o}][track_song_id]">
<option value=""> -TBD-
{foreach key=e item=rsSong from=$rsSongs}
<option value="{$rsSong->song_id}"{if $rsSong->song_id==$rsTrack->track_song_id} selected{/if}> {$rsSong->song_title|truncate:"50"}
{/foreach}
</select>
	</td>
</tr>
<tr>
	<td colspan="2"><strong>ISRC:</strong></td>
	<td colspan="3"><input type="text" name="track_in[{$o}][track_isrc_num]" value="{if $rsTrack->track_isrc_num}{$rsTrack->track_isrc_num}{/if}" size="25"></td>
</tr>
<tr>
	<td colspan="2"><strong>Visibility:</strong></td>
	<td colspan="3">
<input type="radio" class="track_is_visible" name="track_in[{$o}][track_is_visible]" value="1"{if $rsTrack->track_is_visible==true} checked{/if}>&nbsp;Show
<input type="radio" class="track_is_visible" name="track_in[{$o}][track_is_visible]" value="0"{if $rsTrack->track_is_visible==false} checked{/if}>&nbsp;Hide
	</td>
</tr>
<tr>
	<td colspan="2"><strong>Playback:</strong></td>
	<td colspan="3">
<input type="radio" class="track_audio_is_linked" name="track_in[{$o}][track_audio_is_linked]" value="1"{if $rsTrack->track_audio_is_linked==true} checked{/if}>&nbsp;Yes
<input type="radio" class="track_audio_is_linked" name="track_in[{$o}][track_audio_is_linked]" value="0"{if $rsTrack->track_audio_is_linked==false} checked{/if}>&nbsp;No<br>
	</td>
</tr>
<tr>
	<td colspan="2"><strong>Downloadable:</strong></td>
	<td colspan="3">
<input type="radio" class="track_audio_is_downloadable" name="track_in[{$o}][track_audio_is_downloadable]" value="1"{if $rsTrack->track_audio_is_downloadable==true} checked{/if}>&nbsp;Yes
<input type="radio" class="track_audio_is_downloadable" name="track_in[{$o}][track_audio_is_downloadable]" value="0"{if $rsTrack->track_audio_is_downloadable==false} checked{/if}>&nbsp;No
	</td>
</tr>
<tr>
	<td colspan="2"><strong>uPlaya score:</strong></td>
	<td colspan="3">
<input type="text" name="track_in[{$o}][track_uplaya_score]" value="{$rsTrack->track_uplaya_score}" size="5">
	</td>
</tr>
</table>

{if $rsTrack->track_id}<p><input type="checkbox" name="track_in[{$o}][delete]" value="1"><input type="hidden" name="track_in[{$o}][track_id]" value="{$rsTrack->track_id}"> Delete track</p>{else}<br>{/if}
{/foreach}

<p>
<input type="submit" name="do" value="Update">
</p>


{literal}
<script type="text/javascript">
function toggle_setting(input_setting, input_value)
{
	input_setting.each(function ()
	{
		if (this.value == input_value)
		{
			this.checked = true;
		}
	});
}

$(document).ready(function ()
{
	$('#set_visible_true').click(function () {toggle_setting($('input[class^=track_is_visible]'), true);});
	$('#set_visible_false').click(function () {toggle_setting($('input[class^=track_is_visible]'), false);});
	$('#set_download_true').click(function () {toggle_setting($('input[class^=track_audio_is_downloadable]'), true);});
	$('#set_download_false').click(function () {toggle_setting($('input[class^=track_audio_is_downloadable]'), false);});
	$('#set_play_true').click(function () {toggle_setting($('input[class^=track_audio_is_linked]'), true);});
	$('#set_play_false').click(function () {toggle_setting($('input[class^=track_audio_is_linked]'), false);});
});
</script>
{/literal}

</form>
