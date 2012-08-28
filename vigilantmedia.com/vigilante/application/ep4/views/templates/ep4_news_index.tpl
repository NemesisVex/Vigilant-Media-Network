				<div id="column-1">

					<header>
						<h2>Blog</h2>
					</header>

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

{if $page_links}
	<p>
{$page_links}
	</p>
{/if}
				</div>

				<div id="column-2">
					<header>
						<h3>More News</h3>
					</header>

					<ul>
						<li> <a href="/index.php/news/archives/">Archives</a></li>
						<li> <a href="/index.xml" class="feed">RSS</a></li>
					</ul>
				</div>
					
				<script type="text/javascript" src="http://webplayer.yahooapis.com/player-beta.js"></script>