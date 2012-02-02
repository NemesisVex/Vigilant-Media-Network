<p>
<a href="/index.php/news/archives/">Archives</a> |
<a href="{$config.to_gregbueno}/mt/eponymous4_index.xml" class="feed">RSS</a>
</p>

{foreach item=rsNews from=$rsNews}
<h3>{$rsNews->entry_title}</h3>

{parse_line_breaks txt=$rsNews->entry_text}
{if $rsNews->entry_text_more}
<p><strong><a href="/index.php/news/entry/{$rsNews->entry_id}/">Read the full article</a> ...</strong></p>
{/if}

<p><span class="smaller"><em>&#8212; Posted: <a href="/index.php/news/entry/{$rsNews->entry_id}/">{$rsNews->entry_created_on|date_format:"%Y-%m-%d %H:%M:%S"}</a></em></span></p>
{/foreach}

{if $page_links}
<p>
{$page_links}
</p>
{/if}