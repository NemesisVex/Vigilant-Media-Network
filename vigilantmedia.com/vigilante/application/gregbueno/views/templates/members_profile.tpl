<form action="/index.php/members/update/{$user_id}/" method="post" name="profile" id="profile">
	<p>Use this form to make any changes to your account information.</p>

	<p>
		<label for="user_login">Login name:</label>
		<input type="text" id="user_login" name="user_login" value="{$rsUser->user_login}" size="50">
	</p>

	<p>
		<label for="user_email">E-mail address:</label>
		<input type="email" id="user_email" name="user_email" value="{$rsUser->user_email}" size="50">
	</p>

	<p>
		<label for="user_first_name">First name:</label>
		<input type="text" id="user_first_name" name="user_first_name" value="{$rsUser->user_first_name}" size="50">
	</p>

	<p>
		<label for="user_last_name">Last name:</label>
		<input type="text" id="user_last_name" name="user_last_name" value="{$rsUser->user_last_name}" size="50">
	</p>

	<p>
		<label for="user_url">URL:</label>
		<input type="url" id="user_url" name="user_url" value="{$rsUser->user_url}" size="50">
	</p>

	<p>
		<label for="user_city">City:</label>
		<input type="text" id="user_city" name="user_city" value="{$rsUser->user_city}" size="50">
	</p>

	<p>
		<label for="user_state">State:</label>
{html_select_states field=user_state default=$rsUser->user_state}
	</p>

	<p>
		<label for="user_country">Country:</label>
{html_select_countries field=user_country default="United States"}
	</p>

	<p>
		<label>Birthdate:</label>
{html_select_date prefix="Birth_" start_year="-80" end_year="-13" time=$rsUser->user_birthdate year_empty="&nbsp;" month_empty="&nbsp;" day_empty="&nbsp;"}
		<input type="hidden" id="user_birthdate" name="user_birthdate" value="">
	</p>

	<h4>Change password</h4>
	
	<p>Fill these fields out <strong>only</strong> if you are changing your password.</p>


	<p>
		<label for="oldpassword">Old password</label>
		<input type="password" id="oldpassword" name="oldpassword" size="50">
	</p>

	<p>
		<label for="newpassword">New password</label>
		<input type="password" id="newpassword" name="newpassword" size="50">
	</p>

	<p>
		<label for="confirmpassword">Confirm new password</label>
		<input type="password" id="confirmpassword" name="confirmpassword" size="50">
	</p>


	<p>
		<label>&nbsp;</label>
		<input id="submit_form" type="submit" value="Update">
	</p>

</form>

<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.validate.pack.js"></script>
<script type="text/javascript">
{literal}
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
		var sql_date = year + '-' + month + '-' + day + ' 00:00:00';
		$('input[name=user_birthdate]').val(sql_date);
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
{/literal}
</script>
