<form action="{$register_action}" method="post" name="register" id="register">

	<p>
		<label for="user_login">Login name</label>
		<input type="text" id="user_login" name="user_login" value="{$input.user_login}" size="35" />
	</p>

	<p>
		<label for="user_email">E-mail address</label>
		<input type="email" id="user_email" name="user_email" value="{$input.user_email}" size="35" />
	</p>

	<p>
		<label for="user_first_name">First name</label>
		<input type="text" id="user_first_name" name="user_first_name" value="{$input.user_first_name}" size="35" />
	</p>

	<p>
		<label for="user_last_name">Last name</label>
		<input type="text" id="user_last_name" name="user_last_name" value="{$input.user_last_name}" size="35" />
	</p>

	<p>
		<label for="user_url">URL</label>
		<input type="url" id="user_url" name="user_url" value="{$input.user_url}" size="35">
	</p>

	<p>
		<label for="user_city">City</label>
		<input type="text" id="user_city" name="user_city" value="{$input.user_city}" size="35" />
	</p>

	<p>
		<label for="user_state">State <em>(U.S. only)</em></label>
{html_select_states field=user_state}
	</p>

	<p>
		<label for="user_country">Country</label>
{html_select_countries field=user_country default="United States"}
	</p>

	<p>
		<label>Birthdate</label>
{if $input.user_birthdate}
{assign var=birthdate value=$input.user_birthdate}
{else}
{assign var=birthdate value=$birthdate_default}
{/if}
{html_select_date prefix="Birth_" start_year="-80" end_year="-13" time=$birthdate year_empty="&nbsp;" month_empty="&nbsp;" day_empty="&nbsp;"}
		<input type="hidden" name="user_birthdate" value="" />
	</p>

	<p>
		<label>Why are you registering for an account?</label>
		<input type="radio" name="user_access_mask" value="64" checked /> To post a comment to your journal.<br />
		<input type="radio" name="user_access_mask" value="4096" /> To read secret entries.<br />
		<input type="radio" name="user_access_mask" value="4160" /> All of the above.<br />
	</p>

	<p>
		<label>How do we know each other?</label>
		<textarea name="user_connection" rows="7" cols="45"></textarea>
	</p>

	<p><input type="submit" id="submit_form" value="Sign me up!" /></p>

</form>

<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.validate.pack.js"></script>
<script type="text/javascript">
{literal}

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
	$('#register').validate(
	{
		rules:
		{
			user_login: {required: true},
			user_email: {required: true, email: true},
			user_url: {url: true},
		}
	});
});
{/literal}
</script>
