<h4 class="admin_head">Content administration</h4>

<table class="Admin_Wide">
<tr>
	<th>CATEGORIES</th>
</tr>
{foreach item=rsCategory from=$rsCategories}
<tr>
	<td valign="top"><a href="/index.php/musicwhore/content/entries/{$rsCategory->category_id}{if $artist_id}/{$artist_id}{/if}/">{$rsCategory->category_label}</a></td>
</tr>
{/foreach}
</table>
