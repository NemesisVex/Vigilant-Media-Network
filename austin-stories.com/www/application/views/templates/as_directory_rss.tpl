{if $rsSite->site_rss_feed}<p>[<a href="{$rsSite->site_rss_feed}">View raw RSS</a>]</p>{/if}

{if $items}
{foreach item=item from=$items}
<p><span class="headline"><a href="{$item.link}">{$item.title}</a></span><br>
{if $item.description}
{$item.description}<br>
{elseif $item.atom_content}
{$item.atom_content}
{elseif $item.content}
{foreach key=tag item=content from=$item.content}
{$content|regex_replace:"/<br ><\/br>/":"<br>"}
{/foreach}<br>
{elseif $item.summary}
{$item.summary}
{/if}
{if $item.date_timestamp}
<span style="font-size: smaller;"><em>-- posted {$item.date_timestamp|date_format:"%m/%d/%Y %H:%M:%S"}</em></span><br>
{elseif $item.published}
<span style="font-size: smaller;"><em>-- posted {$item.published|date_format:"%m/%d/%Y %H:%M:%S"}</em></span><br>
{/if}
</p>
{/foreach}
{else}
<p>This site has no RSS feeds available.</p>
{/if}
