<!DOCTYPE html>
<html>
	<head>
		<title>eponymous 4{if $page_title} &raquo; {$page_title}{/if}</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, intial-scale=1.0" />
		<link rel="alternate" type="application/rss+xml" title="Eponymous 4 News" href="http://www.gregbueno.com/mt/eponymous4_index.xml" />
		<link rel="icon" href="/favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/screen.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/print.css" type="text/css" media="print" />
		<!--[if IE]><link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->
		<link rel="stylesheet" href="/css/eponymous4.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="/css/eponymous4_mobile.css" type="text/css" media="screen" />
		<!--[if IE]><link rel="stylesheet" href="/css/eponymous4_ie.css" type="text/css" media="screen, projection" /><![endif]-->
		<link rel="stylesheet" href="/css/restraint.css" type="text/css" media="screen" />
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.swfobject.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.swfobject.ext.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.validate.pack.js"></script>
		<script type="text/javascript" src="/js/eponymous4.js"></script>
		<script type="text/javascript" src="/js/swfobject_eponymous4.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/modernizr-1.6.min.js"></script>
		<!--[if lt IE9]<script type="text/javascript" src="{$config.to_vigilante}/js/html5.js"></script>[/if]-->
	</head>

	<body>
		<div id="masthead" class="last">
			<h1 id="title"><a href="/">eponymous 4</a></h1>
			<nav>
					<a href="/index.php/news/">news</a> &#8226;
					<a href="/index.php/bio/">bio</a> &#8226;
					<a href="/index.php/music/">music</a> &#8226;
					<a href="/index.php/music/video/">video</a> &#8226;
					<a href="/index.php/contact/">contact</a><br>
{if $smarty.const.ENVIRONMENT!="production"}
					<span class="smaller">
						<a href="http://eponymous4{$smarty.server.REQUEST_URI}">DEV</a> &#8226;
						<a href="http://test.eponymous4.com{$smarty.server.REQUEST_URI}">TEST</a> &#8226;
						<a href="http://www.eponymous4.com{$smarty.server.REQUEST_URI}">PROD</a>
					</span>
{/if}
			</nav>
		</div>

		<div id="content" class="prepend-1 append-1 last">
			<div class="prepend-top">
{if $section_head}<h1>{$section_head}</h1>{/if}

{if $section_label}<h2>{$section_label}</h2>{/if}

{if $content_template}{include file=$content_template}{/if}
			</div>
		</div>

{literal}
		<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
		try {
		var pageTracker = _gat._getTracker("UA-7828220-2");
		pageTracker._trackPageview();
		} catch(err) {}
		</script>
{/literal}


	</body>
</html>
