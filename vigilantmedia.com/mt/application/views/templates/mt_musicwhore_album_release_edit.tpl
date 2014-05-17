<h4 class="admin_head">Release information</h4>

<form action="/index.php/musicwhore/release/{if $release_id}update/{$release_id}{else}create{/if}/{$album_artist_id}/" method="post" name="release" id="release">

<table class="Admin">
<tr>
	<th valign="top" colspan="2"><strong>DISCOG INFO</strong></th>
</tr>
<tr>
	<td valign="top"><strong>Title:</strong><br>[<a id="edit_album" style="cursor: pointer;">Edit</a>]</td>
	<td valign="top">
{if $rsAlbums}
<select name="release_album_id" id="release_album_id">
{foreach item=rsAlbum from=$rsAlbums}
{assign var=albumMask value=$rsAlbum->album_format_mask}
<option value="{$rsAlbum->album_id}"{if $rsAlbum->album_id==$release_album_id} selected{/if}> [{$rsAlbum->album_id|string_format:"%03s"}] {$rsAlbum->album_title} {if $rsAlbum->album_alt_title}({$rsAlbum->album_alt_title}){/if} {if $rsAlbum->album_format_mask}({$config.album_format_mask.$albumMask}){/if}

{/foreach}
</select>
{else}
{$title}
<input type="hidden" name="release_album_id" value="{$release_album_id}">
{/if}
	</td>
</tr>
<tr>
	<td valign="top"><strong>Alternate title:</strong><br></td>
	<td valign="top"><input type="text" name="release_alt_title" value="{$release_alt_title}" size="35"></td>
</tr>
<tr>
	<td valign="top"><strong>Catalog number:</strong><br></td>
	<td valign="top"><input type="text" name="release_catalog_num" value="{$release_catalog_num}" size="35"></td>
</tr>
<tr>
	<td valign="top">
<strong>EAN or UPC number:</strong><br>
{if $release_ean_num==""}[<a href="/index.php/musicwhore/amazon/browse/{$album_artist_id}/">Search</a>]{/if}
	</td>
	<td valign="top"><input type="text" name="release_ean_num" value="{$release_ean_num}" size="35"{if ($rsRelease!='') && ($rsRelease->release_ean_num != $release_ean_num)} style="background-color: #666;" title="Database value: {if $rsRelease->release_ean_num}{$rsRelease->release_ean_num}{else}Not set{/if}"{/if}></td>
</tr>
<tr>
	<td valign="top">
<strong>Amazon ASIN number:</strong><br>
{if $release_asin_num}[<a href="http://{$config.amazon_locale.$locale.domain}/exec/obidos/ASIN/{$release_asin_num}/{$config.amazon_locale.$locale.associateID}">View</a>]{/if}
	</td>
	<td valign="top"><input type="text" name="release_asin_num" value="{$release_asin_num}" size="35"{if ($rsRelease!='') && $rsRelease->release_asin_num != $release_asin_num} style="background-color: #666;" title="Database value: {if $rsRelease->release_ean_num}{$rsRelease->release_asin_num}{else}Not set{/if}"{/if}></td>
</tr>
<tr>
	<td valign="top"><strong>Country:</strong></td>
	<td valign="top">
<select name="release_country_name" id="release_country_name">
<option value=""> &nbsp;
{foreach item=rsCountries from=$rsCountries}
<option value="{$rsCountries->country_name}"{if $release_country_name==$rsCountries->country_name} selected{/if}> {$rsCountries->country_name}
{/foreach}
</select>
	</td>
</tr>
<tr>
	<td valign="top"><strong>Format:</strong></td>
	<td valign="top">
<select name="release_format_id">
<option value=""> &nbsp;
{foreach item=rsFormat from=$rsFormats}
<option value="{$rsFormat->format_id}"{if $release_format_id==$rsFormat->format_id} selected{/if}> {$rsFormat->format_name}
{/foreach}
</select>
	</td>
</tr>
<tr>
	<td valign="top"><strong>Label:</strong></td>
	<td valign="top"><input type="text" name="release_label" value="{$release_label}" size="20"{if ($rsRelease!='') && ($rsRelease->release_label != $release_label)} style="background-color: #666;" title="Database value: {$rsRelease->release_label}"{/if}></td>
</tr>
<tr>
	<td valign="top"><strong>Release Date:</strong></td>
	<td valign="top">
{if ($rsRelease!='') && (strtotime($rsRelease->release_release_date) != strtotime($release_release_date))}
{if $rsRelease->release_release_date==''}
{assign var=release_date_title value='Not set'}
{else}
{assign var=release_date_title value=$rsRelease->release_release_date|date_format:"%Y-%m-%d"}
{/if}
{html_select_date prefix="ReleaseDate_" start_year="1960" end_year="+5" time=$release_release_date year_empty="" month_empty="&nbsp;" day_empty="&nbsp;" year_empty="&nbsp;" all_extra='style="background-color: #666;" title="Database value: '|cat:$release_date_title|cat:'"'}
{else}
{html_select_date prefix="ReleaseDate_" start_year="1960" end_year="+5" time=$release_release_date year_empty="" month_empty="&nbsp;" day_empty="&nbsp;" year_empty="&nbsp;"}
{/if}
<input type="hidden" name="release_release_date" id="release_release_date" value="">
	</td>
</tr>
<tr>
	<td valign="top"><strong>Image File:</strong></td>
	<td valign="top"><input type="text" name="release_image" value="{$release_image}" size="30"></td>
</tr>
<tr>
	<th valign="top" colspan="2"><strong>MUSICBRAINZ</strong></th>
</tr>
{if $rsBrainz}
{foreach item=rsBrain from=$rsBrainz}
<tr>
	<td valign="top">[<a href="/index.php/musicwhore/musicbrainz/remove/{$rsBrain->mb_id}/{$album_artist_id}/">Delete</a>]</td>
	<td valign="top">
{if $rsBrain->mb_album_mb_gid}<a href="http://musicbrainz.org/album/{$rsBrain->mb_album_mb_gid}">{$rsBrain->mb_album_mb_gid}</a>{/if}
	</td>
{/foreach}
</tr>
{/if}
{if $rsArtist->artist_mb_gid}
<tr>
	<td valign="top">[<a href="/index.php/musicwhore/musicbrainz/albums/{$album_artist_id}/">Add</a>]</td>
	<td valign="top">Find Musicbrainz album IDs.</td>
</tr>
{else}
<tr>
	<td valign="top">[<a href="/index.php/musicwhore/musicbrainz/artist/{$album_artist_id}/">Add</a>]</td>
	<td valign="top">Set Musicbrainz artist ID.</td>
</tr>
{/if}
<tr>
	<th valign="top" colspan="2"><strong>ECOMMERCE</strong></th>
</tr>
<tr>
	<td valign="top">
<strong>CD Japan:</strong><br>
[<a href="http://www.cdjapan.co.jp/search.html?type=PAC&amp;restrict=ALL&amp;word={$artist_name|lower|escape:"url"}">Search</a>]
	</td>
	<td valign="top"><input type="text" name="ecomm_in[3][ecommerce_ecomm_id]" value="{$rsEcomm.3.ecommerce_ecomm_id}" size="30">{if $rsEcomm.3.ecommerce_id}<input type="hidden" name="ecomm_in[3][ecommerce_id]" value="{$rsEcomm.3.ecommerce_id}"><input type="checkbox" name="ecomm_in[3][delete]" value="1"> delete{/if}</td>
</tr>
<tr>
	<td valign="top">
<strong>YesAsia:</strong><br>
{if $rsArtist->artist_yesasia_id}[<a href="http://us.yesasia.com/en/artIdxDept.aspx/aid-{$rsArtist->artist_yesasia_id}/code-j/section-music/">Search</a>]{/if}
	</td>
	<td valign="top"><input type="text" name="ecomm_in[4][ecommerce_ecomm_id]" value="{$rsEcomm.4.ecommerce_ecomm_id}" size="30">{if $rsEcomm.4.ecommerce_id}<input type="hidden" name="ecomm_in[4][ecommerce_id]" value="{$rsEcomm.4.ecommerce_id}"><input type="checkbox" name="ecomm_in[4][delete]" value="1"> delete{/if}</td>
</tr>
<tr>
	<td valign="top">
<strong>iTunes:</strong>
<select name="ecomm_in[7][ecommerce_itunes_locale]" style="font-size: smaller;">
{foreach key=itunes_locale item=itunes_store from=$config.itunes_locale}
<option value="{$itunes_store}"{if $itunes_store==$ecomm.7.ecommerce_itunes_locale} selected{elseif !$ecomm.7.ecommerce_itunes_locale && $rsArtist->artist_default_amazon_locale==$itunes_locale} selected{/if}> {$itunes_locale}
{/foreach}
</select><br>
[<a id="parse_itunes_album_url" style="cursor: pointer;">Parse URL</a>]
	</td>
	<td valign="top"><input type="text" name="ecomm_in[7][ecommerce_ecomm_id]" id="itunes_album_url" value="{$rsEcomm.7.ecommerce_ecomm_id}" size="30">{if $rsEcomm.7.ecommerce_id}<input type="hidden" name="ecomm_in[7][ecommerce_id]" value="{$rsEcomm.7.ecommerce_id}"><input type="checkbox" name="ecomm_in[7][delete]" value="1"> delete{/if}</td>
</tr>
</table>

<p>
<input type="hidden" name="ecommerce_field_type" value="release_id">
<input type="hidden" name="ecommerce_field_id" value="{$release_id}">
<input type="submit" id="submit_form" value="Update">
</p>


<script type="text/javascript" src="{$config.to_vigilante}/includes/jquery.query.js"></script>
<script type="text/javascript" src="{$config.to_vigilante}/includes/jquery.vigilante.js"></script>
{literal}
<script type="text/javascript">
function edit_title(artist_id, album_id)
{
	window.location.href = '/index.php/musicwhore/album/edit/' + album_id + "/" + artist_id + "/";
}

$(document).ready(function()
{
	$('#edit_album').click(function() {edit_title({/literal}{$album_artist_id}{literal}, $('#release_album_id').val());})
	$('#release').submit(function() {build_smarty_select_date('ReleaseDate_', $('input[name=release_release_date]'));});
	$('#parse_itunes_album_url').click(function() {parse_itunes_url($('#itunes_album_url'));});
});

</script>
{/literal}


</form>