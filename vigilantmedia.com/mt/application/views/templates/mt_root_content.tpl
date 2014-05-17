{if $session->flashget('error')}<p>{catch_error error=$session->flashget('error') color='#FCC'}</p>{/if}
{if $session->flashget('msg')}<p>{catch_message msg=$session->flashget('msg') color='#CCF'}</p>{/if}

{if $smarty.session.is_logged_in==true}
{if $root_content}{include file=$root_content}{/if}
{else}
<h4 class="admin_head">Administration login</h4>

<p>To access site administration, please log in.</p>

{include file="mt_global_login.tpl" login_action=$smarty.server.SCRIPT_NAME|cat:"/session/login/" user_login=$login redirect=$redirect}

{/if}