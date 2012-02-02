<form action="{$smarty.server.PHP_SELF}" method="{if $formMethod}{$formMethod}{else}post{/if}" name="album_tracks">

<h4 class="admin_head">Track information</h4>

{if $module}<input type="hidden" name="module" value="{$module}">{/if}

{if $albumID}
<input type="hidden" name="albumID" value="{$albumID}">
<input type="hidden" name="track_album_id" value="{$albumID}">
{/if}

{if $detailID}
<input type="hidden" name="detailID" value="{$detailID}">
<input type="hidden" name="track_detail_id" value="{$detailID}">
{/if}

{if $artistID}
<input type="hidden" name="artistID" value="{$artistID}">
{/if}

{if $view=="list"}
{if $rsDiscog}
<p>Choose an album to edit:<br>
<table class="Admin">
<tr>
	<th>OPTIONS</th>
	<th>ALBUM</th>
</tr>
{foreach item=rsDiscog from=$rsDiscog}
<tr>
	<td valign="top">
	[<a href="{$smarty.server.PHP_SELF}?module={$module}&amp;artistID={$rsDiscog->album_artist_id}&amp;albumID={$rsDiscog->album_id}&amp;detailID={$rsDiscog->detail_id}&amp;view={if $do=="Add"}newTracks{else}addTracks{/if}">{if $do=="Add"}Add{else}Edit{/if}</a>]
	</td>
	<td valign="top">
	<strong><a href="{$smarty.server.PHP_SELF}?module={$module}&amp;artistID={$rsDiscog->album_artist_id}&amp;albumID={$rsDiscog->album_id}&amp;detailID={$rsDiscog->detail_id}&amp;view={if $do=="Add"}newTracks{else}addTracks{/if}">{$rsDiscog->album_title}</a></strong> {if $rsDiscog->detail_alt_title}<em>({$rsDiscog->detail_alt_title})</em>{/if}<br>
	{if $rsDiscog->detail_release_date}&#8211; {$rsDiscog->detail_release_date|date_format:"%Y-%m-%d"}{/if}
	{if $rsDiscog->detail_catalog_num}&#8211; {$rsDiscog->detail_catalog_num}{/if}
	{if $rsDiscog->detail_label}&#8211; {$rsDiscog->detail_label}{/if}
	{if $rsDiscog->detail_country_name}&#8211; {$rsDiscog->detail_country_name}{/if}
	</td>
</tr>
{/foreach}
</table>
</p>
{else}
<p>No albums require new tracks.</p>
{/if}

{elseif $view=="newTracks"}
<p>There are no tracks yet added to <strong><em>{$rsAlbum->album_title}{if $rsAlbum->detail_alt_title} ({$rsAlbum->detail_alt_title}){/if}</em></strong>. Please add them now.</p>

<p><strong>How many tracks does this album have?</strong><br>
<input type="text" name="numOfTracks" size=3></p>

<input type="hidden" name="formMethod" value="post">
<input type="hidden" name="do" value="Edit">

<p>
<input type="submit" value="View tracks">
</p>

{if $rsBrainz || $rsAsin}
<p><strong>More options</strong></p>

<ul>
{if $rsAsin}<li> <a href="{$smarty.server.PHP_SELF}?module={$module}&amp;artistID={$artistID}&amp;detailID={$detailID}&amp;asin=B000BRWJ9M{*$rsAsin->ecommerce_ecomm_id*}&amp;locale=jp{$rsAsin->ecommerce_amazon_locale}&amp;do=Edit">Retrieve tracks from Amazon web service</a></li>{/if}
{if $rsBrainz}<li> <a href="{$smarty.server.PHP_SELF}?module={$module}&amp;artistID={$artistID}&amp;detailID={$detailID}{foreach item=rsBrainz from=$rsBrainz}&mbAlbumGIDs[]={$rsBrainz->mb_album_mb_gid}{/foreach}&amp;do=Edit">Retrieve tracks from Musicbrainz web service</a>{/if}
</ul>
{/if}

{elseif $view=="addTracks"}
<p><strong>Would you like to add tracks to <em>{$rsAlbum->album_title}{if $rsAlbum->detail_alt_title} ({$rsAlbum->detail_alt_title}){/if}</em>?</strong><br>

<input type="radio" name="isAddMore" value="0" checked> No, I want to edit only the existing tracks.<br>
<input type="radio" name="isAddMore" value="1"> Yes, I want to add <input type="text" name="moreTracks" size="3"> tracks to disc no. <input type="text" name="moreDiscNumber" value="1" size="3">.</p>

<input type="hidden" name="formMethod" value="post">
<input type="hidden" name="do" value="Edit">

<p>
<input type="submit" value="Continue">
</p>

{if $rsBrainz || $rsAsin}
<p><strong>More options</strong></p>

<ul>
{if $rsAsin}
<li> <a href="{$smarty.server.PHP_SELF}?module={$module}&amp;artistID={$artistID}&amp;detailID={$detailID}&amp;asin={$rsAsin->ecommerce_ecomm_id}&amp;locale={$rsAsin->ecommerce_amazon_locale}&amp;do=Edit">Replace tracks with Amazon web service</a>
<ul>
<li> <a href="{$smarty.server.PHP_SELF}?module={$module}&amp;artistID={$artistID}&amp;detailID={$detailID}&amp;asin={$rsAsin->ecommerce_ecomm_id}&amp;locale={$rsAsin->ecommerce_amazon_locale}&amp;azAlt=1&amp;do=Edit">Set Amazon titles as alternate titles</a></li>
<li> <a href="{$smarty.server.PHP_SELF}?module={$module}&amp;artistID={$artistID}&amp;detailID={$detailID}&amp;asin={$rsAsin->ecommerce_ecomm_id}&amp;locale={$rsAsin->ecommerce_amazon_locale}&amp;azSong=1&amp;do=Edit">Set Amazon titles as song titles, and current titles as alternate titles</a></li>
</ul>
</li>
{/if}
{if $rsBrainz}
<li> <a href="{$smarty.server.PHP_SELF}?module={$module}&amp;artistID={$artistID}&amp;detailID={$detailID}{section name=bIDs loop=$rsBrainz}&mbAlbumGIDs[]={$rsBrainz[bIDs]->mb_album_mb_gid}{/section}&amp;do=Edit">Replace tracks with Musicbrainz web service</a>
<ul>
<li> <a href="{$smarty.server.PHP_SELF}?module={$module}&amp;artistID={$artistID}&amp;detailID={$detailID}{section name=bIDs loop=$rsBrainz}&mbAlbumGIDs[]={$rsBrainz[bIDs]->mb_album_mb_gid}{/section}&amp;mbAlt=1&amp;do=Edit">Set Musicbrainz titles as alternate titles</a></li>
<li> <a href="{$smarty.server.PHP_SELF}?module={$module}&amp;artistID={$artistID}&amp;detailID={$detailID}{section name=bIDs loop=$rsBrainz}&mbAlbumGIDs[]={$rsBrainz[bIDs]->mb_album_mb_gid}{/section}&amp;mbSong=1&amp;do=Edit">Set Musicbrainz titles as song titles, and current titles as alternate titles</a></li>
</ul>
</li>
{/if}
</ul>
{/if}

{elseif $view=="edit"}

<p>You are currently editing track information for <strong><em>{$rsAlbum->album_title}{if $rsAlbum->detail_alt_title} ({$rsAlbum->detail_alt_title}){/if}</em></strong>.</p>

<p>
<input type="submit" name="do" value="Update">
</p>

<input type="hidden" name="ecommerce_field_type" value="track_id">
<input type="hidden" name="ecommerce_merchant_id" value="7">

{foreach key=d item=discs from=$trackOut}
<p><table class="Admin">
<tr>
	<th>DISC #</th>
	<th>TRACK #</th>
	<th>SONG TITLE</th>
	<th>ALTERNATE TITLE</th>
	<th>ITUNES ITEM #</th>
	<th>ITUNES LOCALE</th>
	<th>DELETE</th>
</tr>
{foreach key=t item=tracks from=$discs}
<tr>
	<td valign="top"><input type="text" name="trackIn[{$d}][{$t}][track_disc_num]" value="{$d}" size="2"></td>
	<td valign="top"><input type="text" name="trackIn[{$d}][{$t}][track_track_num]" value="{$t}" size="2"></td>
	<td valign="top"><input type="text" name="trackIn[{$d}][{$t}][track_song_title]" value="{$tracks.track_song_title}"></td>
	<td valign="top"><input type="text" name="trackIn[{$d}][{$t}][track_alt_title]" value="{$tracks.track_alt_title}"></td>
	<td valign="top"><input type="text" name="trackIn[{$d}][{$t}][ecommerce_ecomm_id]" value="{$tracks.ecommerce_ecomm_id}"><br>
	<span style="font-size: smaller;">[<a href="javascript:ParseITunesURL(document.album_tracks.elements['trackIn[{$d}][{$t}][ecommerce_ecomm_id]'], 'i');">Parse URL</a>]</span></td>
	<td valign="top">
{foreach key=locale item=itunes_store from=$config.itunes_store}
<input type="radio" name="trackIn[{$d}][{$t}][ecommerce_itunes_locale]" value="{$itunes_store}"{if $tracks.ecommerce_itunes_locale==$itunes_store} checked{elseif !$tracks.ecommerce_itunes_locale && $locale==$amazon_locale} checked{/if}> {$locale}
{/foreach}
	</td>
	<td valign="top">
<span style="font-size: smaller;">
{if $tracks.track_id}<input type="checkbox" name="trackIn[{$d}][{$t}][delete_itunes]" value="1">iTunes<input type="hidden" name="trackIn[{$d}][{$t}][ecommerce_id]" value="{$tracks.ecommerce_id}">{/if}
{if $tracks.track_id}<input type="checkbox" name="trackIn[{$d}][{$t}][delete]" value="1">Track<input type="hidden" name="trackIn[{$d}][{$t}][track_id]" value="{$tracks.track_id}">{/if}
</span>
	</td>
</tr>
{/foreach}
</table></p>
{/foreach}

<p>
<input type="submit" name="do" value="Update">
</p>

<script type="text/javascript" src="{$config.to_vigilante}/includes/ui.js"></script>
<script type="text/javascript" src="/includes/mt.js"></script>

{else}
{write_artist_select_box filter=$filter filterURL=$filterURL}

<input type="submit" value="Select">
{/if}

</form>