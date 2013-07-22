<form action="{$login_action}" method="post" name="loginForm">
<p>Username:<br>
<input type="text" name="login" size=30{if $user_login} value="{$user_login}"{/if}><br>
Password:<br>
<input type="password" name="password" size=30><br></p>

<p><input type="checkbox" name="saveLogin" value=1> Save my login information</p>

<input type="hidden" name="redirect" value="{if $redirect}{$redirect}{else}{$smarty.server.REQUEST_URI}{/if}">
<input type="submit" name="do" value="Login">
</form>
