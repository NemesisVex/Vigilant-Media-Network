<h4 class="admin_head">Album information</h4>

{if $release_info}
<p>Discogs.com provides the following information about this release.</p>

<table class="Admin_Wide">
<tr>
	<th>ALBUM</th>
	<th>FORMAT</th>
	<th>LABEL.</th>
	<th>CATALOG NO.</th>
	<th>RELEASE DATE</th>
	<th>COUNTRY</th>
</tr>
<tr>
	<td><strong>{$release_info->title}</strong></td>
	<td>{$release_info->formats->format.name} {$release_info->formats->format->descriptions->description[0]}</td>
	<td>{$release_info->labels->label.name}</td>
	<td>{$release_info->labels->label.catno}</td>
	<td>{$release_info->released}</td>
	<td>{$release_info->country}</td>
</tr>
</table>
{/if}

{if $rsDiscogs}
<p><strong><a href="http://www.discogs.com/release/{$discogs_discog_id}?f=xml&amp;api_key={$api_key}">{$release_info->title}</a></strong> is already associated with the following release:</p>

<table class="Admin_Wide">
<tr>
	<th></th>
	<th>ALBUM</th>
	<th>RELEASE DATE</th>
</tr>
{foreach item=rsDiscog from=$rsDiscogs}
<tr>
	<td valign="top">
[<a href="/index.php/musicwhore/discogs/remove/{$rsDiscog->discogs_id}/">Delete</a>]
[<a href="/index.php/musicwhore/discogs/edit/{$rsDiscogs->discogs_id}/">Edit</a>]
	</td>
	<td valign="top">
	<strong><a href="/index.php/musicwhore/album/edit/{$rsDiscog->album_id}/{$album_artist_id}/">{$rsDiscog->album_title}</a></strong><br>
	</td>
	<td valign="top">{if $rsDiscog->album_release_date}{$rsDiscog->album_release_date|date_format:"%Y-%m-%d"}{/if}</td>
</tr>
{/foreach}
</table>

{/if}


{if $rsAlbums}
<form action="/index.php/musicwhore/discogs/map/{$discogs_discog_id}/{$album_artist_id}/" method="post" name="release">

<p>Choose a release to associate with the Discogs entry for <strong><a href="http://www.discogs.com/release/{$discogs_discog_id}?f=xml&amp;api_key={$api_key}">{$release_info->title}</a></strong>:</p>

<input type="hidden" name="function" value="create">

<div class="scroll-box">
<table class="Admin_Wide">
<tr>
	<th></th>
	<th>ALBUM</th>
	<th>RELEASE DATE</th>
</tr>
{foreach item=rsAlbum from=$rsAlbums}
<tr>
	<td valign="top"><input type="radio" name="discogs_album_id" value="{$rsAlbum->album_id}"{if $rsDiscogs->discogs_album_id==$rsAlbum->album_id} checked{/if}></td>
	<td valign="top">
	<strong><a href="/index.php/musicwhore/album/edit/{$rsAlbum->album_id}/{$album_artist_id}/">{$rsAlbum->album_title}</a></strong> {if $rsAlbum->release_alt_title}<em>({$rsAlbum->release_alt_title})</em>{/if}<br>
	</td>
	<td valign="top">{if $rsAlbum->album_release_date}{$rsAlbum->album_release_date|date_format:"%Y-%m-%d"}{/if}</td>
</tr>
{/foreach}
</table>
</div>

<p>
<input type="submit" value="Update">
</p>

</form>

{else}
<p>This artists has no release. You cannot add releases without <a href="/index.php/musicwhore/album/add/{$album_artist_id}/">adding albums</a>.</p>

{/if}


