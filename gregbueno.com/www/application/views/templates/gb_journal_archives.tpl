<form method="get" action="{$config.to_mt}/cgi-bin/mt/mt-search.cgi">
	<h5>Search</h5>
	<p>
		<input type="hidden" name="IncludeBlogs" value="{$blog_id}" />
		<input type="hidden" name="Template" value="journalsearch" />
		<input type="search" id="search" name="search" size="20" />
		<input type="submit" value="Go" />
	</p>
</form>

<h4>Browse by year</h4>

<nav>
	<p>
		<span class="archive-nav">
{foreach item=rsCalendar from=$rsCalendar name=archive}
			<a href="/index.php/journal/archives/date/{$rsCalendar->entry_year}/">{$rsCalendar->entry_year}</a>
{if $smarty.foreach.archive.last==false} | {/if}
{/foreach}
		</span>
	</p>
</nav>

<h3>{$entry_header}</h3>


<hr />

<nav>
{if $rsEntries}
{foreach item=rsEntry from=$rsEntries}
	<a href="/index.php/journal/entry/{$rsEntry->entry_id}/" title="{$rsEntry->entry_excerpt|escape:html}">{$rsEntry->entry_created_on|date_format:"%Y.%m.%d.%H:%M (%A)"}</a> [<a href="/index.php/journal/entry/{$rsEntry->entry_id}/#comments/">{if $rsEntry->comment_count}{$rsEntry->comment_count}{else}0{/if}</a>]<br>
{/foreach}
{else}
	No entries written for this year.
{/if}
</nav>
