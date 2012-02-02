{if $rsEntries}
{foreach item=rsEntry from=$rsEntries}
<article>
	<header>
		<div class="last source-label">
			<h3 class="source-title"><a href="/index.php/vexvox/entry/{$rsEntry->entry_id}/">{$rsEntry->entry_title}</a></h3>
		</div>

		<div>
			<time datetime="{$rsEntry->entry_authored_on|date_format:"%Y-%m-%dT%H:%M:%S-06:00"}" pubdate="pubdate">
{$rsEntry->entry_authored_on|date_format:"%b %d, %Y %H:%M"}
			</time>

			<p>
				<em>By {$rsEntry->author_name}</em><br />
{if $rsEntry->category_id}Filed: <a href="/index.php/vexvox/category/{$rsEntry->category_id}/">{$rsEntry->category_label}</a><br>{/if}
{if $rsEntry->entry_allow_comments==1}<a href="/index.php/vexvox/entry/{$rsEntry->entry_id}/#comments">Comments</a> ({if $rsEntry->comment_count}{$rsEntry->comment_count}{else}0{/if}){/if}
			</p>
		</div>
	</header>


	<div class="prepend-top last">

{parse_line_breaks txt=$rsEntry->entry_text}
{if $rsEntry->entry_text_more}
		<p><strong><a href="/index.php/vexvox/entry/{$rsEntry->entry_id}/">MORE</a> ...</strong></p>
{/if}

	</div>
</article>
{/foreach}

{if $page_links}
<p>
{$page_links}
</p>
{/if}

<hr class="bottom-rule">
<div class="smaller">
	<p>Partially powered by <a href="http://www.movabletype.org/">Movable Type 5</a></p>
</div>
{/if}