<h4 class="admin_head">Song information</h4>

{if $rsSongs}
<table class="Admin_Wide">
<tr>
	<th>SONG</th>
</tr>
{foreach item=rsSong from=$rsSongs}
<tr>
	<td valign="top">
<a href="/index.php/ep4/song/{$function}/{$rsSong->song_id}/">{$rsSong->song_title}</a>
	</td>
</tr>
{/foreach}
</table>


{else}
<p>This artist has no songs. You should <a href="/index.php/ep4/song/add/">add some</a>.</p>
{/if}
