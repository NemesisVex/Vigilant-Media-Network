<form action="/index.php/members/register/check/" method="post" name="register">
<p><em>Please review the terms and conditions of services before proceeding.</em></p>

{include file="as_terms_accounts.tpl"}

<p><strong>Do you agree to these terms and services?</strong></p>

<p>
{foreach key=confirm_value item=confirm_value_label from=$confirm}
<input type="radio" name="{$confirm_name}" value="{$confirm_value}"> {$confirm_value_label}<br>
{/foreach}
</p>

<input type="submit" value="Continue">

</form>

