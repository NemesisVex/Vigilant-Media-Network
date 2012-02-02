{if $rsNews}
{foreach item=rsNews from=$rsNews}
<h3>{$rsNews->entry_title}</h3>

<div class="indent">
{parse_line_breaks txt=$rsNews->entry_text}
{if $rsNews->entry_text_more}
<p><strong><a href="/index.php/news/entry/{$rsNews->entry_id}/">Read the full article</a> ...</strong></p>
{/if}

<p><span style="font-size: smaller;"><em>&#8212; Posted: <a href="/index.php/news/entry/{$rsNews->entry_id}/">{$rsNews->entry_created_on|date_format:"%Y-%m-%d %H:%M:%S"}</a></em></span></p>
</div>
{/foreach}
{else}
<p>No entries written for this year.</p>
{/if}

{if $page_links}
<p>
{$page_links}
</p>
{/if}
