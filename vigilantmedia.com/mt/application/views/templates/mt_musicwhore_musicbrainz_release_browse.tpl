{if $release_list}
{assign var=track_list value="track-list"}
<table class="Admin_Wide">
<tr>
	<th>TITLE</th>
	<th>NO. OF TRACKS</th>
	<th>OPTIONS</th>
</tr>
{foreach item=release from=$release_list}
<tr>
	<td valign="top">
<strong>{$release->title}</strong><br>
<span class="smaller">&#8212; GID: <a href="http://musicbrainz.org/ws/1/release/{$release.id}?type=xml&amp;inc=artist+release-events+tracks+release-groups+artist-rels+label-rels+release-rels+track-rels+url-rels+track-level-rels+labels">{$release.id}</a></span>
	</td>
	<td valign="top">{$release->$track_list.offset+1}</td>
	<td valign="top">
<a href="/index.php/musicwhore/musicbrainz/release/{$artist_id}/{$release.id}/{if $mb_group_mb_gid}{$mb_group_mb_gid}{else}_{/if}/">Link to a release</a><br>
	</td>
</tr>
{/foreach}
</table>

{else}
<p>Your search returned no results.</p>
{/if}

