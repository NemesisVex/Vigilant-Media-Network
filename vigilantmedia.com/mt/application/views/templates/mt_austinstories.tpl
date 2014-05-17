<h4 class="admin_head">Meeting administration</h4>

<p>
<a href="/index.php/austinstories/meetings/add/">Add meeting date</a><br>
<a href="/index.php/austinstories/meetings/browse/">Edit meeting dates</a><br>
</p>

<h4 class="admin_head">Member administration</h4>

{if $rsUsers}

<ul>
{foreach key=e item=rsUser from=$rsUsers}
<li> <a href="/index.php/austinstories/member/edit/{$rsUser->user_id}/">{$rsUser->user_login}</a></li>
{/foreach}
</ul>

{if $page_links}
<p>{$page_links}</p>
{/if}
{else}
<p>No users available.</p>
{/if}


