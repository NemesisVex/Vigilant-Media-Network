<p>You can create a post based on your RSS or Atom feeds. [<a href="/index.php/help/topic/portal_rss/1/" class="help">Help</a>]</p>

{if $feeds}
<p>Click <strong>Add</strong> next to the RSS entry you wish to post, and the portal submission form will be pre-populated with the RSS content.</p>

<table class="bordered">
<tr>
	<th>OPTIONS</th>
	<th>POST</th>
	<th>SITE</th>
</tr>
{assign var=e value=0}
{foreach key=a item=feeds from=$feeds}
{assign var=channel value=$feeds->channel}
{foreach item=feed_item from=$feeds->items name=feed_items}
<tr>
	<td>
<form action="/index.php/members/post/rss/add/" method="post" name="feed_item_{$e}" id="feed_item_{$e}">
<input type="hidden" name="portal_headline" value="{$feed_item.title|escape:"html"}" size=40>
<input type="hidden" name="portal_url" value="{$feed_item.link}" size=40>
<input type="hidden" name="portal_body_text" value="{if $feed_item.description}{$feed_item.description|escape:"html"}{elseif $feed_item.atom_content}{$feed_item.atom_content|escape:"html"}{/if}" size=40>
<input type="hidden" name="portal_user_id" value="{$site_user_id}">
<input type="hidden" name="portal_site_id" value="{$site_ids.$a}">
[<a href="javascript:" class="add_item">Add</a>]
</form>
	</td>
	<td><strong><a href="{$feed_item.link}">{$feed_item.title}</a></strong></td>
	<td><a href="{$channel.link}">{$channel.title}</a></td>
</tr>
{assign var=e value=$e+1}
{/foreach}
{/foreach}
</table>

<script type="text/javascript">
{literal}
$(document).ready(function ()
{
	$('a[class=add_item]').click(function () {this.parentNode.submit();});
});
{/literal}
</script>

{else}
<p>To enable this function, <a href="/members/sites.php?userID=1">edit your site information</a> to include the URL of your RSS or Atom feed in the <strong>URL for syndication feed</strong> field.</p>

{/if}
