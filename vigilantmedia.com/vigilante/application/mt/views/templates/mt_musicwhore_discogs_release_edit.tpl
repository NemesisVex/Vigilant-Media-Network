<h4 class="admin_head">Release information</h4>

{if $release_info}
<p>Discogs.com provides the following information about this release.</p>

<table class="Admin_Wide">
<tr>
	<th>ALBUM</th>
	<th>FORMAT</th>
	<th>LABEL.</th>
	<th>CATALOG NO.</th>
	<th>RELEASE DATE</th>
	<th>COUNTRY</th>
</tr>
<tr>
	<td><strong>{$release_info->title}</strong></td>
	<td>{$release_info->formats->format.name} {$release_info->formats->format->descriptions->description}</td>
	<td>{$release_info->labels->label.name}</td>
	<td>{$release_info->labels->label.catno}</td>
	<td>{$release_info->released}</td>
	<td>{$release_info->country}</td>
</tr>
</table>
{/if}

{if $rsDiscogs}

{if $rsDiscogs->discogs_release_id==0}
<p><strong><a href="http://www.discogs.com/release/{$discogs_discog_id}?f=xml&amp;api_key={$api_key}">{$release_info->title}</a></strong> is associated with the following album but is not tied to a specific release:</p>
{else}
<p><strong><a href="http://www.discogs.com/release/{$discogs_discog_id}?f=xml&amp;api_key={$api_key}">{$release_info->title}</a></strong> is already associated with the following release:</p>
{/if}

<table class="Admin_Wide">
<tr>
	<th></th>
	<th>ALBUM</th>
	<th>FORMAT</th>
	<th>CATALOG NO.</th>
	<th>RELEASE DATE</th>
	<th>COUNTRY</th>
</tr>
<tr>
	<td valign="top">
[<a href="/index.php/musicwhore/discogs/remove/{$rsDiscogs->discogs_id}/">Delete</a>]
[<a href="/index.php/musicwhore/discogs/edit/{$rsDiscogs->discogs_id}/">Edit</a>]
	</td>
	<td valign="top">
	<strong><a href="/index.php/musicwhore/release/edit/{$rsDiscogs->discogs_discog_id}/{$album_artist_id}/">{$rsDiscogs->album_title}</a></strong> {if $rsDiscogs->release_alt_title}<em>({$rsDiscogs->release_alt_title})</em>{/if}<br>
	</td>
	<td valign="top">{if $rsDiscogs->format_name}{$rsDiscogs->format_name}{/if}</td>
	<td valign="top">{if $rsDiscogs->release_catalog_num}{$rsDiscogs->release_catalog_num}{/if}</td>
	<td valign="top">{if $rsDiscogs->release_release_date}{$rsDiscogs->release_release_date|date_format:"%Y-%m-%d"}{/if}</td>
	<td valign="top">{if $rsDiscogs->release_country_name}{$rsDiscogs->release_country_name}{/if}</td>
</tr>
</table>

{/if}


{if $rsReleases}
<form action="/index.php/musicwhore/discogs/map/{$discogs_discog_id}/{$album_artist_id}/" method="post" name="release">

<p>Choose a release to associate with the Discogs entry for <strong><a href="http://www.discogs.com/release/{$discogs_discog_id}?f=xml&amp;api_key={$api_key}">{$release_info->title}</a></strong>:</p>

<input type="hidden" name="function" value="create">

<div class="scroll-box">
<table class="Admin_Wide">
<tr>
	<th></th>
	<th>ALBUM</th>
	<th>FORMAT</th>
	<th>CATALOG NO.</th>
	<th>RELEASE DATE</th>
	<th>COUNTRY</th>
</tr>
{foreach item=rsRelease from=$rsReleases}
<tr>
	<td valign="top"><input type="radio" name="discogs_release_id" value="{$rsRelease->release_id}"{if $rsMusicbrainz->mb_release_id==$rsRelease->release_id} checked{/if}></td>
	<td valign="top">
	<strong><a href="/index.php/musicwhore/release/edit/{$rsRelease->release_id}/{$album_artist_id}/">{$rsRelease->album_title}</a></strong> {if $rsRelease->release_alt_title}<em>({$rsRelease->release_alt_title})</em>{/if}<br>
	</td>
	<td valign="top">{if $rsRelease->format_name}{$rsRelease->format_name}{/if}</td>
	<td valign="top">{if $rsRelease->release_catalog_num}{$rsRelease->release_catalog_num}{/if}</td>
	<td valign="top">{if $rsRelease->release_release_date}{$rsRelease->release_release_date|date_format:"%Y-%m-%d"}{/if}</td>
	<td valign="top">{if $rsRelease->release_country_name}{$rsRelease->release_country_name}{/if}</td>
</tr>
{/foreach}
</table>
</div>

<p>
<input type="submit" value="Update">
</p>

</form>

{else}
<p>This artists has no release. You cannot add releases without <a href="/index.php/musicwhore/album/add/{$album_artist_id}/">adding albums</a>.</p>

{/if}


