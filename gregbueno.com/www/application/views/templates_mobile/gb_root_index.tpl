{foreach item=rsEntry from=$rsEntries}
{assign var=blog_site_url value=$rsEntry->site_url|regex_replace:"/http\:\/\//":""|regex_replace:"/\/$/":""}
{assign var=site_url value="http://"|cat:$rsEntry->blog_site_url|regex_replace:"/\/\:\:/":$blog_site_url}
{assign var=entry_url value=$site_url|cat:"entry/"|cat:$rsEntry->entry_id|cat:"/"}

<header class="last source-label">
	<h3 class="source-title"><a href="{$site_url}">{$rsEntry->blog_name}</a></h3>
</header>

<article id="article-{$rsEntry->entry_id}">
	<div class="append-1">
		<time datetime="{$rsEntry->entry_authored_on|date_format:"%Y-%m-%dT%H:%M:%S-06:00"}" pubdate="pubdate">{$rsEntry->entry_authored_on|date_format:"%b %d, %Y %H:%M:%S"}</time>
	</div>

	<div class="prepend-top last">
		<header id="entry-header-{$rsEntry->entry_id}">
			<h3><a href="{$entry_url}">{$rsEntry->entry_title}</a></h3>
		</header>

{parse_line_breaks txt=$rsEntry->entry_text}

{if $rsEntry->entry_text_more}
		<p><a href="{$entry_url}">More</a> &raquo;</p>
{/if}
	</div>
</article>
{/foreach}
