<form action="{$login_action}" method="post" id="login_form" name="login_form">

	<p>
		<label for="login">Username:</label>
		<input type="text" id="login" name="login" size="30"{if $user_login} value="{$user_login}"{/if}>
	</p>

	<p>
		<label for="password">Password:</label>
		<input type="password" id="password" name="password" size="30">
	</p>

	<p>
		<input type="hidden" id="redirect" name="redirect" value="{if $redirect}{$redirect}{else}{$smarty.server.REQUEST_URI}{/if}">
		<input type="submit" id="submit_login" value="Login">
	</p>

</form>
