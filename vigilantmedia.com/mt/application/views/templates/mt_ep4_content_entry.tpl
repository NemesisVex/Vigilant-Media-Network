<h4 class="admin_head">Content administration</h4>

{if $rsMaps}
<p>This entry is mapped to the following releases and tracks:</p>

<table class="Admin">
<tr>
	<th>RELEASE</th>
	<th>FORMAT</th>
	<th>TRACK</th>
	<th>OPTIONS</th>
</tr>
{foreach item=rsMap from=$rsMaps}
<tr>
	<td><em>{$rsMap->album_title}</em></td>
	<td>{$rsMap->format_name}</td>
	<td>{if $rsMap->song_title}{$rsMap->song_title}{else}N/A{/if}</td>
	<td>
[<a href="/index.php/ep4/content/edit/{$rsMap->content_id}/{$artist_id}/">Edit</a>]
[<a href="/index.php/ep4/content/unmap/{$rsMap->content_id}/{$artist_id}/">Delete</a>]
	</td>
</tr>
{/foreach}
</table>

{else}
<p>No maps are available.</p>
{/if}

<p><a href="/index.php/ep4/content/releases/{$entry_id}/{$artist_id}/">Create a map to a release or track</a>.</p>
