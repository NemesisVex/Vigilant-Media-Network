<h4 class="admin_head">Warning</h4>

{if $rsAudio}
<form action="/index.php/ep4/audio/remove/{$audio_id}/{$audio_artist_id}/" method="post" name="album">
	<p>Deleting a record will permanently remove it from the database. Deletions affect all related tables. You cannot undo deletions once they're performed.</p>

	<p>Are you sure you want to delete the file <strong><em>{$rsAudio->audio_mp3_file_name}</em></strong> <em>permanently</em> from the database?<br>

	<p>
		<input type="hidden" name="audio_mp3_file_name" value="{$rsAudio->audio_mp3_file_name}" />
		<input type="submit" id="confirm" name="confirm" value="Yes" />
		<input type="submit" name="confirm" value="No" />
	</p>
</form>


{literal}
<script type="text/javascript">
$(document).ready(function ()
{
	$('#confirm').click(function () {return confirm_delete('audio file');});
});
</script>
{/literal}
{else}
<p>No audio file exists for this record.</p>
{/if}