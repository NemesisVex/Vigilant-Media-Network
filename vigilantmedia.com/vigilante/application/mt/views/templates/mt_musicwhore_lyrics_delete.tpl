<h4 class="admin_head">Lyric information</h4>

{if $rsLyric}
<form action="/index.php/musicwhore/lyrics/remove/{$lyric_id}/{$lyric_artist_id}/" method="post" name="album">

<p><span style="color: #F00"><strong>WARNING:</strong></span> Deleting a record will permanently remove it from the database. Deletions affect all related tables. You cannot undo deletions once they're performed.</p>

<p>Are you sure you want to delete the file <strong><em>{$rsLyric->lyric_file_name}</em></strong> <em>permanently</em> from the database?<br>

<p>
<input type="hidden" name="lyric_file_name" value="{$rsLyric->lyric_file_name}">
<input type="submit" id="confirm" name="confirm" value="Yes">
<input type="submit" name="confirm" value="No">
</p>


{literal}
<script type="text/javascript">
$(document).ready(function ()
{
	$('#confirm').click(function () {return confirm_delete('lyric');});
});
</script>
{/literal}
</form>
{else}
<p>No lyric file exists for this record.</p>
{/if}