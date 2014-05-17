<h4 class="admin_head">Content administration</h4>

{if $rsContent}
<form action="/index.php/musicwhore/content/remove/{$content_id}/{$artist_id}/" method="post" name="album">

<p><span style="color: #F00"><strong>WARNING:</strong></span> Deleting a record will permanently remove it from the database. Deletions affect all related tables. You cannot undo deletions once they're performed.</p>

<p>Are you sure you want to delete the map this mapping <em>permanently</em> from the database?<br>

<p>
<input type="hidden" name="entry_id" value="{$rsContent->content_entry_id}">
<input type="submit" id="confirm" name="confirm" value="Yes">
<input type="submit" name="confirm" value="No">
</p>


{literal}
<script type="text/javascript">
$(document).ready(function ()
{
	$('#confirm').click(function () {return confirm_delete('content map');});
});
</script>
{/literal}
</form>
{else}
<p>No content map exists for this record.</p>
{/if}