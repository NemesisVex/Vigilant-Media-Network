<form action="{$login_action}" method="post" name="loginForm">

<p>
<label for="login">Username:</label>
<input type="text" name="login" size=30{if $user_login} value="{$user_login}"{/if}>
</p>

<p>
<label for="password">Password:</label>
<input type="password" name="password" size=30>
</p>

<p>
<input type="hidden" name="redirect" value="{if $redirect}{$redirect}{else}{$smarty.server.REQUEST_URI}{/if}">
<input type="submit" value="Login">
</p>

</form>
