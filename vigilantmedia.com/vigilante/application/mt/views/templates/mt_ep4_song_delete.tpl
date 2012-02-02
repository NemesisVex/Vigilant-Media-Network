<h4 class="admin_head">Warning</h4>

{if $rsSong}
<form action="/index.php/ep4/song/remove/{$song_id}/" method="post" name="album">

	<p>Deleting a record will permanently remove it from the database. Deletions affect all related tables. You cannot undo deletions once they're performed.</p>

	<p>Are you sure you want to delete <strong><em>{$rsSong->song_title}</em></strong> <em>permanently</em> from the database?<br>

	<p>
		<input type="hidden" name="song_title" value="{$rsSong->song_title}" />
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
<p>No song exists for this record.</p>
{/if}