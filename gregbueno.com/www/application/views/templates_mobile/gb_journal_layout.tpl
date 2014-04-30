<!DOCTYPE html>
<html lang="en">
	<head>
		<title>日々の本{if $page_title}: {$page_title}{/if}</title>
		<meta charset="utf-8" />
		<link rel="alternate" type="application/rss+xml" title="日々の本 RSS" href="http://www.gregbueno.com/mt/journal_index.xml" />
		<link rel="icon" href="/images/journal.ico" type="image/vnd.microsoft.icon" />
		<link rel="shortcut icon" href="/images/journal.ico" type="image/x-icon" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/screen.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/print.css" type="text/css" media="print" />
		<!--[if lt IE 8]><link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->
		<link rel="stylesheet" href="/css/global.css" type="text/css" />
		<link rel="stylesheet" href="/css/blog.css" type="text/css" />
		<link rel="stylesheet" href="/css/journal.css" type="text/css" />
		<script type="text/javascript" src="{$config.to_vigilante}/js/modernizr-1.6.min.js"></script>
		<!--[if lt IE 9]><script type="text/javascript" src="{$config.to_vigilante}/js/html5.js"></script><![endif]-->
	</head>

	<body>
		<!-- ukey="7EB125F6" -->
		<div id="container" class="container">

			<div id="masthead" class="span-18 last">
				<header>
					<h1 id="title"><a href="/index.php/journal/">&#26085;&#12293;&#12398;&#26412;</a></h1>
				</header>
			</div>

			<div id="top-navigation" class="span-18 last">
				<nav>
					<a href="/index.php/journal/archives/">archives</a> &#8226;
					<a href="/index.php/journal/about/">history</a> &#8226;
					<a href="/index.php/journal/cast/">cast</a> &#8226;
					<a href="/index.php/journal/links/">links</a> &#8226;
					<a href="/index.php/members/">members</a> &#8226;
					<a href="/index.php/journal/contact/">contact</a> &#8226;&#8226;
					<a href="/index.php/sakufu/">&#20316;&#35676;</a> &#8226;
					<a href="/index.php/meisakuki/">&#21517;&#20316;&#35352;</a> &#8226;&#8226;
					<a href="/mt/journal_index.xml" class="feed">RSS</a>
				</nav>
			</div>

			<div id="content" class="span-16 prepend-1 append-1 last">
				<div class="prepend-top append-bottom">
{if $section_head}
					<header>
						<h1>{$section_head}</h1>
					</header>
{/if}

{if $content_template}{include file=$content_template}{/if}

				</div>
			</div>
		</div>

		<div class="container">

			<div id="bottom-nav">
{include file=gb_journal_home_box.tpl}

				<p>
{if $smarty.const.ENVIRONMENT!="production"}
					<a href="http://gbueno{$smarty.server.REQUEST_URI}">DEV</a> &middot;
					<a href="http://test.gregbueno.com{$smarty.server.REQUEST_URI}">TEST</a> &middot;
					<a href="http://www.gregbueno.com{$smarty.server.REQUEST_URI}">PROD</a><br>
{/if}
					<a href="/">gregbueno.com</a>
				</p>
			</div>
		</div>

		<script type="text/javascript" src="http://track3.mybloglog.com/js/jsserv.php?mblID=2007011712430363"></script>
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
