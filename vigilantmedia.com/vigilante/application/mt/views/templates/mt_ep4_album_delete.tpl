<h4 class="admin_head">Album information</h4>

{if $rsAlbum}
<form action="/index.php/ep4/album/remove/{$album_id}/{$album_artist_id}/" method="post" name="album">
<p><span style="color: #F00"><strong>WARNING:</strong></span> Deleting a record will permanently remove it from the database. Deletions affect all related tables. You cannot undo deletions once they're performed.</p>

<p>Are you sure you want to delete <strong><em>{$rsAlbum->album_title}</em></strong> <em>permanently</em> from the database?<br>

<p>
<input type="hidden" name="album_title" value="{$rsAlbum->album_title}">
<input type="submit" id="confirm" name="confirm" value="Yes">
<input type="submit" name="confirm" value="No">
</p>


{literal}
<script type="text/javascript">
$(document).ready(function ()
{
	$('#confirm').click(function () {return confirm_delete('album');});
});
</script>
{/literal}
</form>
{else}
<p>No album exists for this record.</p>
{/if}