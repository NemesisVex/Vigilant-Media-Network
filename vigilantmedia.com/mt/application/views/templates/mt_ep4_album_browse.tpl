<h4 class="admin_head">Album information</h4>

{if $rsAlbums}
<p>Choose an album to edit:</p>

<table class="Admin_Wide">
<tr>
	<th>ALBUM</th>
	<th>FORMAT</th>
	<th>VISIBILITY</th>
</tr>
{foreach item=rsAlbum from=$rsAlbums}
{assign var=formatMask value=$rsAlbum->album_format_mask}
<tr>
	<td valign="top"><strong><a href="/index.php/ep4/album/{$function}/{$rsAlbum->album_id}/{$album_artist_id}/">{$rsAlbum->album_title}</a></strong></td>
	<td>{if $rsAlbum->album_format_mask}{$config.album_format_mask.$formatMask}{/if}</td>
	<td>{if $rsAlbum->album_is_visible==1}Yes{else}No{/if}</td>
</tr>
{/foreach}
</table>


{else}
<p>This artists has no albums. Perhaps you would like <a href="/index.php/ep4/album/add/{$album_artist_id}/">to add one</a>?</p>

{/if}
