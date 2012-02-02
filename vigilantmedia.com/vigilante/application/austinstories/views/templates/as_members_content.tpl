{if $session->flashget('error')}{catch_error error=$session->flashget('error') color=#F99}{/if}
{if $session->flashget('msg')}{catch_message msg=$session->flashget('msg') color=#CCF}{/if}

{if $smarty.session.is_logged_in}
{if $nomirror==true}
<p><a href="/">Austin Stories</a> is available to residents of Central Texas. Although your Vigilant Media account allows you to login, your account must first be approved for access.</p>

<p>Please <a href="/index.php/aus/contact/">contact the webmaster</a> about enabling your account for access to Austin Stories.</p>
{else}

<div class="columns">
<div class="column-left-long">
{if $members_content}{include file=$members_content}{/if}
</div>
<div class="column-right-short">
{include file=as_members_side.tpl}
</div>
</div>
{/if}
{else}
<p>To post an update or to edit your account information, please log in to your account.</p>

<p>If you don't have an account, please <strong><a href="/index.php/members/register/">sign up for one</a></strong>.</p>

{include file="as_global_login.tpl" login_action='/index.php/members/login/' user_login=$login redirect=$redirect}

<p>Forgot your password? <strong><a href="/index.php/members/password/">Create a new one</a></strong>.</p>

{/if}