<form action="/index.php/members/favorite/create/{$favorite_user_id}/" method="post" name="favorites">

<p>Choose sites to add to your favorites list. You may select multiple sites.</p>

{if $page_links}
<p>
{$page_links}
</p>
{/if}

<table class="bordered wide">
<tr>
	<th></th>
	<th>SITE</th>
	<th>AUTHOR</th>
</tr>
{foreach key=e item=rsSite from=$rsSites}
<tr>
	<td><input type="checkbox" name="favorite_site_ids[{$e}]" value="{$rsSite->site_id}"></td>
	<td valign="top"><strong><a href="{$rsSite->site_url}">{$rsSite->site_name}</a></strong></td>
	<td valign="top">{get_alias_name_object obj=$rsSite}</td>
</tr>
{/foreach}
</table>

{if $page_links}
<p>
{$page_links}
</p>
{/if}

<p>
<input type="submit" name="do" value="Add">
</p>
</form>
