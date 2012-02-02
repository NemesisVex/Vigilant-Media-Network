<!--[if lte IE 6]>
<div id="ie6">
<a href="#ie6_warning" rel="facebox"></a>
<div id="ie6_warning">
<h1>Please upgrade your browser</h1>

<p>Sorry for the inconvenience, but Internet Explorer 6 doesn't really work with the Eponymous 4 official website.</p>

<p>You can get the best results by upgrading your browser.</p>

<ul>
<li> <a href="http://www.mozilla.com/">Mozilla Firefox</a></li>
<li> <a href="http://www.microsoft.com/Windows/internet-explorer/">Microsoft Internet Explorer 8</a></li>
<li> <a href="http://www.google.com/chrome">Google Chrome</a></li>
<li> <a href="http://www.opera.com/">Opera</a></li>
<li> <a href="http://www.apple.com/safari/">Safari</a></li>
</ul>
</div>
</div>
<![endif]-->

<h1>latest</h1>

{if $rsNews}
<h2>news</h2>

{foreach item=rsNewsItem from=$rsNews}
<article>
	<header>
		<h3>{$rsNewsItem->entry_title}</h3>
	</header>

{parse_line_breaks txt=$rsNewsItem->entry_text}

	<p>
{if $rsNewsItem->entry_text_more}<a href="/index.php/news/entry/{$rsNewsItem->entry_id}/">MORE</a><br>{/if}
		<span class="smaller">&#8212; <em>Posted <time datetime="{$rsNewsItem->entry_created_on|date_format:"%Y-%m-%dT%H:%M:%S-06:00"}" pubdate><a href="/index.php/news/entry/{$rsNewsItem->entry_id}/">{$rsNewsItem->entry_created_on|date_format:"%b %d, %Y %H:%M:%S"}</a></time></em></span>
	</p>
</article>
{/foreach}

<p>
	<a href="/index.php/news/">More news</a> &raquo;
</p>
{/if}

