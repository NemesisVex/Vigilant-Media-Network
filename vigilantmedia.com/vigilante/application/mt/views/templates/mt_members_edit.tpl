{if $rsUser}

<form action="/index.php/members/update/{$user_id}" method="post" name="profile" id="profile">

<h4 class="admin_head">Edit account information</h4>

<table class="Admin">
<tr>
	<td>Login name:</td>
	<td><input type="text" name="user_login" value="{$rsUser->user_login}" size="30"></td>
</tr>
<tr>
	<td>E-mail address:</td>
	<td><input type="text" name="user_email" value="{$rsUser->user_email}" size="30"></td>
</tr>
<tr>
	<td>First name:</td>
	<td><input type="text" name="user_first_name" value="{$rsUser->user_first_name}" size="30"></td>
</tr>
<tr>
	<td>Last name:</td>
	<td><input type="text" name="user_last_name" value="{$rsUser->user_last_name}" size="30"></td>
</tr>
<tr>
	<td>URL:</td>
	<td><input type="text" name="user_url" value="{$rsUser->user_url}" size="30"></td>
</tr>
<tr>
	<td>City:</td>
	<td><input type="text" name="user_city" value="{$rsUser->user_city}" size="30"></td>
</tr>
<tr>
	<td>State:</td>
	<td>
<select name="user_state">
<option value=""{if $rsUser->user_state==''} selected{/if}> {$rsStates->state_name}
{foreach item=rsStates from=$rsStates}
<option value="{$rsStates->state_abbr}"{if $rsUser->user_state==$rsStates->state_abbr} selected{/if}> {$rsStates->state_name}
{/foreach}
</select>
	</td>
</tr>
<tr>
	<td>Country:</td>
	<td>
<select name="user_country">
{foreach item=rsCountries from=$rsCountries}
<option value="{$rsCountries->country_name}"{if $rsUser->user_country==$rsCountries->country_name} selected{/if}> {$rsCountries->country_name}
{/foreach}
</select>
	</td>
</tr>
<tr>
	<td>Birthdate:</td>
	<td>
{*html_select_date prefix="Birth_" start_year="-80" end_year="-13" time=$rsUser->user_birthdate*}
<input type="text" name="user_birthdate" value="{$rsUser->user_birthdate}" size="30">
	</td>
</tr>
<tr>
	<td>Access mask:</td>
	<td><strong>{$rsUser->user_access_mask}</strong></td>
</tr>
<tr>
	<td valign="top">Settings:</td>
	<td>
{foreach key=access_mask item=_sess_user_access_mask from=$_sess_user_access_masks}
<input type="checkbox" name="access_mask[]" value="{$access_mask}"{if ($rsUser->user_access_mask & $access_mask)==$access_mask} checked{/if}> {$_sess_user_access_mask} ({$access_mask})<br>
{/foreach}
	</td>
</tr>
<tr>
	<td>User level:</td>
	<td>
<select name="user_level_mask">
<option value="1"{if $rsUser->user_level_mask=="1"} selected{/if}> Banned/Rejected
<option value="2"{if $rsUser->user_level_mask=="2"} selected{/if}> Pending
<option value="4"{if $rsUser->user_level_mask=="4"} selected{/if}> Temporary
<option value="8"{if $rsUser->user_level_mask=="8"} selected{/if}> Member
<option value="16"{if $rsUser->user_level_mask=="16"} selected{/if}> Administrator
<option value="32"{if $rsUser->user_level_mask=="32"} selected{/if}> Root Administrator
</select>
	</td>
</tr>
{if ($smarty.session.user_level_mask & 32) == 32}
<tr>
	<td>
	Change password:<br>
	<span style="font-size: smaller;">Leave blank for no change.</span>
	</td>
	<td>
	<input type="password" name="_user_password" value="" size="30">
	<input type="hidden" name="user_password" value="{$rsUser->user_password}">
	</td>
</tr>
<tr>
	<td>Temp password:</td>
	<td>
	<input type="password" name="user_temp_password" value="{$rsUser->user_temp_password}" size="30">
	</td>
</tr>
{/if}
</table>

<p>
<input type="submit" value="Update">
</p>


<script type="text/javascript" src="{$config.to_vigilante}/includes/jquery.validate.pack.js"></script>
{literal}
<script type="text/javascript">
$(document).ready(function ()
{
	$('#profile').validate(
	{
		rules:
		{
			user_login: {required: true},
			user_email: {required: true, email: true}
		}
	});
});
</script>
{/literal}

{else}
<p>No user could be found with this record number.</p>

{/if}