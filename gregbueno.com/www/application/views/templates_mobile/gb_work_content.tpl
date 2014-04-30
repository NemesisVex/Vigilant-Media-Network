{if $session->userdata('is_logged_in')==true}
{if $work_content}{include file=$work_content}{/if}

<p>[<a href="/index.php/work/logout/">Logout</a>]</p>
{else}
{if $session->flashdata('error')}<p>{catch_error error=$session->flashdata('error')}</p>{/if}
{if $session->flashdata('msg')}<p>{catch_message msg=$session->flashdata('msg')}</p>{/if}

<p>Please enter the login and password provided to access this area of the site.</p>

<form action="/index.php/work/login/" method="post">
	<p>
		<label for="login">Login:</label>
		<input type="text" name="login" size="45" />
	</p>

	<p>
		<label for="password">Password:</label>
		<input type="password" name="password" size="45" />
	</p>

	<p>
		<input type="hidden" name="redirect" value="{$smarty.server.REQUEST_URI}" />
		<input type="submit" value="Continue" />
	</p>
</form>

{/if}