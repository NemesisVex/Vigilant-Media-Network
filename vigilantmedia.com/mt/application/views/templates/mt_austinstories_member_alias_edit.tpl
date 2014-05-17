<h4 class="admin_head">Alias information</h4>

{if $rsAlias}
<form action="/index.php/austinstories/alias/update/{$alias_id}/{$alias_user_id}/" method="post" name="site">

<p><label for="site_name">Alias name:</label>
<input type="text" name="alias_name" value="{$rsAlias->alias_name}" size="50"></p>

<p><input type="submit" value="Update alias"></p>

</form>
{else}
<p>No record found for this alias.</p>
{/if}
