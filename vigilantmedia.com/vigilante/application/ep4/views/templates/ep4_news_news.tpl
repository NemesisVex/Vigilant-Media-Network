				<div id="column-1" class="span-14 prepend-1 append-1">

					<header>
						<h2>Blog</h2>
					</header>

{if $rsNews}
					<section>
						<header>
							<h3>{$rsNews->entry_title}</h3>
						</header>

						<article>
{if $rsNews->entry_text}
{parse_line_breaks txt=$rsNews->entry_text}

{if $rsNews->entry_text_more}
{parse_line_breaks txt=$rsNews->entry_text_more}
{/if}

							<p>
								<em>&#8212; Posted <time datetime="{$rsNews->entry_authored_on|date_format:"%Y-%m-%dT%H:%M:%S-06:00"}" pubdate>{$rsNews->entry_authored_on|date_format:"%b %d, %Y %H:%M:%S"}</time></em>
							</p>
{/if}
						</article>
					<section>
{/if}
				</div>

				<div id="column-2" class="span-6 prepend-1 append-1 last">
					<header>
						<h3>More News</h3>
					</header>

					<ul>
						<li> <a href="/index.php/news/archives/">Archives</a></li>
						<li> <a href="{$config.to_gregbueno}/mt/eponymous4_index.xml" class="feed">RSS</a></li>
					</ul>
				</div>

				<script type="text/javascript" src="http://webplayer.yahooapis.com/player-beta.js"></script>