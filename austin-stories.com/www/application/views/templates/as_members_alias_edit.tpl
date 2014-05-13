<form action="/index.php/members/alias/{if $alias_id}update/{$alias_id}/{else}create/{/if}" method="post" name="site">

<p>If you have a journal that you don't want associated with your account name, use this form to create or to edit an alias for your account. You can then associate this alias with your sites. [<a href="/index.php/help/topic/account_aliases/1/" class="help">Help</a>]</p>

<p><label for="alias_name">Alias name:</label>
<input type="text" name="alias_name" value="{$rsAlias->alias_name}" size="50"></p>

<p><input type="submit" value="Update alias"></p>

</form>
