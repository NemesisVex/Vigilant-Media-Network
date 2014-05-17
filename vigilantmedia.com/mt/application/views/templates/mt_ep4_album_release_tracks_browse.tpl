<h4 class="admin_head">Track information</h4>

{if $rsReleases}
<p>Choose a release to edit:</p>

<table class="Admin_Wide">
<tr>
	<th></th>
	<th>TITLE</th>
	<th>FORMAT</th>
	<th>RELEASE DATE</th>
</tr>
{foreach item=rsRelease from=$rsReleases}
<tr>
	<td valign="top" style="width: 75px;">
	[<a href="/index.php/ep4/tracks/check/{$rsRelease->release_id}/">Edit</a>]
	[<a href="/index.php/ep4/tracks/save/{$rsRelease->release_id}/">Save</a>]
	</td>
	<td valign="top">
	<strong>{$rsRelease->album_title}</strong><br>
	</td>
	<td valign="top">{$rsRelease->format_name}</td>
	<td valign="top">{$rsRelease->release_release_date|date_format:"%Y-%m-%d"}</td>
</tr>
{/foreach}
</table>

{else}
<p>No releases could be found. You must <a href="/index.php/ep4/album/browse/{$artist_id}">add an album</a> or <a href="/index.php/ep4/release/browse/{$artist_id}/">add a release</a> before you can add tracks.</p>
{/if}

