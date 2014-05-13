{if $rsAlias}
<form action="/index.php/members/alias/remove/{$alias_id}/" method="post" name="post">

<p><span style="color: #F99;"><strong>WARNING:</strong></span> Deleting an alias will permanently remove it from the database. You cannot undo deletions once they're performed. [<a href="/help/topic/account_delete/1/" class="help">More info</a>]</p>


<p>Are you sure you want to delete <strong>{$rsAlias->alias_name}</strong> <em>permanently</em> as a favorite site from your account?</p>

<p>
<input type="hidden" name="alias_name" value="{$rsAlias->alias_name}">
<input type="submit" id="confirm" name="confirm" value="Yes">
<input type="submit" name="confirm" value="No">
</p>

<script type="text/javascript">
{literal}
$(document).ready(function ()
{
	$('#confirm').click(function () {return confirm_delete('alias');});
});
{/literal}
</script>

</form>
{else}
<p>No record was found for this favorite site.</p>
{/if}