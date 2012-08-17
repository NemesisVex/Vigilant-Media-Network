			<div id="column-1" class="span-15 append-1">
{include file=obr_global_header.tpl}
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
{/foreach}

						<p>
							<a href="/index.php/news/">More news</a> &raquo;
						</p>
{else}
					<p>
						No blog entries yet published.
					</p>
{/if}


			</div>

			<div id="column-2" class="span-8 last">
				<div id="bandcamp_player">[]</div>

			{literal}
				<script type="text/javascript">
					$(function () {$ep4($('#bandcamp_player')[0]).bandcamp_widget(1800954785, 'tall2', 'FFFFFF', '304B75', 450, 150, 'FFFFFF');});
				</script>
			{/literal}

			</div>
