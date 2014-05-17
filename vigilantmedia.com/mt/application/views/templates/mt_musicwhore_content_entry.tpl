<h4 class="admin_head">Content administration</h4>

{if $rsMaps}
<p>This entry is mapped to the following artists, releases and tracks:</p>

<table class="Admin">
<tr>
	<th>ARTIST</th>
	<th>RELEASE</th>
	<th>FORMAT</th>
	<th>TRACK</th>
	<th>OPTIONS</th>
</tr>
{foreach item=rsMap from=$rsMaps}
<tr>
	<td>{format_artist_name_object obj=$rsMap}</td>
	<td>{if $rsMap->album_title}<em>{$rsMap->album_title}</em>{else}N/A{/if}</td>
	<td>{if $rsMap->format_name}{$rsMap->format_name}{else}N/A{/if}</td>
	<td>{if $rsMap->song_title}{$rsMap->song_title}{else}N/A{/if}</td>
	<td>
[<a href="/index.php/musicwhore/content/edit/{$rsMap->content_id}/{$artist_id}/">Edit</a>]
[<a href="/index.php/musicwhore/content/unmap/{$rsMap->content_id}/{$artist_id}/">Delete</a>]
	</td>
</tr>
{/foreach}
</table>

{else}
<p>No maps are available.</p>
{/if}

{if $artist_id}
<form action="/index.php/musicwhore/content/{if $content_id}update/{$content_id}{else}create/{$entry_id}{/if}/{$artist_id}/" method="post" name="ep4_tracks">

{if $content_id}<input type="hidden" name="content_entry_id" value="{$entry_id}">{/if}

<p>Do you want to map the entry <strong>&quot;{$rsEntry->entry_title}&quot;</strong> to the artist <strong>{format_artist_name_object obj=$rsArtist}</strong>?</p>

<p>
<input type="submit" value="Update">
</p>

</form>

<p><a href="/index.php/musicwhore/content/releases/{$entry_id}/{$artist_id}/">Create a map to a release or track</a>.</p>
{else}
<p>Choose an artist with which to associate the entry <strong>{$rsEntry->entry_title}</strong>.</p>

<div class="scroll-box">
<ul>
{foreach item=rsArtist from=$rsArtists}
<li> <a href="/index.php/musicwhore/content/entry/{$entry_id}/{$rsArtist->artist_id}/">{format_artist_name_object obj=$rsArtist}</a>{if $rsArtist->artist_asian_name_utf8} ({$rsArtist->artist_asian_name_utf8}){/if}</li>
{/foreach}
</ul>
</div>


{/if}