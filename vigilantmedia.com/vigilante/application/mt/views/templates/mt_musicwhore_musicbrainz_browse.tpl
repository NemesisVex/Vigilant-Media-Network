<h4 class="admin_head">Musicbrainz information</h4>

{if $rsMusicBrainz}
<p>The following releases are linked to Musicbrainz.</p>

<table class="Admin_Wide">
<tr>
	<th>OPTIONS</th>
	<th>TITLE</th>
	<th>CATALOG NO.</th>
	<th>ALBUM RELEASE</th>
	<th>RELEASE DATE</th>
</tr>
{foreach item=rsBrainz from=$rsMusicBrainz}
<tr>
	<td>
[<a href="/index.php/musicwhore/musicbrainz/remove/{$rsBrainz->mb_id}/">Delete</a>]
[<a href="/index.php/musicwhore/musicbrainz/edit/{$rsBrainz->mb_id}/">Edit</a>]
	</td>
	<td>{$rsBrainz->album_title}{if $rsBrainz->release_alt_title} <em>({$rsBrainz->release_alt_title})</em>{/if}</td>
	<td>{$rsBrainz->release_catalog_num}</td>
	<td>{$rsBrainz->album_release_date|date_format:"%Y-%m-%d"}</td>
	<td>{$rsBrainz->release_release_date|date_format:"%Y-%m-%d"}</td>
</tr>
{/foreach}
</table>
{else}
<p>This artist does not have any Musicbrainz associations. Please <a href="/index.php/musicwhore/musicbrainz/albums/185/">add some</a>.</p>
{/if}