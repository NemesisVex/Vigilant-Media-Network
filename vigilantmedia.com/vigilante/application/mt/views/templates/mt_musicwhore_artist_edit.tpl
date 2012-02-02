<form action="/index.php/musicwhore/artist/{if $artist_id}update/{$artist_id}{else}create{/if}/" method="post" name="artist_info" id="artist_info">
{if $module}<input type="hidden" name="module" value="{$module}">{/if}

<h4 class="admin_head">Artist information</h4>

{assign var=lookup_name value=$rsArtist->artist_last_name|cat:" "|cat:$rsArtist->artist_first_name}

<table class="Admin">
<tr>
	<th colspan="2">ARTIST INFO</th>
</tr>
<tr>
	<td valign="top"><strong>Last name:</strong></td>
	<td valign="top"><input type="text" name="artist_last_name" value="{$artist_last_name}" size="35"></td>
</tr>
<tr>
	<td valign="top"><strong>First name:</strong></td>
	<td valign="top"><input type="text" name="artist_first_name" value="{$artist_first_name}" size="35"></td>
</tr>
<tr>
	<td valign="top"><strong>Asian name:</strong></td>
	<td valign="top"><input type="text" name="artist_asian_name_utf8" value="{$artist_asian_name_utf8}" size="35"></td>
</tr>
<tr>
	<td valign="top"><strong>File system base name:</strong></td>
	<td valign="top"><input type="text" name="artist_file_system" value="{$artist_file_system}" size="35"></td>
</tr>
<tr>
	<td valign="top"><strong>Soloist part:</strong><br><em>(for classical artists only)</em></td>
	<td valign="top"><input type="text" name="artist_soloist_part" value="{$artist_soloist_part}" size="35"></td>
</tr>
<tr>
	<th colspan="2">SETTINGS</th>
</tr>
<tr>
	<td valign="top"><strong>Settings:</strong></td>
	<td valign="top">
<input type="checkbox" name="artist_settings[]" value="2"{if ($artist_settings_mask & 2)==2} checked{/if}> Use Asian name format (last name first)<br>
<input type="checkbox" name="artist_settings[]" value="4"{if ($artist_settings_mask & 4)==4} checked{/if}> Flag as J~E artist<br>
<input type="checkbox" name="artist_settings[]" value="8"{if ($artist_settings_mask & 8)==8} checked{/if}> Flag as classical artist<br>
<input type="checkbox" name="artist_settings[]" value="16"{if ($artist_settings_mask & 16)==16} checked{/if}> Flag as Duran Duran project<br>
	</td>
</tr>
<tr>
	<td valign="top"><strong>Navigation:</strong></td>
	<td valign="top">
<input type="checkbox" name="nav_settings[]" value="2"{if ($artist_navigation_mask & 2)==2} checked{/if}> Profile<br>
<input type="checkbox" name="nav_settings[]" value="4"{if ($artist_navigation_mask & 4)==4} checked{/if}> Discography<br>
<input type="checkbox" name="nav_settings[]" value="8"{if ($artist_navigation_mask & 8)==8} checked{/if}> Audio<br>
<input type="checkbox" name="nav_settings[]" value="16"{if ($artist_navigation_mask & 16)==16} checked{/if}> News<br>
<input type="checkbox" name="nav_settings[]" value="32"{if ($artist_navigation_mask & 32)==32} checked{/if}> Reviews<br>
<input type="checkbox" name="nav_settings[]" value="64"{if ($artist_navigation_mask & 64)==64} checked{/if}> Lyrics<br>
<input type="checkbox" name="nav_settings[]" value="128"{if ($artist_navigation_mask & 128)==128} checked{/if}> Shop<br>
	</td>
</tr>
<tr>
	<td valign="top"><strong>Default Amazon locale:</strong></td>
	<td valign="top">
<input type="radio" name="artist_default_amazon_locale" value="us"{if $artist_default_amazon_locale eq "us"} checked{elseif !$artist_default_amazon_locale} checked{/if}> US
<input type="radio" name="artist_default_amazon_locale" value="jp"{if $artist_default_amazon_locale eq "jp"} checked{/if}> Japan
<input type="radio" name="artist_default_amazon_locale" value="uk"{if $artist_default_amazon_locale eq "uk"} checked{/if}> UK
	</td>
</tr>
<tr>
	<th colspan="2">ASSOCIATIONS</th>
</tr>
<tr>
	<td valign="top">
<strong>Musicbrainz GID:</strong><br>
{if $artist_id}<span style="font-size: smaller;">[<a href="http://musicbrainz.org/ws/1/artist/?type=xml&amp;name={$lookup_name|escape:"url"}">Lookup</a>]</span>{/if}
	</td>
	<td valign="top"><input type="text" name="artist_mb_gid" value="{$artist_mb_gid}" size="40"></td>
</tr>
<tr>
	<td valign="top">
<strong>YesAsia artist ID:</strong><br>
{if $artist_id}<span style="font-size: smaller;">[<a href="http://us.yesasia.com/SrAllDept.asp?str={$lookup_name|escape:"url"}&amp;searchBy=a&amp;associateCode={$smarty.const.YESASIA_ID}&amp;section=j" target="_blank">Lookup</a>]</span>{/if}
	</td>
	<td valign="top"><input type="text" name="artist_yesasia_id" value="{$artist_yesasia_id}" size="10"></td>
</tr>
<tr>
	<td valign="top">
<strong>iTunes artist ID:</strong><br>
<span style="font-size: smaller;">[<a href="javascript:" id="parse_itunes_artist_url">Parse URL</a>]</span></td>
	<td valign="top"><input type="text" name="artist_itunes_id" value="{$artist_itunes_id}" size="10"></td>
</tr>
<tr>
	<th colspan="2">BIOGRAPHY</th>
</tr>
<tr>
	<td colspan="2"><textarea name="artist_biography" rows="8" cols="50">{$artist_biography|escape:"html"}</textarea></td>
</tr>
<tr>
	<th colspan="2">BIOGRAPHY (more)</th>
</tr>
<tr>
	<td colspan="2"><textarea name="artist_biography_more" rows="7" cols="50">{$artist_biography_more|escape:"html"}</textarea></td>
</tr>
</table>

<p><input type="submit" value="Update"></p>

<input type="hidden" name="artist_bio_last_updated" value="{$smarty.now|date_format:"%Y-%m-%d %H:%m:%S"}">

</form>


<script type="text/javascript" src="{$config.to_vigilante}/includes/jquery.query.js"></script>
<script type="text/javascript" src="{$config.to_vigilante}/includes/jquery.validate.pack.js"></script>
<script type="text/javascript" src="{$config.to_vigilante}/includes/jquery.vigilante.js"></script>
{literal}
<script type="text/javascript">
$(document).ready(function ()
{
	$('#parse_itunes_artist_url').click(function () {parse_itunes_url($('input[name=artist_itunes_id]'))});
	$('#artist_info').validate(
	{
		rules:
		{
			artist_last_name: {required: true},
			artist_file_system: {required: true}
		}
	});
});
</script>
{/literal}
