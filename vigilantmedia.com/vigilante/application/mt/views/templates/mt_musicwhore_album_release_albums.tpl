<h4 class="admin_head">Album information</h4>

{if $rsAlbums}
<p>Choose an album to create a release{if $asin} with Amazon information for <strong><em>{$album_title}</em></strong>{/if}:</p>

<table class="Admin_Wide">
<tr>
	<th>ALBUM</th>
	<th>RELEASE DATE</th>
</tr>
{foreach item=rsAlbum from=$rsAlbums}
<tr>
	<td valign="top">
	<strong><a href="/index.php/musicwhore/release/add/{$album_artist_id}/{$rsAlbum->album_id}/{if $asin}{$asin}/{/if}">{$rsAlbum->album_title}</a></strong> {if $rsAlbum->release_alt_title}<em>({$rsAlbum->release_alt_title})</em>{/if}<br>
	</td>
	<td valign="top">{if $rsAlbum->album_release_date}{$rsAlbum->album_release_date|date_format:"%Y-%m-%d"}{/if}</td>
</tr>
{/foreach}
</table>
{else}
<p>This artists has no albums. You must first <a href="/index.php/musicwhore/album/add/{$album_artist_id}/">add an album</a>.</p>

{/if}
