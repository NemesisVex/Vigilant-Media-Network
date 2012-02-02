<p>The following posts matched the RSS feed entry you selected. [<a href="/index.php/help/topic/portal_rss/1/" class="help">Help</a>]</p>

<table class="bordered">
<tr>
	<th>OPTIONS</th>
	<th>POST</th>
	<th>STATUS</th>
</tr>
<tr>
	<td valign="top">
<form action="/index.php/members/post/rss/edit/" method="post" name="feed_item_{$a}">
[<a href="/index.php/members/post/edit/{$rsPost->portal_id}/">Edit</a>]
[<a href="javascript:" class="add_item">Replace</a>]
[<a href="/index.php/members/post/delete/{$rsPost->portal_id}/">Delete</a>]
{foreach key=field item=value from=$smarty.post}
<input type="hidden" name="{$field}" value="{$value|escape:"html"}">
{/foreach}
<input type="hidden" name="portal_id" value="{$rsPost->portal_id}">
<input type="hidden" name="replace_entry" value="1">
</form>
	</td>
	<td valign="top"><strong><a href="{$rsPost->portal_url}">{$rsPost->portal_headline}</a></strong></td>
	<td valign="top">{if $rsPost->portal_publish_status==1}published{else}<strong>unpublished</strong>{/if}</td>
</tr>
</table>

<script type="text/javascript">
{literal}
$(document).ready(function ()
{
	$('a[class=add_item]').click(function () {this.parentNode.submit();});
});
{/literal}
</script>
