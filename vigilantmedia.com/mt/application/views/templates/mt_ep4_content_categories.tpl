<h4 class="admin_head">Content administration</h4>

<table class="Admin_Wide">
<tr>
	<th>CATEGORIES</th>
</tr>
{foreach item=rsCategory from=$rsCategories}
<tr>
	<td valign="top"><a href="/index.php/ep4/content/entries/{$rsCategory->category_id}/{$artist_id}/">{$rsCategory->category_label}</a></td>
</tr>
{/foreach}
</table>
