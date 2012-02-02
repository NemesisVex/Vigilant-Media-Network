{if $release_list}

<form action="/index.php/musicwhore/discogs/albums/{$artist_id}/" method="post" id="filter_results">
<p>
Filter title: <input type="text" name="filter_title" value="{$filter_title}" id="title" size="50">
<input type="submit" value="Filter">
</p>
</form>

<div id="release_list">
<table class="Admin_Wide">
<tr>
	<th>TITLE</th>
	<th>OPTIONS</th>
</tr>
{foreach item=release from=$release_list}
<tr>
	<td valign="top">
<strong>{$release->title|escape}</strong><br>
<span class="smaller">
&#8212; {$release->format|escape}
&#8212; {$release->label|truncate:"50":"...":true|escape}
&#8212; RDF: <a href="http://www.discogs.com/release/{$release.id}?f=xml&amp;api_key={$api_key}">{$release.id}</a>
</span>
	</td>
	<td valign="top">
<a href="/index.php/musicwhore/discogs/album/{$release.id}/{$artist_id}/{$release->title|escape:"url"|escape:"url"}/">Link to an album</a><br>
<a href="/index.php/musicwhore/discogs/release/{$release.id}/{$artist_id}/{$release->title|escape:"url"|escape:"url"}/">Link to a release</a><br>
{*<a href="/index.php/musicwhore/musicbrainz/tracks/{$release.id}/{$artist_id}/">Import tracks</a>*}
	</td>
</tr>
{/foreach}
</table>
</div>

{literal}
<script type="text/javascript">

$(document).ready(function () {
	$('#title').autocomplete('/index.php/musicwhore/discogs/titles/' + {/literal}{$artist_id}{literal} + '/', {
		width: 260,
		selectFirst: false
	});
});
</script>
{/literal}


{else}
<p>Your search returned no results.</p>
{/if}

