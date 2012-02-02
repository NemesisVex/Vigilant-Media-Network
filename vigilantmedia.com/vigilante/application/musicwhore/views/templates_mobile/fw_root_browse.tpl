{if $rsEntries}

{if $rsDates}
{$rsDates[0]->entry_year}:
{foreach item=rsDate from=$rsDates}
<a href="/index.php/fw/date/{$rsDate->entry_month}/{$rsDate->entry_year}/">{$rsDate->entry_month|string_format:"%02s"}</a>
{/foreach}
{/if}

{if $page_links}
<p>
	More results: {$page_links}
</p>
{/if}

{foreach key=e item=rsEntry from=$rsEntries}
<h3><a href="/index.php/fw/entry/{$rsEntry->entry_id}/">{$rsEntry->entry_title}</a></h3>

<div class="indent">
{parse_line_breaks txt=$rsEntry->entry_text}

{if $rsEntry->entry_text_more}
	<p><a href="/index.php/fw/entry/{$rsEntry->entry_id}/">More</a> &gt;&gt;</p>
{/if}
</div>

<p>
	<span class="attribution">
		<em>-- posted by {$rsEntry->author_name} on <a href="/index.php/fw/entry/{$rsEntry->entry_id}/">{$rsEntry->entry_created_on|date_format:"%Y-%m-%d %H:%M:%S"}</a>{if $rsEntry->category_id} | File under: <a href="/index.php/fw/category/{$rsEntry->category_id}/">{$rsEntry->category_label}</a>{/if}</em>
	</span>
</p>
{/foreach}


{if $page_links}
<p>
	More results: {$page_links}
</p>
{/if}

{else}
<p>No entries available yet.</p>
{/if}
