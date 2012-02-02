<h4 class="admin_head">Audio administration</h4>

<table class="Admin_Wide">
<tr>
	<th></th>
	<th>TITLE</th>
	<th>FORMAT</th>
	<th>RELEASE DATE</th>
</tr>
{foreach item=rsAlbum from=$rsAlbums}
<tr>
	<td valign="top"><input type="radio" name="audio_release_id" value="{$rsAlbum->release_id}"{if $rsAlbum->release_id==$rsAudio->release_id} checked{/if} onclick="GetTracks({$rsAlbum->release_id}, 'RemapTrack');"></td>
	<td valign="top">{$rsAlbum->album_title}</td>
	<td valign="top">{$rsAlbum->format_name}</td>
	<td valign="top">{$rsAlbum->release_release_date|date_format:"%Y-%m-%d"}</td>
</tr>
{/foreach}
</table>
