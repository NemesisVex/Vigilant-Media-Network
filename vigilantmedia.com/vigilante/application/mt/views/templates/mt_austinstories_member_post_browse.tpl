<h4 class="admin_head">Post information</h4>

{if $rsPosts}
<form action="/index.php/austinstories/post/remove/" method="post" name="posts">


{literal}
<script type="text/javascript">
$(document).ready(function()
{
	$("#portal_ids").click(function()				
	{
		var checked_status = this.checked;
		$(".portal_id").each( function()
		{
			this.checked = checked_status;
		});
	});
});
</script>
{/literal}


<table class="Admin_Wide">
<tr>
	<th>HEADLINE</th>
	<th>DATE POSTED</th>
	<th>SITE</th>
	<th>PUBLISH STATUS</th>
	<th>OPTIONS</th>
	<th></th>
</tr>
{foreach item=rsPost from=$rsPosts}
<tr>
	<td><a href="{$rsPost->portal_url}">{$rsPost->portal_headline}</a></td>
	<td>{$rsPost->portal_date_added|date_format:"%m/%d/%Y %H:%M:%S"}</td>
	<td>{$rsPost->site_name}</td>
	<td>{if $rsPost->portal_publish_status==1}published{else}unpublished{/if}</td>
	<td>[<a href="/index.php/austinstories/post/edit/{$rsPost->portal_id}/{$site_user_id}/">Edit</a>]&nbsp;[<a href="/index.php/austinstories/post/delete/{$rsPost->portal_id}/{$site_user_id}/">Delete</a>]</td>
	<td><input type="checkbox" class="portal_id" name="portal_id[]" value="{$rsPost->portal_id}"></td>
</tr>
{/foreach}
</table>

<p><input type="checkbox" id="portal_ids"> Select all</p>


<p>
<input type="hidden" name="site_user_id" value="{$site_user_id}">
<input type="submit" value="Delete checked posts">
</p>

{if $page_links}
<p>{$page_links}</p>
{/if}

</form>
{else}
<p>This user has made no posts.</p>
{/if}
