<h4 class="admin_head">Release information</h4>

{if $rsRelease}
<form action="/index.php/musicwhore/release/remove/{$release_id}/{$album_artist_id}/" method="post" name="album_details">

<p><span style="color: #F00"><strong>WARNING:</strong></span> Deleting a record will permanently remove it from the database. Deletions affect all related tables. You cannot undo deletions once they're performed.</p>

<p>Are you sure you want to delete the <strong>{$rsRelease->format_name}</strong> of <strong><em>{$rsRelease->album_title}</em></strong> <em>permanently</em> from the database?</p>

<p>
<input type="hidden" name="album_title" value="{$rsRelease->album_title}">
<input type="hidden" name="format_name" value="{$rsRelease->format_name}">
<input type="submit" id="confirm" name="confirm" value="Yes">
<input type="submit" name="confirm" value="No">
</p>


{literal}
<script type="text/javascript">
$(document).ready(function ()
{
	$('#confirm').click(function () {return confirm_delete('release');});
});
</script>
{/literal}
</form>
{else}
<p>No release exists for this record.</p>
{/if}