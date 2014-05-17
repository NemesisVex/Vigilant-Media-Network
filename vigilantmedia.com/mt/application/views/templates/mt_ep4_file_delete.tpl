<h4 class="admin_head">Warning</h4>

{if $rsFile}
<form action="/index.php/ep4/file/remove/{$file_id}/" method="post" name="album">

	<p>Deleting a record will permanently remove it from the database. Deletions affect all related tables. You cannot undo deletions once they're performed.</p>
	
	<p>The associated file will also be removed from the file system.</p>

	<p>Are you sure you want to delete <strong><em>{$rsFile->file_path}/{$rsFile->file_name}</em></strong> <em>permanently</em> from the database?<br>

	<p>
		<input type="hidden" name="file_path" value="{$rsFile->file_path}/{$rsFile->file_name}" />
		<input type="submit" id="confirm" name="confirm" value="Yes" />
		<input type="submit" name="confirm" value="No" />
	</p>
</form>

{literal}
<script type="text/javascript">
$(document).ready(function ()
{
	$('#confirm').click(function () {return confirm_delete('song');});
});
</script>
{/literal}
{else}
<p>No file exists for this record.</p>
{/if}