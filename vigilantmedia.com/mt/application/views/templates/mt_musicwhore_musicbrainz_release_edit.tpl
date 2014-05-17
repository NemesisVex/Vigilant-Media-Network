<h4 class="admin_head">Release information</h4>

{if $release_info}
<p>Musicbrainz provides the following information about this release.</p>

{assign var=release_event_list value='release-event-list'}
{assign var=catalog_number value='catalog-number'}
<table class="Admin_Wide">
<tr>
	<th>ALBUM</th>
	<th>FORMAT</th>
	<th>LABEL</th>
	<th>CATALOG NO.</th>
	<th>RELEASE DATE</th>
	<th>COUNTRY</th>
</tr>
{foreach item=event from=$release_info->$release_event_list->event}
<tr>
	<td><strong>{$release_info->title}</strong></td>
	<td>{$event.format}</td>
	<td>{$event->label->name}</td>
	<td>{$event.$catalog_number}</td>
	<td>{$event.date}</td>
	<td>{$event.country}</td>
</tr>
{/foreach}
</table>
{/if}

{if $rsMusicBrainz}
<p><strong><a href="{$request_uri|escape}">{$release_info->title}</a></strong> is already associated with the following releases:</p>

<table class="Admin_Wide">
<tr>
	<th></th>
	<th>ALBUM</th>
	<th>FORMAT</th>
	<th>CATALOG NO.</th>
	<th>RELEASE DATE</th>
	<th>COUNTRY</th>
</tr>
{foreach item=rsMusicBrainz from=$rsMusicBrainz}
<tr>
	<td valign="top">
[<a href="/index.php/musicwhore/musicbrainz/remove/{$rsMusicBrainz->mb_id}/">Delete</a>]
[<a href="/index.php/musicwhore/musicbrainz/edit/{$rsMusicBrainz->mb_id}/">Edit</a>]
	</td>
	<td valign="top">
	<strong><a href="/index.php/musicwhore/release/edit/{$rsMusicBrainz->release_id}/{$album_artist_id}/">{$rsMusicBrainz->album_title}</a></strong> {if $rsMusicBrainz->release_alt_title}<em>({$rsMusicBrainz->release_alt_title})</em>{/if}<br>
	</td>
	<td valign="top">{if $rsMusicBrainz->format_name}{$rsMusicBrainz->format_name}{/if}</td>
	<td valign="top">{if $rsMusicBrainz->release_catalog_num}{$rsMusicBrainz->release_catalog_num}{/if}</td>
	<td valign="top">{if $rsMusicBrainz->release_release_date}{$rsMusicBrainz->release_release_date|date_format:"%Y-%m-%d"}{/if}</td>
	<td valign="top">{if $rsMusicBrainz->release_country_name}{$rsMusicBrainz->release_country_name}{/if}</td>
</tr>
{/foreach}
</table>

{/if}


{if $rsReleases}
<form action="/index.php/musicwhore/musicbrainz/map/{$mb_gid}/{$album_artist_id}/" method="post" name="release">

<p>Choose a release to associate with the Musicbrainz entry for <strong><a href="{$request_uri|escape}">{$release_info->title}</a></strong>:</p>

<input type="hidden" name="function" value="create">
{if $mb_group_mb_gid}<input type="hidden" name="mb_group_mb_gid" value="{$mb_group_mb_gid}">{/if}

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
	<td valign="top"><input type="radio" name="mb_release_id" value="{$rsRelease->release_id}"{if $rsMusicbrainz->mb_release_id==$rsRelease->release_id} checked{/if}></td>
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


