{if $release_list}
{assign var=track_list value="track-list"}
<table class="Admin_Wide">
<tr>
	<th>TITLE</th>
	<th>OPTIONS</th>
</tr>
{foreach item=release from=$release_list}
<tr>
	<td valign="top">
<strong>{$release->title}</strong><br>
<span class="smaller">&#8212; GID: <a href="http://musicbrainz.org/ws/1/release-group/{$release.id}?type=xml&amp;inc=artist+releases">{$release.id}</a></span>
	</td>
	<td valign="top">
<a href="/index.php/musicwhore/musicbrainz/album/{$artist_id}/{$release.id}/">Link to an album</a><br>
<a href="/index.php/musicwhore/musicbrainz/releases/{$artist_id}/{$release.id}/">Browse releases</a><br>
	</td>
</tr>
{/foreach}
</table>

{else}
<p>Your search returned no results.</p>
{/if}

