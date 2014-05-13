{if $rsPost}
<form action="/index.php/members/post/remove/{$post_id}/" method="post" name="post">

<p><span style="color: #F99;"><strong>WARNING:</strong></span> Deleting an entry will permanently remove it from the database. You cannot undo deletions once they're performed. [<a href="/index.php/help/topic/account_delete/1/" class="help">More info</a>]</p>

<p>Are you sure you want to delete this entry <em>permanently</em> from the database?</p>

<table class="bordered wide">
<tr>
	<td valign="top"><strong>Headline:</strong></td>
	<td valign="top"><strong><a href="{$rsPost->portal_url}">{$rsPost->portal_headline}</a></strong></td>
</tr>
<tr>
	<td valign="top"><strong>Post date:</strong></td>
	<td valign="top">{$rsPost->portal_date_added|date_format:"%m/%d/%Y %I:%M %p"}</td>
</tr>
<tr>
	<td valign="top"><strong>Text:</strong></td>
	<td valign="top">{parse_line_breaks txt=$rsPost->portal_body_text}</td>
</tr>
</table>

<p>
<input type="hidden" name="portal_headline" value="{$rsPost->portal_headline}">
<input type="submit" id="confirm" name="confirm" value="Yes">
<input type="submit" name="confirm" value="No">
</p>

<script type="text/javascript">
{literal}
$(document).ready(function ()
{
	$('#confirm').click(function () {return confirm_delete('post');});
});
{/literal}
</script>
</form>
{else}
<p>No post was found for this record.</p>
{/if}
