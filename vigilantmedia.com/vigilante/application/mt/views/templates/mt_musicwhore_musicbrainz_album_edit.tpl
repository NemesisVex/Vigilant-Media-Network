<h4 class="admin_head">Release information</h4>

{if $release_group}
<p>Musicbrainz provides the following information about this release.</p>

{assign var=release_list value='release-list'}
{assign var=track_list value='track-list'}
<table class="Admin_Wide">
<tr>
	<th>ALBUM</th>
	<th>NO. TRACKS</th>
</tr>
{foreach item=release from=$release_group->$release_list->release}
<tr>
	<td><strong>{$release->title}</strong></td>
	<td>{$release->$track_list.offset+1}</td>
</tr>
{/foreach}
</table>
{/if}

{if $rsMusicBrainz}
<p><strong><a href="{$request_uri|escape}">{$release_group->title}</a></strong> is already associated with the following releases:</p>

<table class="Admin_Wide">
<tr>
	<th></th>
	<th>ALBUM</th>
	<th>FORMAT</th>
	<th>CATALOG NO.</th>
	<th>RELEASE DATE</th>
	<th>COUNTRY</th>
</tr>
{foreach item=rsMusicBrainz from=$rsMusicBrainz}
<tr>
	<td valign="top">
[<a href="/index.php/musicwhore/musicbrainz/remove/{$rsMusicBrainz->mb_id}/">Delete</a>]
[<a href="/index.php/musicwhore/musicbrainz/edit/{$rsMusicBrainz->mb_id}/">Edit</a>]
	</td>
	<td valign="top">
	<strong><a href="/index.php/musicwhore/release/edit/{$rsMusicBrainz->release_id}/{$album_artist_id}/">{$rsMusicBrainz->album_title}</a></strong> {if $rsMusicBrainz->release_alt_title}<em>({$rsMusicBrainz->release_alt_title})</em>{/if}<br>
	</td>
	<td valign="top">{if $rsMusicBrainz->format_name}{$rsMusicBrainz->format_name}{/if}</td>
	<td valign="top">{if $rsMusicBrainz->release_catalog_num}{$rsMusicBrainz->release_catalog_num}{/if}</td>
	<td valign="top">{if $rsMusicBrainz->release_release_date}{$rsMusicBrainz->release_release_date|date_format:"%Y-%m-%d"}{/if}</td>
	<td valign="top">{if $rsMusicBrainz->release_country_name}{$rsMusicBrainz->release_country_name}{/if}</td>
</tr>
{/foreach}
</table>

{else}

{if $rsAlbums}
<form action="/index.php/musicwhore/musicbrainz/map/0/{$album_artist_id}/" method="post" name="release">

<p>Choose a release to associate with the Musicbrainz entry for <strong><a href="{$request_uri}">{$release_group->title}</a></strong>:</p>

<input type="hidden" name="mb_group_mb_gid" value="{$mb_group_mb_gid}">

<table class="Admin_Wide">
<tr>
	<th></th>
	<th>ALBUM</th>
	<th>RELEASE DATE</th>
</tr>
{foreach item=rsAlbum from=$rsAlbums}
<tr>
	<td valign="top"><input type="radio" name="mb_album_id" value="{$rsAlbum->album_id}"{if $rsMusicbrainz->mb_album_id==$rsAlbum->album_id} checked{/if}></td>
	<td valign="top">
	<strong><a href="/index.php/musicwhore/album/edit/{$rsAlbum->album_id}/{$album_artist_id}/">{$rsAlbum->album_title}</a></strong><br>
	</td>
	<td valign="top">{if $rsAlbum->album_release_date}{$rsAlbum->album_release_date|date_format:"%Y-%m-%d"}{/if}</td>
</tr>
{/foreach}
</table>

<p>
<input type="submit" value="Update">
</p>

</form>

{else}
<p>This artists has no release. You cannot add releases without <a href="/index.php/musicwhore/album/add/{$album_artist_id}/">adding albums</a>.</p>

{/if}
{/if}


