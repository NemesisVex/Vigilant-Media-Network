<h4 class="admin_head">Delete post</h4>

{if $rsPost}
<form action="/index.php/austinstories/post/remove/{$post_id}/{$site_user_id}/" method="post" name="post">

<p><span style="color: #F00"><strong>WARNING:</strong></span> Deleting a record will permanently remove it from the database. Deletions affect all related tables. You cannot undo deletions once they're performed.</p>

<p>Are you sure you want to delete <strong>{$rsPost->portal_headline}</strong> <em>permanently</em> from the database?<br>

<input type="hidden" name="portal_headline" value="{$rsPost->portal_headline}">
<input type="submit" id="confirm" name="confirm" value="Yes">
<input type="submit" name="confirm" value="No">
</p>


{literal}
<script type="text/javascript">
$(document).ready(function ()
{
	$('#confirm').click(function () {return confirm_delete('post');});
});
</script>
{/literal}
</form>
{else}
<p>No post was found for this record.</p>
{/if}
