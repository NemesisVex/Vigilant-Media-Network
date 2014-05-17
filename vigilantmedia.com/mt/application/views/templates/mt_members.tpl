{if $rsUsers}

<ul class="nav-list">
{foreach key=e item=rsUser from=$rsUsers}
{assign var=user_level_mask value=$rsUser->user_level_mask}
<li> <a href="/index.php/members/edit/{$rsUser->user_id}/"><img src="{$config.to_vigilante}/images/icons/edit-page-blue.gif" /></a>
<a href="/index.php/members/delete/{$rsUser->user_id}/"><img src="{$config.to_vigilante}/images/icons/delete-page-blue.gif" /></a>
{$rsUser->user_login}</li>
{/foreach}
</ul>

{if $page_links}
<p>{$page_links}</p>
{/if}
{else}
<p>No users available.</p>
{/if}
