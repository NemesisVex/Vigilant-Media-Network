<h4 class="admin_head">Delete site</h4>

{if $rsSite}
<form action="/index.php/austinstories/site/remove/{$site_id}/{$site_user_id}/" method="post" name="post">

<p><span style="color: #F00"><strong>WARNING:</strong></span> Deleting a record will permanently remove it from the database. Deletions affect all related tables. You cannot undo deletions once they're performed.</p>

<p>Are you sure you want to delete <strong>{$rsSite->site_name}</strong> <em>permanently</em> from the database?<br>

<input type="hidden" name="site_name" value="{$rsSite->site_name}">
<input type="submit" id="confirm" name="confirm" value="Yes">
<input type="submit" name="confirm" value="No">
</p>


{literal}
<script type="text/javascript">
$(document).ready(function ()
{
	$('#confirm').click(function () {return confirm_delete('site');});
});
</script>
{/literal}
</form>
{else}
<p>No record was found for this site.</p>
{/if}