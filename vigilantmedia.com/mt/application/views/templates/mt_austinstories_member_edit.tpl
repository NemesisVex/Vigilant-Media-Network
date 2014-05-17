{if $rsUser}

<p><strong><em>Account info</em></strong> [<a href="/index.php/members/edit/{$rsUser->user_id}/">Edit</a>] [<a href="/index.php/members/delete/{$rsUser->user_id}/">Delete</a>]</p>

<table class="Admin">
<tr>
	<td>Login:</td>
	<td><strong>{$rsUser->user_login}</strong></td>
</tr>
<tr>
	<td>First name:</td>
	<td><strong>{$rsUser->user_first_name}</strong></td>
</tr>
<tr>
	<td>Last name:</td>
	<td><strong>{$rsUser->user_last_name}</strong></td>
</tr>
<tr>
	<td>E-mail:</td>
	<td><strong>{$rsUser->user_email}</strong></td>
</tr>
<tr>
	<td>Location:</td>
	<td><strong>{if $rsUser->user_city}{$rsUser->user_city}{/if}{if $rsUser->user_state}{if $rsUser->user_city}, {/if}{$rsUser->user_state}{/if}{if $rsUser->Country}{if $rsUser->user_state}, {/if}{$rsUser->Country}{/if}</strong></td>
</tr>
<tr>
	<td>Birthdate:</td>
	<td>{if $rsUser->user_birthdate}<strong>{$rsUser->user_birthdate|date_format:"%m/%d/%Y"}</strong>{else}(Not set){/if}</td>
</tr>
<tr>
	<td>Member since:</td>
	<td><strong>{$rsUser->user_date_added|date_format:"%m/%d/%Y"}</strong></td>
</tr>
<tr>
	<td>User level:</td>
	<td><strong>{$mask}</strong></td>
</tr>
<tr>
	<td>Access mask:</td>
	<td><strong>{$rsUser->user_access_mask}</strong></td>
</tr>
</table>

{if $rsAliases}
<p><strong><em>Austin Stories aliases</em></strong></p>

<table class="Admin">
<tr>
	<th>ALIAS</th>
	<th>OPTIONS</th>
	<th></th>
</tr>
{foreach item=rsAlias from=$rsAliases}
<tr>
	<td>{$rsAlias->alias_name}</td>
	<td>[<a href="/index.php/austinstories/alias/edit/{$rsAlias->alias_id}/{$user_id}/">Edit</a>]&nbsp;[<a href="/index.php/austinstories/alias/delete/{$rsAlias->alias_id}/{$user_id}/">Delete</a>]</td>
</tr>
{/foreach}
</table>
{/if}

{if $rsSites}
<p><strong><em>Austin Stories sites</em></strong></p>

<table class="Admin">
<tr>
	<th>SITE</th>
	<th>LISTING STATUS</th>
	<th>RSS FEED</th>
	<th>ALIAS</th>
	<th>OPTIONS</th>
	<th></th>
</tr>
{foreach item=rsSite from=$rsSites}
<tr>
	<td><a href="{$rsSite->site_url}">{$rsSite->site_name}</a></td>
	<td>{if $rsSite->site_in_directory==1}listed{else}unlisted{/if}</td>
	<td>{if $rsSite->site_rss_feed}<a href="{$rsSite->site_rss_feed}">yes</a>{else}no{/if}</td>
	<td>{if $rsSite->alias_id}{$rsSite->alias_name}{/if}</td>
	<td>[<a href="/index.php/austinstories/site/edit/{$rsSite->site_id}/{$user_id}/">Edit</a>]&nbsp;[<a href="/index.php/austinstories/site/delete/{$rsSite->site_id}/{$user_id}/">Delete</a>]</td>
</tr>
{/foreach}
</table>
{/if}

{if $rsFavorites}
<p><strong><em>Austin Stories favorites</em></strong></p>

<table class="Admin">
<tr>
	<th>SITE</th>
	<th>AUTHOR</th>
	<th>OPTIONS</th>
</tr>
{foreach item=rsFavorite from=$rsFavorites}
<tr>
	<td><a href="{$rsFavorite->site_url}">{$rsFavorite->site_name}</a></td>
	<td>{$rsFavorite->user_login}</td>
	<td>[<a href="/index.php/austinstories/favorite/delete/{$rsFavorite->favorite_id}/{$user_id}/">Delete</a>]</td>
</tr>
{/foreach}
</table>
{/if}

{if $rsPosts}
<p><strong><em>Austin Stories posts</em></strong> [<a href="/index.php/austinstories/post/browse/{$user_id}/">View all posts</a>]</p>

<table class="Admin_Wide">
<tr>
	<th>HEADLINE</th>
	<th>DATE POSTED</th>
	<th>SITE</th>
	<th>PUBLISH STATUS</th>
	<th>OPTIONS</th>
	<th></th>
</tr>
{foreach item=rsPost from=$rsPosts}
<tr>
	<td><a href="{$rsPost->portal_url}">{$rsPost->portal_headline}</a></td>
	<td>{$rsPost->portal_date_added|date_format:"%m/%d/%Y %H:%M:%S"}</td>
	<td>{$rsPost->site_name}</td>
	<td>{if $rsPost->portal_publish_status==1}published{else}unpublished{/if}</td>
	<td>[<a href="/index.php/austinstories/post/edit/{$rsPost->portal_id}/{$user_id}/">Edit</a>]&nbsp;[<a href="/index.php/austinstories/post/delete/{$rsPost->portal_id}/{$user_id}/">Delete</a>]</td>
</tr>
{/foreach}
</table>
{/if}

{else}
<p>No record was found for this user.</p>
{/if}