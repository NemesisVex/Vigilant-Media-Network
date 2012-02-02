<h4 class="admin_head">Delete favorite site</h4>

{if $rsFavorite}
<form action="/index.php/austinstories/favorite/remove/{$favorite_id}/{$favorite_user_id}/" method="post" name="post">

<p><span style="color: #F00"><strong>WARNING:</strong></span> Deleting a record will permanently remove it from the database. Deletions affect all related tables. You cannot undo deletions once they're performed.</p>

<p>Are you sure you want to delete <strong>{$rsFavorite->site_name}</strong> <em>permanently</em> as a favorite site from {$rsUser->user_login}'s account?<br>

<input type="hidden" name="site_name" value="{$rsFavorite->site_name}">
<input type="submit" id="confirm" name="confirm" value="Yes">
<input type="submit" name="confirm" value="No">
</p>


{literal}
<script type="text/javascript">
$(document).ready(function ()
{
	$('#confirm').click(function () {return confirm_delete('favorite site');});
});
</script>
{/literal}
</form>
{else}
<p>No record was found for this favorite site.</p>
{/if}