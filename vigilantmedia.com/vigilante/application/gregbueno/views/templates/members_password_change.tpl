<section class="full-column">
	<form action="/index.php/members/update_password/{$user_id}/{$user_temp_password}/" method="post" name="password" id="password">

		<p>You are currently changing a password for <strong>{$user_login}</strong>.</p>

		<p>
			<label for="newpassword">Enter a new password:</label>
			<input type="password" id="newpassword" name="newpassword" size="40" />
		</p>

		<p>
			<label for="confirmpassword">Confirm your new password:</label>
			<input type="password" id="confirmpassword" name="confirmpassword" size="40" />
		</p>

		<p>
			<input type="submit" id="submit_form" value="Set new password" /><br style="clear: left;" />
		</p>

	</form>
</section>

<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.validate.pack.js"></script>
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
