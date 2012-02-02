{if $rsEntries}

{foreach key=e item=rsEntry from=$rsEntries}
<h3><a href="/index.php/tw/entry/{$rsEntry->entry_id}/">{$rsEntry->entry_title}</a></h3>

<div class="indent">
{parse_line_breaks txt=$rsEntry->entry_text}

{if $rsEntry->entry_text_more}
<p><a href="/index.php/tw/entry/{$rsEntry->entry_id}/">More</a> &gt;&gt;</p>
{/if}
</div>

<p>
<span class="attribution">
<em>&#8212; posted by {$rsEntry->author_name} on <a href="/index.php/tw/entry/{$rsEntry->entry_id}/">{$rsEntry->entry_created_on|date_format:"%Y-%m-%d %H:%M:%S"}</a>{if $rsEntry->category_id} | File under: <a href="/index.php/tw/category/{$rsEntry->category_id}/">{$rsEntry->category_label}</a>{/if}{if $rsEntry->entry_allow_comments==1} | <a href="/index.php/tw/entry/{$rsEntry->entry_id}/#comments">Comments</a> ({if $rsEntry->comment_count}{$rsEntry->comment_count}{else}0{/if}){/if}</em>
</span>
</p>
{/foreach}

{if $page_links}
<p>
{$page_links}
</p>
{/if}

{else}
<p>No entries available yet.</p>
{/if}
