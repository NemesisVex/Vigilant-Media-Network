<form action="/index.php/members/update_password/{$user_id}/{$user_temp_password}/" method="post" name="password" id="password">

<p>You are currently changing a password for <strong>{$user_login}</strong>.</p>

<p>
<label for="newpassword">Enter a new password:</label>
<input type="password" name="newpassword" size="40"><br clear="left">
</p>

<p>
<label for="confirmpassword">Confirm your new password:</label>
<input type="password" name="confirmpassword" size="40"><br clear="left">
</p>

<p>
<input type="submit" id="submit_form" value="Set new password">
</p>

</form>

<script type="text/javascript">
{literal}
$(document).ready(function ()
{
	$('#password').validate(
	{
		rules:
		{
			newpassword: {required: true},
			confirmpassword: {required: true, equalTo: 'input[name=newpassword]'}
		}
	});
});
{/literal}
</script>
