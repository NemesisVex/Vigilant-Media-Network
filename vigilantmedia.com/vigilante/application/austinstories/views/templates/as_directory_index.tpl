<table class="bordered wide">
<tr>
	<th>SITE/AUTHOR</th>
	<th># OF POSTS</th>
	<th>RSS?</th>
</tr>
{foreach item=rsPost from=$rsPosts}
<tr>
	<td><strong><a href="{$rsPost->site_url}">{$rsPost->site_name}</a></strong> by {get_alias_name_object obj=$rsPost}</td>
	<td align="center">[{if $rsPost->portal_id}<a href="/index.php/directory/posts/{$rsPost->site_id}/">{$rsPost->PostNumber}</a>{else}0{/if}]</td>
	<td align="center">{if $rsPost->site_rss_feed}[<a href="/index.php/directory/feed/{$rsPost->site_id}/">yes</a>]{/if}</td>
</tr>
{/foreach}
</table>
