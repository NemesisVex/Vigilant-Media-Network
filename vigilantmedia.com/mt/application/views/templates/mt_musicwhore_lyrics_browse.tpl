<h4 class="admin_head">Audio administration</h4>

{if $rsFiles}
<table class="Admin_Wide">
<tr>
	<th>AUDIO FILES</th>
</tr>
{foreach item=rsFile from=$rsFiles}
<tr>
	<td valign="top"><a href="/index.php/musicwhore/lyrics/{$function}/{$rsFile->lyric_id}/{$lyric_artist_id}/">{$rsFile->lyric_file_name}</a></td>
</tr>
{/foreach}
</table>

{else}
<p>This artist has no audio files.</p>
{/if}

