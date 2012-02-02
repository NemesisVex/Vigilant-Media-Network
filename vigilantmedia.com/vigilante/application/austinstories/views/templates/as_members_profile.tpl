{if $msg}<p>{catch_message msg=$msg}</p>{/if}
{if $error}<p>{catch_error error=$error}</p>{/if}

<form action="/index.php/members/profile/update/{$user_id}/" method="post" name="profile" id="profile">

<p>Use this form to make any changes to your account information. [<a href="/index.php/help/topic/account_info/1/" class="help">Help</a>]</p>


<p>
	<label for="">Login name:</label>
	<input type="text" name="user_login" value="{$rsUser->user_login}" size="50">
</p>
<p>
	<label for="">E-mail address:</label>
	<input type="text" name="user_email" value="{$rsUser->user_email}" size="50">
</p>
<p>
	<label for="">First name:</label>
	<input type="text" name="user_first_name" value="{$rsUser->user_first_name}" size="50">
</p>
<p>
	<label for="">Last name:</label>
	<input type="text" name="user_last_name" value="{$rsUser->user_last_name}" size="50">
</p>
<p>
	<label for="">City:</label>
	<input type="text" name="user_city" value="{$rsUser->user_city}" size="50">
</p>
<p>
	<label for="">State:</label>
	{html_select_states field=user_state default=$rsUser->user_state}
</p>
<p>
	<label for="">Country:</label>
	{html_select_countries field=user_country default=$rsUser->user_country}
</p>
{*<p>
	<label for="">Birthdate:</label>
{if $rsUser->user_birthdate==""}
{assign var=user_birthdate value=null}
{else}
{assign var=user_birthdate value=$rsUser->user_birthdate}
{/if}
{html_select_date prefix="Birth_" start_year="-80" end_year="-13" time=$user_birthdate year_empty="&nbsp;" month_empty="&nbsp;" day_empty="&nbsp;"}
<input type="hidden" name="user_birthdate" value="">
	
</p>*}
{if ($rsUser->user_access_mask & 2)==0 || ($rsUser->user_access_mask & 1)==0 || ($rsUser->user_access_mask & 4)==0}
<p>
	<label for="">Which name do you want to appear on the site?</label>
	
	<input type="radio" name="real_name_mask" value="2"{if ($rsUser->user_access_mask & 2)==2} checked{/if}> My real name<br>
	<input type="radio" name="real_name_mask" value="4"{if ($rsUser->user_access_mask & 4)==4} checked{/if}> My login<br>
	
</p>
{/if}



<h3>Change password</h3>

<p>Fill these fields out <em>only</em> if you are changing your password.</p>


<p>
	<label for="">Old password:</label>
	<input type="password" name="oldpassword" size="50">
</p>
<p>
	<label for="">New password:</label>
	<input type="password" name="newpassword" size="50">
</p>
<p>
	<label for="">Confirm new password:</label>
	<input type="password" name="confirmpassword" size="50">
</p>


<p><input type="submit" id="submit_form" value="Update"></p>
</form>

{literal}
<script type="text/javascript">
$.validator.addMethod(
	'notEqualTo',
	function (value, element, params)
	{
		var old_value = params[0].val();
		var new_value = params[1].val();
		return this.optional(element) || ((old_value != '') && (new_value != old_value));
	},
	'Make sure your old password does not match your new password'
);

$(document).ready(function ()
{
	$('#submit_form').click(function ()
	{
		var year = $('select[name=Birth_Year]').val();
		var month = $('select[name=Birth_Month]').val();
		var day = $('select[name=Birth_Day]').val();
		if (year != '' && month != '' && day != '')
		{
			var sql_date = year + '-' + month + '-' + day + ' 00:00:00';
			$('input[name=user_birthdate]').val(sql_date);
		}
	});
	$('#profile').validate(
	{
		rules:
		{
			user_login: {required: true},
			user_email: {required: true, email: true},
			oldpassword: {notEqualTo: [$('input[name=oldpassword]'),$('input[name=newpassword]')]},
			newpassword: {required: function (element)
			{
				return $('input[name=oldpassword]').val().length > 0
			}},
			confirmpassword: {equalTo: 'input[name=newpassword]'}
		}
	});
});
</script>
{/literal}
