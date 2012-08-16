{if $session->flashget('error')}<p>{catch_error error=$session->flashget('error') color='#FCC'}</p>{/if}
{if $session->flashget('msg')}<p>{catch_message msg=$session->flashget('msg') color='#CCF'}</p>{/if}

{if $smarty.session.is_logged_in==true}
{if $root_content}{include file=$root_content}{/if}
{else}
			<div id="column-1" class="span-15 append-1">
					<header>
						<h2>Administration login</h2>
					</header>

					<p>To access site administration, please log in.</p>

{include file="obr_global_login.tpl" login_action=$smarty.server.SCRIPT_NAME|cat:"/admin/login/" user_login=$login redirect=$redirect}

			</div>

			<div id="column-2" class="span-8 last">
			</div>
{/if}