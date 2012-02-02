<h4 class="admin_head">Release information</h4>

{if $rsReleases}
<p>Choose a release to edit:</p>

<table class="Admin_Wide">
<tr>
	<th>ALBUM</th>
	<th>FORMAT</th>
	<th>CATALOG NO.</th>
	<th>RELEASE DATE</th>
	<th>VISIBLE</th>
</tr>
{foreach item=rsRelease from=$rsReleases}
<tr>
	<td valign="top">
	<strong><a href="/index.php/ep4/release/{$function}/{$rsRelease->release_id}/{$album_artist_id}/">{$rsRelease->album_title}</a></strong><br>
	</td>
	<td valign="top">{if $rsRelease->format_name}{$rsRelease->format_name}{/if}</td>
	<td valign="top">{if $rsRelease->release_catalog_num}{$rsRelease->release_catalog_num}{/if}</td>
	<td valign="top">{if $rsRelease->release_release_date}{$rsRelease->release_release_date|date_format:"%Y-%m-%d"}{/if}</td>
	<td valign="top">{if $rsRelease->release_is_visible==true}Yes{else}No{/if}</td>
</tr>
{/foreach}
</table>
{else}
<p>This artists has no release. You cannot add releases without <a href="/index.php/ep4/album/add/{$album_artist_id}/">adding albums</a>.</p>

{/if}
