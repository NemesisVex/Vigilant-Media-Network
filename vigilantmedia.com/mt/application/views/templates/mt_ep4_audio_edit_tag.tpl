<h4 class="admin_head">Audio administration</h4>

<form action="/index.php/ep4/audio/retag/{$audio_id}/" method="post" name="ep4_audio">

{if $version == 'id3v1'}
{assign var=track_field value='track'}
{elseif $version == 'id3v2'}
{assign var=track_field value='track_number'}
{/if}

<table class="Admin">
<tr>
	<th colspan="2">{$version|upper} TAG INFORMATION</th>
</tr>
<tr>
	<td>File path:</td>
	<td title="{$file}">{$file|truncate:50}</td>
</tr>
<tr>
	<td>Artist:</td>
	<td><input type="text" name="tag[artist]" value="{$file_tags.tags.$version.artist.0}" size="50"></td>
</tr>
<tr>
	<td>Title:</td>
	<td><input type="text" name="tag[title]" value="{$file_tags.tags.$version.title.0}" size="50"></td>
</tr>
<tr>
	<td>Album:</td>
	<td><input type="text" name="tag[album]" value="{$file_tags.tags.$version.album.0}" size="50"></td>
</tr>
<tr>
	<td>Year:</td>
	<td><input type="text" name="tag[year]" value="{$file_tags.tags.$version.year.0}" size="50"></td>
</tr>
<tr>
	<td>Track:</td>
	<td><input type="text" name="tag[track]" value="{$file_tags.tags.$version.$track_field.0}" size="50"></td>
</tr>
{if $version=='id3v2'}
<tr>
	<td>Band:</td>
	<td><input type="text" name="tag[band]" value="{$file_tags.tags.$version.band.0}" size="50"></td>
</tr>
<tr>
	<td>Copyright:</td>
	<td><input type="text" name="tag[copyright]" value="{$file_tags.tags.$version.copyright_message.0}" size="50"></td>
</tr>
<tr>
	<td>URL:</td>
	<td><input type="text" name="tag[url_artist]" value="{$file_tags.tags.$version.url_artist.0}" size="50"></td>
</tr>
{/if}
</table>

<p>
<input type="hidden" name="path" value="{$path}">
<input type="hidden" name="version" value="{$version}">
<input type="submit" value="Update">
</p>

</form>


