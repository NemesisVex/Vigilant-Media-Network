<form action="{$smarty.server.PHP_SELF}" method="post" name="profile">

{if $rsAliases}
<p>The following aliases are available for you to edit:</p>
{foreach item=rsAliases from=$rsAliases}

[<a href="/index.php/members/alias/edit/{$rsAliases->alias_id}/">Edit</a>]
[<a href="/index.php/members/alias/delete/{$rsAliases->alias_id}/">Delete</a>] <strong>{$rsAliases->alias_name}</strong><br>
{/foreach}
{else}
<p>You have yet to create any aliases. [<a href="{$smarty.server.PHP_SELF}?userID={$userID}&amp;view=edit">Add one</a>]</p>
{/if}
