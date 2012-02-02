<h4 class="admin_head">Content administration</h4>

{if $rsReleases}
<p>Choose a{if $rsMaps}nother{/if} release to map:</p>

<table class="Admin_Wide">
<tr>
	<th>TITLE</th>
	<th>FORMAT</th>
	<th>RELEASE DATE</th>
</tr>
{foreach item=rsRelease from=$rsReleases}
<tr>
	<td valign="top">
	<strong><a href="/index.php/ep4/content/{if $edit==true}remap/{$content_id}{else}map/{$entry_id}{/if}/{$rsRelease->release_id}/{$artist_id}/">{$rsRelease->album_title}</a></strong><br>
	</td>
	<td valign="top">{$rsRelease->format_name}</td>
	<td valign="top">{$rsRelease->release_release_date|date_format:"%Y-%m-%d"}</td>
</tr>
{/foreach}
</table>

{else}
<p>No releases could be found.</p>
{/if}
