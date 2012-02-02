<h4 class="admin_head">Discogs information</h4>

{if $rsDiscogs}
<p>The following releases are linked to Musicbrainz.</p>

<table class="Admin_Wide">
<tr>
	<th>OPTIONS</th>
	<th>TITLE</th>
	<th>CATALOG NO.</th>
	<th>ALBUM RELEASE</th>
	<th>RELEASE DATE</th>
</tr>
{foreach item=rsDiscog from=$rsDiscogs}
<tr>
	<td>
[<a href="/index.php/musicwhore/discogs/remove/{$rsDiscog->discogs_id}/">Delete</a>]
[<a href="/index.php/musicwhore/discogs/edit/{$rsDiscog->discogs_id}/">Edit</a>]
	</td>
	<td>{$rsDiscog->album_title}{if $rsDiscog->release_alt_title} <em>({$rsDiscog->release_alt_title})</em>{/if}</td>
	<td>{$rsDiscog->release_catalog_num}</td>
	<td>{$rsDiscog->album_release_date|date_format:"%Y-%m-%d"}</td>
	<td>{$rsDiscog->release_release_date|date_format:"%Y-%m-%d"}</td>
</tr>
{/foreach}
</table>
{else}
<p>This artist does not have any Musicbrainz associations. Please <a href="/index.php/musicwhore/musicbrainz/albums/185/">add some</a>.</p>
{/if}