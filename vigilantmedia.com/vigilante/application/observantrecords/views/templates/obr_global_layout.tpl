<!DOCTYPE html>
<html>
	<head lang="en-us">
		<title>Observant Records{if $page_title} &raquo; {$page_title}{/if}</title>
		<meta charset="utf-8" />
		<link rel="icon" href="/favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/screen.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/print.css" type="text/css" media="print" />
		<!--[if IE]><link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->
		<link rel="stylesheet" href="/css/layout.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="/css/typography.css" type="text/css" media="screen, projection" />
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.swfobject.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.swfobject.ext.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.validate.pack.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/modernizr-1.6.min.js"></script>
		<!--[if lt IE9]<script type="text/javascript" src="{$config.to_vigilante}/js/html5.js"></script>[/if]-->
	</head>

	<body>
		<div id="container" class="container">
			<div id="masthead" class="prepend-top">
				<header class="span-16 prepend-4 append-4 last">
					<a href="/"><img src="/images/observant_records_logo.png" alt="[Observant Records]" /></a>
				</header>
				
				<nav class="span-7 prepend-9 append-8 last">
					<ul id="nav-main">
						<li><a href="/index.php/news/">Blog</a></li>
						<li><a href="{$config.to_observantshop}/">Shop</a></li>
						<li><a href="/index.php/contact/">Contact</a></li>
					</ul>
				</nav>
			</div>
			
			<div id="content">
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
