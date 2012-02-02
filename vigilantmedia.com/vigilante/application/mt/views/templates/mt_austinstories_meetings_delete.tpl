<h4 class="admin_head">Delete meeting</h4>

{if $rsMeeting}
<form action="/index.php/austinstories/meetings/remove/{$meet_id}/" method="post" name="post">

<p><span style="color: #F00"><strong>WARNING:</strong></span> Deleting a record will permanently remove it from the database. Deletions affect all related tables. You cannot undo deletions once they're performed.</p>

<p>Are you sure you want to delete <strong>{$rsMeeting->meet_date|date_format:"%m-%d-%Y"}</strong> <em>permanently</em> as a meeting date?<br>

<input type="hidden" name="meet_date" value="{$rsMeeting->meet_date|date_format:"%m-%d-%Y"}">
<input type="submit" id="confirm" name="confirm" value="Yes">
<input type="submit" name="confirm" value="No">
</p>

{literal}
<script type="text/javascript">
$(document).ready(function ()
{
	$('#confirm').click(function () {return confirm_delete('meeting date');});
});
</script>
{/literal}
</form>
{else}
<p>No record was found for this meeting.</p>
{/if}