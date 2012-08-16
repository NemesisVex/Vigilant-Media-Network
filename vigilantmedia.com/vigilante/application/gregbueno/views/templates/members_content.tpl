<section class="prepend-1 span-22 append-1 full-column">
{if $session->flashget('error')}{catch_error error=$session->flashget('error') color=#F99}{/if}
{if $session->flashget('msg')}{catch_message msg=$session->flashget('msg') color=#CCF}{/if}

{if $smarty.session.LoggedIn}
{if $members_content}{include file=$members_content}{/if}
{else}
	<p>To edit your account information, please log in to your account.</p>

	<p>If you don't have an account, please <strong><a href="{if $register_path}{$register_path}{else}/index.php/members/register/{/if}">sign up for one</a></strong>.</p>

{include file="gb_global_login.tpl" login_action="/index.php/members/login/" user_login=$login redirect=$redirect}

	<p>Forgot your password? <strong><a href="{if $password_path}{$password_path}{else}/index.php/members/password/{/if}">Create a new one</a></strong>.</p>

{/if}
</section>