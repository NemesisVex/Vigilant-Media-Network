<!DOCTYPE html>
<html lang="en">
	<head>
		<title>名作記{if $page_title}: {$page_title}{/if}</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="alternate" type="application/rss+xml" title="名作記 RSS" href="http://www.gregbueno.com/mt/meisakuki_index.xml" />
		<link rel="icon" href="/images/meisakuki.ico" type="image/vnd.microsoft.icon" />
		<link rel="shortcut icon" href="/images/meisakuki.ico" type="image/x-icon" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/screen.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/print.css" type="text/css" media="print" />
		<!--[if IE]><link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->
		<link rel="stylesheet" href="/css/greg.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="/css/greg_mobile.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="/css/meisakuki_blueprint.css" type="text/css" />
		<link rel="stylesheet" href="/css/meisakuki_blueprint_mobile.css" type="text/css" />
		<script type="text/javascript" src="{$config.to_vigilante}/js/modernizr-1.6.min.js"></script>
		<!--[if lt IE9]<script type="text/javascript" src="{$config.to_vigilante}/js/html5.js"></script>[/if]-->
	</head>

	<body>
		<div id="container">

			<div id="frame-1">
				<div id="masthead" class="prepend-1 append-1 append-bottom">
					<header>
						<h1 id="title"><a href="/index.php/meisakuki/">名作記</a></h1>
					</header>
				</div>

				<div class="append-1 prepend-1">
{if $section_head}<header>{/if}
{if $section_label}<hgroup>{/if}
{if $section_head}<h1>{$section_head}</h1>{/if}
{if $section_label}<h2>{$section_label}</h2>{/if}
{if $section_label}</hgroup>{/if}
{if $section_head}</header>{/if}

{if $content_template}{include file=$content_template}{/if}

				</div>
			</div>

			<div id="frame-2" class="prepend-top last">

				<h3>About this weblog</h3>

				<p>
					「名作記」 is pronounced &quot;meisakuki&quot;, and it means &quot;masterpiece chronicle&quot; in Japanese. Yes, this title is meant to be an exaggeration.
				</p>

				<p>This site is my &quot;creative scrapbook&quot;, a place where I jot down ideas for creative projects. Mostly, I write about my music project, <a href="{$config.to_eponymous4}">Eponymous 4</a>, but I also might mention other writing endeavors.</p>

				<nav>
					<ul>
						<li> <a href="/index.php/gb/contact/">Contact</a></li>
						<li> <a href="/">Gregbueno.com</a></li>
					</ul>
				</nav>

				<p><a href="/mt/meisakuki_index.xml"><img src="/images/rss_button.gif" alt="[RSS]" width="36" height="14" title="[RSS]" /></a></p>

				<hr />

				<h3>Search</h3>

				<form method="get" action="{$config.to_mt}/cgi-bin/mt/mt-search.cgi">
					<p>
						<input type="hidden" name="IncludeBlogs" value="{$blog_id}" />
						<input type="hidden" name="Template" value="meisakukisearch" />
						<input type="search" id="search" name="search" size="20" />
						<input type="submit" value="Go" />
					</p>
				</form>

				<hr>

				<h3>Calendar</h3>

				<nav>
					<ul>
{foreach item=rsCalendar from=$rsCalendar name=archive}
						<li> <a href="/index.php/meisakuki/date/{$rsCalendar->entry_year}/">{$rsCalendar->entry_year}</a></li>
{/foreach}
					</ul>
				</nav>


				<hr />

{include file=gb_root__links.tpl}

			</div>

		</div>


		<script type="text/javascript" src="http://track3.mybloglog.com/js/jsserv.php?mblID=2006120810441128"></script>
{literal}
		<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
		try {
		var pageTracker = _gat._getTracker("UA-7828220-5");
		pageTracker._trackPageview();
		} catch(err) {}
		</script>
{/literal}

	</body>
</html>
