<h4 class="admin_head">Delete account information</h4>

{if $rsUser}
<form action="/index.php/members/remove/{$user_id}/" method="post" name="profile">

<p><span style="color: #F00"><strong>WARNING:</strong></span> Deleting a record will permanently remove it from the database. Deletions affect all related tables, including Audiobin, and user logs. You cannot undo deletions once they're performed.</p>

<p>Are you sure you want to delete <strong>{$rsUser->user_login}</strong> <em>permanently</em> from the database?</p>

<p>
<input type="submit" id="confirm" name="confirm" value="Yes">
<input type="submit" name="confirm" value="No">
</p>


{literal}
<script type="text/javascript">
$(document).ready(function ()
{
	$('#confirm').click(function () {return confirm_delete('user');});
});
</script>
{/literal}
</form>
{else}
<p>No record was found for this user.</p>
{/if}