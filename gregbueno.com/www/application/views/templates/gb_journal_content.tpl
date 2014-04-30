{if $session->flashget('error')}{catch_error error=$session->flashget('error') color=#F99}{/if}
{if $session->flashget('msg')}{catch_message msg=$session->flashget('msg') color=#CCF}{/if}

{if $smarty.session.is_logged_in}
{if $journal_content}{include file=$journal_content}{/if}
{else}
<p>To read entries, you must be logged into your account.</p>

{include file="gb_global_login.tpl" login_action="/index.php/members/login/" user_login=$login redirect=$redirect}
{/if}