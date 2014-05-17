<h4 class="admin_head">Audio administration</h4>

{if $rsFiles}
<table class="Admin_Wide">
<tr>
	<th>AUDIO FILES</th>
</tr>
{foreach item=rsFile from=$rsFiles}
<tr>
	<td valign="top"><a href="/index.php/ep4/audio/{$function}/{$rsFile->audio_id}/{$audio_artist_id}/" title="{$rsFile->audio_mp3_file_path|cat:"/"|cat:$rsFile->audio_mp3_file_name}">{$rsFile->audio_mp3_file_path|cat:"/"|cat:$rsFile->audio_mp3_file_name|truncate:75}</a></td>
</tr>
{/foreach}
</table>

{else}
<p>This artist has no audio files.</p>
{/if}

