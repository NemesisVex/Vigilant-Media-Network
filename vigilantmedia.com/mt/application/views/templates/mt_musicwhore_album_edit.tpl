<h4 class="admin_head">Album information</h4>

<form action="/index.php/musicwhore/album/{if $album_id}update/{$album_id}{else}create{/if}/{$album_artist_id}/" method="post" name="album" id="album">

<input type="hidden" name="ecommerce_field_type" value="album_id">
<input type="hidden" name="ecommerce_field_id" value="{$albumID}">

<table class="Admin">
<tr>
	<th valign="top" colspan="2"><strong>DISCOG INFO</strong></th>
</tr>
{if $album_id}
<tr>
	<td valign="top"><strong>ID:</strong></td>
	<td valign="top">{$album_id}<input type="hidden" name="album_id" value="{$album_id}"></td>
</tr>
{/if}
<tr>
	<td valign="top"><strong>Title:</strong></td>
	<td valign="top"><input type="text" name="album_title" value="{$album_title}" size="50"></td>
</tr>
<tr>
	<td valign="top"><strong>Asian Romanized title:</strong></td>
	<td valign="top"><input type="text" name="album_asian_romanized_title" value="{$album_asian_romanized_title}" size="50"></td>
</tr>
<tr>
	<td valign="top"><strong>Alternative title:</strong><br><span style="font-size: smaller">(translated, etc.)</span></td>
	<td valign="top"><input type="text" name="album_alt_title" value="{$album_alt_title}" size="50"></td>
</tr>
<tr>
	<td valign="top"><strong>Format:</strong><br><span style="font-size: smaller">(translated, etc.)</span></td>
	<td valign="top">
<select name="album_format_mask">
{foreach key=format_mask item=format_name from=$config.album_format_mask}
<option value="{$format_mask}"{if $album_format_mask==$format_mask} selected{/if}> {$format_name}
{/foreach}
</select>
	</td>
</tr>
<tr>
	<td valign="top"><strong>Label:</strong></td>
	<td valign="top"><input type="text" name="album_label" value="{$album_label}" size="50"></td>
</tr>
<tr>
	<td valign="top"><strong>Release Date:</strong></td>
	<td valign="top">
{html_select_date prefix="ReleaseDate_" start_year="1960" end_year="+5" time=$album_release_date year_empty="&nbsp;" month_empty="&nbsp;" day_empty="&nbsp;"}
<input type="hidden" name="album_release_date" value="">
	</td>
</tr>
<tr>
	<td valign="top"><strong>Image File:</strong></td>
	<td valign="top"><input type="text" name="album_image" value="{$album_image}" size="50"></td>
</tr>
<tr>
	<th valign="top" colspan="2"><strong>CLASICAL INFO</strong></th>
</tr>
<tr>
	<td valign="top"><strong>Soloist</strong></td>
	<td valign="top">
	<select name="album_soloist_id">
	<option value=""> --N/A--
{foreach item=rsClassicalArtist from=$rsClassicalArtists}
	<option value="{$rsClassicalArtist->artist_id}"{if $album_soloist_id==$rsClassicalArtist->artist_id} selected{/if}> {format_artist_name_object obj=$rsClassicalArtist}
{/foreach}
	</select>
	</td>
</tr>
<tr>
	<td valign="top"><strong>Conductor</strong></td>
	<td valign="top">
	<select name="album_conductor_id">
	<option value=""> --N/A--
{foreach item=rsClassicalArtist from=$rsClassicalArtists}
	<option value="{$rsClassicalArtist->artist_id}"{if $album_conductor_id==$rsClassicalArtist->artist_id} selected{/if}> {format_artist_name_object obj=$rsClassicalArtist}
{/foreach}
	</select>
	</td>
</tr>
<tr>
	<td valign="top"><strong>Ensemble</strong></td>
	<td valign="top">
	<select name="album_ensemble_id">
	<option value=""> --N/A--
{foreach item=rsClassicalArtist from=$rsClassicalArtists}
	<option value="{$rsClassicalArtist->artist_id}"{if $album_ensemble_id==$rsClassicalArtist->artist_id} selected{/if}> {format_artist_name_object obj=$rsClassicalArtist}
{/foreach}
	</select>
	</td>
</tr>
{if $album_id}
<tr>
	<th valign="top" colspan="2"><strong>RELEASES</strong></th>
</tr>
{if $rsReleases}
{foreach item=rsRelease from=$rsReleases}
<tr>
	<td valign="top">
	[<a href="/index.php/musicwhore/release/edit/{$rsRelease->release_id}/{$album_artist_id}/">Edit</a>]
	[<a href="/index.php/musicwhore/release/delete/{$rsRelease->release_id}/{$album_artist_id}/">Delete</a>]
	</td>
	<td valign="top">
{if $rsRelease->release_catalog_num}&#8211; <a href="/index.php/musicwhore/release/edit/{$rsRelease->release_id}/{$album_artist_id}/">{$rsRelease->release_catalog_num}</a>{/if}
{if $rsRelease->release_country_name} &#8211; {$rsRelease->release_country_name}{/if}
{if $rsRelease->release_alt_title} &#8211; <em>{$rsRelease->release_alt_title}</em>{/if}
<br>
{/foreach}
	</td>
</tr>
{/if}
<tr>
	<td valign="top">[<a href="/index.php/musicwhore/release/add/{$album_artist_id}/{$album_id}/">Add</a>]</td>
	<td valign="top">Add a new release.</td>
</tr>
{/if}
</table>

{if $auth_request_uri}<p class="smaller"><a href="{$auth_request_uri}">Amazon request URI</a></p>{/if}

<p>
<input type="submit" id="submit_form" value="Update">
</p>

</form>


{literal}
<script type="text/javascript">
function build_release_date()
{
	var release_date_year = $('select[name=ReleaseDate_Year]').val();
	var release_date_month = $('select[name=ReleaseDate_Month]').val();
	var release_date_day = $('select[name=ReleaseDate_Day]').val();
	
	if (release_date_year!='' && release_date_month!='' && release_date_day!='')
	{
		var release_date = release_date_year + '-' + release_date_month + '-' + release_date_day + ' 00:00:00';
		$('input[name=album_release_date]').val(release_date);
	}
}

$(document).ready(function()
{
	$('#submit_form').click(function() {build_release_date();});
});

</script>
{/literal}
