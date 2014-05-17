<h4 class="admin_head">Release information</h4>

{if $rsReleases}
<p>Choose a release to update{if $album_title} with Amazon information for <strong><em>{$album_title}</em></strong>{/if}:</p>

<table class="Admin_Wide">
<tr>
	<th>ALBUM</th>
	<th>FORMAT</th>
	<th>CATALOG NO.</th>
	<th>RELEASE DATE</th>
	<th>COUNTRY</th>
</tr>
{foreach item=rsRelease from=$rsReleases}
<tr>
	<td valign="top">
	<strong><a href="/index.php/musicwhore/release/edit/{$rsRelease->release_id}/{$album_artist_id}/{$asin}/">{$rsRelease->album_title}</a></strong> {if $rsRelease->release_alt_title}<em>({$rsRelease->release_alt_title})</em>{/if}<br>
	</td>
	<td valign="top">{if $rsRelease->format_name}{$rsRelease->format_name}{/if}</td>
	<td valign="top">{if $rsRelease->release_catalog_num}{$rsRelease->release_catalog_num}{/if}</td>
	<td valign="top">{if $rsRelease->release_release_date}{$rsRelease->release_release_date|date_format:"%Y-%m-%d"}{/if}</td>
	<td valign="top">{if $rsRelease->release_country_name}{$rsRelease->release_country_name}{/if}</td>
</tr>
{/foreach}
</table>
{else}
<p>This artists has no release. You cannot add releases without <a href="/index.php/musicwhore/album/add/{$album_artist_id}/">adding albums</a>.</p>

{/if}
