<h4 class="admin_head">Pending memberships</h4>

{if $rsUsers}
<p>The following user{if count($rsUsers)>1}s are{else} is{/if} seeking membership.</p>

{foreach key=e item=rsUser from=$rsUsers}
<form action="/index.php/members/approve/{$rsUser->user_id}/" method="post">

<table class="Admin_Wide">
<tr>
	<th>LOGIN</th>
	<th>NAME</th>
	<th>LOCATION</th>
	<th>BIRTHDATE</th>
</tr>
<tr>
	<td><strong><a href="/index.php/members/edit/{$rsUser->user_id}/">{$rsUser->user_login}</a></strong></td>
	<td><a href="mailto:{$rsUser->user_email}">{$rsUser->user_first_name} {$rsUser->user_last_name}</a></td>
	<td>{$rsUser->user_city}{if $rsUser->user_state}, {$rsUser->user_state}{/if}{if $rsUser->user_country}, {$rsUser->user_country}{/if}</td>
	<td>{$rsUser->birthdate}{if $rsUser->user_birthdate}{$rsUser->user_birthdate|date_format:"%m/%d/%Y"}{else}(Not set){/if}</td>
</tr>
<tr>
	<th colspan="4">USER LEVEL</th>
</tr>
<tr>
	<td colspan="4" align="center">
	<input type="radio" name="user_level_mask" value="2"{if ($rsUser->user_level_mask & 2)==2} checked{/if}> Pending
	<input type="radio" name="user_level_mask" value="8"> Member
	<input type="radio" name="user_level_mask" value="16"> Administrator
	<input type="radio" name="user_level_mask" value="32"> Root Administrator
	<input type="radio" name="user_level_mask" value="4"{if ($rsUser->user_level_mask & 4)==4} checked{/if}> Temporary
	<input type="radio" name="user_level_mask" value="1"> Banned/Rejected
	</td>
</tr>
<tr>
	<th colspan="4">NOTIFICATION EMAIL</th>
</tr>
<tr>
	<td colspan="4" align="center">
	<input type="radio" name="notify" value="8"{if ($rsUser->user_access_mask & 8)==8} checked{/if}> Austin Stories
	<input type="radio" name="notify" value="64"{if ($rsUser->user_access_mask & 64)==64} checked{/if}> Gregbueno.com
	</td>
</tr>
<tr>
	<th colspan="4">SETTINGS REQUESTED</th>
</tr>
<tr>
	<td colspan="4">
{foreach key=access_mask item=user_access_mask from=$_sess_user_access_masks}
<input type="checkbox" name="access_mask[]" value="{$access_mask}"{if ($rsUser->user_access_mask & $access_mask)==$access_mask} checked{/if}> {$user_access_mask}<br>
{/foreach}
	</td>
</tr>
</table>


<p><input type="submit" name="task" value="Update"></p>

<p><a href="/index.php/members/delete/{$rsUser->user_id}/">Delete this user</a></p>
</form>
{/foreach}

{else}
<p>No users pending approval.</p>
{/if}



