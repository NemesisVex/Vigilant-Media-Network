<!DOCTYPE html>
<html>
	<head>
		<title>Vigilant Media{if $page_title} &#8212; {$page_title}{/if}</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/screen.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/print.css" type="text/css" media="print" />
		<!--[if IE]><link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->
		<link rel="stylesheet" href="/css/vigilantmedia.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="/css/vigilantmedia_mobile.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="/js/ui/css/jquery-ui.css" type="text/css" media="screen, projection" />
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/ui/js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/modernizr-1.6.min.js"></script>
		<!--[if lt IE9]<script type="text/javascript" src="{$config.to_vigilante}/js/html5.js"></script>[/if]-->
	</head>

	<body>

		<header id="masthead">
			<hgroup>
				<h1 id="title">Vigilant Media</h1>
				<h3 id="subtitle">The online portfolio of Greg Bueno</h3>
			</hgroup>
		</header>

		<div id="content">
			<nav id="frame-1" class="prepend-1 append-1 prepend-top">
				<ul id="main-nav">
					<li{if $smarty.server.REQUEST_URI=="/"} class="nav-current-page"{/if}><a href="/">about greg</a></li>
					<li{if preg_match("/portfolio/", $smarty.server.REQUEST_URI)} class="nav-current-page"{/if}><a href="/index.php/vm/portfolio/">portfolio</a></li>
					<li{if preg_match("/resume/", $smarty.server.REQUEST_URI)} class="nav-current-page"{/if}><a href="/index.php/vm/resume/">résumé</a></li>
					<li{if preg_match("/contact/", $smarty.server.REQUEST_URI)} class="nav-current-page"{/if}><a href="/index.php/vm/contact/">contact</a></li>
				</ul>
			</nav>
			<!--CONTENT START-->
{if $content_template}{include file=$content_template}{/if}
			<!--CONTENT END-->
		</div>
	</div>

{literal}
	<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));

	try
	{
		var pageTracker = _gat._getTracker("UA-7828220-7");
		pageTracker._trackPageview();
	} catch(err) {}
	</script>
{/literal}

</body>
</html>
