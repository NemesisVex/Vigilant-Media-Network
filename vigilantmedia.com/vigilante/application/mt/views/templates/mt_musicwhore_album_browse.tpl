<h4 class="admin_head">Album information</h4>

{if $rsAlbums}
<p>Choose an album to edit:</p>

<table class="Admin_Wide">
<tr>
	<th>ALBUM</th>
	<th>FORMAT</th>
	<th>LABEL</th>
	<th>RELEASE DATE</th>
</tr>
{foreach item=rsAlbum from=$rsAlbums}
{assign var=formatMask value=$rsAlbum->album_format_mask}
<tr>
	<td valign="top"><strong><a href="/index.php/musicwhore/album/{$function}/{$rsAlbum->album_id}/{$album_artist_id}/">{$rsAlbum->album_title}</a></strong>{if $rsAlbum->album_alt_title} <em>({$rsAlbum->album_alt_title})</em>{/if}</td>
	<td>{if $rsAlbum->album_format_mask}{$config.album_format_mask.$formatMask}{/if}</td>
	<td>{if $rsAlbum->album_label}{$rsAlbum->album_label}{/if}</td>
	<td>{if $rsAlbum->album_release_date}{$rsAlbum->album_release_date|date_format:"%Y-%m-%d"}{/if}</td>
</tr>
{/foreach}
</table>


{else}
<p>This artists has no albums. Perhaps you would like <a href="/index.php/musicwhore/album/add/{$album_artist_id}/">to add one</a>?</p>

{/if}
