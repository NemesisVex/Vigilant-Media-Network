{if $session->flashget('error')}{catch_error error=$session->flashget('error') color=#F99}{/if}
{if $session->flashget('msg')}{catch_message msg=$session->flashget('msg') color=#CCF}{/if}

<p>All memberships are subject to approval. Once your membership has been approved, a password will be mailed to your e-mail address.</p>

<p><strong>NOTE:</strong> If you are already a member of <a href="http://www.austin-stories.com/">Austin Stories</a>, please <a href="/index.php/gb/contact/">contact me</a> to enable access with your current login.</p>

<p>If this visit is your first, you will be granted access to comment posting, but you will need to e-mail me about enabling access to the secret entries.</p>

{include file="members_register_form.tpl" register_action="/index.php/members/add/"}

