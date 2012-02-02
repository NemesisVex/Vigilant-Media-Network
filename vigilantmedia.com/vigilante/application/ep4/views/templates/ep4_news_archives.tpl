				<div id="column-1" class="span-14 prepend-1 append-1">
					<hgroup>
						<header>
							<h2>Blog</h2>
						</header>
						<header>
							<h3>{$displayDate}</h3>
						</header>
					</hgroup>
							
{if $rsNews}
{foreach item=rsNewsItem from=$rsNews}
					<section>
						<header>
							<h3>{$rsNewsItem->entry_title}</h3>
						</header>

						<article>
{parse_line_breaks txt=$rsNewsItem->entry_text}

{if $rsNewsItem->entry_text_more}
							<p>
								<a href="/index.php/news/entry/{$rsNewsItem->entry_id}/">MORE</a> &raquo;
							</p>
{/if}

							<p>
								&#8212; <em>Posted <time datetime="{$rsNewsItem->entry_authored_on|date_format:"%Y-%m-%dT%H:%M:%S-06:00"}" pubdate><a href="/index.php/news/entry/{$rsNewsItem->entry_id}/">{$rsNewsItem->entry_authored_on|date_format:"%b %d, %Y %H:%M:%S"}</a></time></em>
							</p>
						</article>
					</section>
{/foreach}
{else}
No entries written for this year.
{/if}

{if $page_links}
<p>
{$page_links}
</p>
{/if}
				</div>

				<div id="column-2" class="span-6 prepend-1 append-1 last">
					<header>
						<h3>Browse by year</h3>
					</header>
					
					<ul>
{foreach item=archiveNav from=$archiveNav name=archive}
						<li><a href="/index.php/news/archives/{$archiveNav}/">{$archiveNav}</a></li>
{/foreach}
					</ul>

{*<form method="get" action="{$config.to_mt}/cgi-bin/mt/mt-search.cgi">
<strong>Search</strong><br>
<input type="hidden" name="IncludeBlogs" value="{$config.meisakuki_blog_id}" />
<input type="hidden" name="Template" value="meisakukisearch" />
<input id="search" name="search" size="20" />
<input type="submit" value="Go" />
</form>*}


				</div>

				<script type="text/javascript" src="http://webplayer.yahooapis.com/player-beta.js"></script>