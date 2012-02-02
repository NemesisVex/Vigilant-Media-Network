{*<form method="get" action="{$config.to_mt}/cgi-bin/mt/mt-search.cgi">
<strong>Search</strong><br>
<input type="hidden" name="IncludeBlogs" value="{$config.meisakuki_blog_id}" />
<input type="hidden" name="Template" value="meisakukisearch" />
<input id="search" name="search" size="20" />
<input type="submit" value="Go" />
</form>*}


<p><strong>Browse by year</strong><br>
{foreach item=archiveNav from=$archiveNav name=archive}
<a href="/index.php/news/archives/{$archiveNav}/">{$archiveNav}</a>
{if $smarty.foreach.archive.last==false} | {/if}
{/foreach}
</p>

<h3>{$displayDate}</h3>

<p>
{if $rsNews}
{foreach item=rsNews from=$rsNews}

<h3>{$rsNews->entry_title}</h3>

{parse_line_breaks txt=$rsNews->entry_text}
{if $rsNews->entry_text_more}
<p><strong><a href="/index.php/news/entry/{$rsNews->entry_id}/">Read the full article</a> ...</strong></p>
{/if}

<p><span class="smaller"><em>&#8212; Posted: <a href="/index.php/news/entry/{$rsNews->entry_id}/">{$rsNews->entry_created_on|date_format:"%Y-%m-%d %H:%M:%S"}</a></em></span></p>
{/foreach}
{else}
No entries written for this year.
{/if}
</p>

{if $page_links}
<p>
{$page_links}
</p>
{/if}