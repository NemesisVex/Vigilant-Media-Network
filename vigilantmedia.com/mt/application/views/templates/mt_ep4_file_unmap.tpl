<h4 class="admin_head">Warning</h4>

{if $rsProductMap}
<form action="/index.php/ep4/file/unmap_product/{$file_product_id}/" method="post" name="content-form">
	<input type="hidden" name="file_product_file_id" value="{$file_id}" />

	<p>Deleting a record will permanently remove it from the database. Deletions affect all related tables. You cannot undo deletions once they're performed.</p>

	<p>Are you sure you want to delete the map this mapping <em>permanently</em> from the database?<br>

	<p>
		<input type="submit" id="confirm" name="confirm" value="Yes" />
		<input type="submit" name="confirm" value="No" />
	</p>


</form>

{literal}
<script type="text/javascript">
$(document).ready(function ()
{
	$('#confirm').click(function () {return confirm_delete('product mapping');});
});
</script>
{/literal}
{else}
<p>No content map exists for this record.</p>
{/if}