<h4 class="admin_head">Lyric administration</h4>

<form action="/index.php/musicwhore/lyrics/{if $lyric_id}update/{$lyric_id}{else}create/{$lyric_artist_id}{/if}/" method="post" name="ep4_audio">

<table class="Admin">
<tr>
	<th colspan="3">FILE INFORMATION</th>
</tr>
<tr>
	<td>Artist:</td>
	<td colspan="2">
<select name="lyric_artist_id" id="lyric_artist_id">
{foreach item=rsArtist from=$rsArtists}
<option value="{$rsArtist->artist_id}"{if $rsArtist->artist_id==$lyric_artist_id} selected{/if}>{format_artist_name_object obj=$rsArtist}</option>
{/foreach}
</select>
	</td>
</tr>
<tr>
	<td>Lyric file name:</td>
	<td colspan="2"><input type="text" name="lyric_file_name" id="lyric_file_name" value="{$rsLyric->lyric_file_name}" size="60"></td>
</tr>
</table>

<p><input type="submit" value="Update"></p>

</form>

