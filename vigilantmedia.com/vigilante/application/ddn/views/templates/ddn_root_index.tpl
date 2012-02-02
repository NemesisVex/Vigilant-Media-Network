<h1>Lastest news</h1>

{if $rsNewsItems}
{foreach item=rsNews from=$rsNewsItems}
<h2>{$rsNews->entry_title}</h2>

{if $rsNews->entry_text}
{parse_line_breaks txt=$rsNews->entry_text}

{if $rsNews->entry_text_more}
{parse_line_breaks txt=$rsNews->entry_text_more}
{/if}

<p><span class="attribution"><em>-- Posted: <a href="/index.php/news/entry/{$rsNews->entry_id}/">{$rsNews->entry_created_on|date_format:"%Y-%m-%d %H:%M:%S"}</a></em></span></p>
{/if}
{/foreach}

{/if}
