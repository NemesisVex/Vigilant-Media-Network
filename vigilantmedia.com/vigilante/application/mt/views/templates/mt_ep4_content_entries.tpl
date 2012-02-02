<h4 class="admin_head">Content administration</h4>

{if $rsEntries}
<table class="Admin_Wide">
<tr>
	<th>ENTRY</th>
	<th>CATEGORY</th>
</tr>
{foreach item=rsEntry from=$rsEntries}
<tr>
	<td valign="top"><a href="/index.php/ep4/content/entry/{$rsEntry->entry_id}/{$artist_id}/">{$rsEntry->entry_title}</a></td>
	<td valign="top">{$rsEntry->category_label}</td>
</tr>
{/foreach}
</table>
{else}
<p>This categories has no entries.</p>
{/if}
