<!DOCTYPE html>
<html>
	<head>
		<title>Vigilant Media{if $page_title} &#8212; {$page_title}{/if}</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/screen.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/print.css" type="text/css" media="print" />
		<!--[if IE]><link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->
		<link rel="stylesheet" href="{$config.to_vigilante}/css/facebox.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="/css/vigilantmedia.css" type="text/css" media="screen, projection" />
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/modernizr-1.6.min.js"></script>
		<!--[if lt IE9]<script type="text/javascript" src="{$config.to_vigilante}/js/html5.js"></script>[/if]-->
	</head>

	<body>

		<header id="masthead">
			<div class="container">

				<hgroup id="masthead-left" class="span-12">
					<h1 id="title">Vigilant Media</h1>
					<h3 id="subtitle">The online portfolio of Greg Bueno</h3>
				</hgroup>

				<nav id="masthead-right" class="span-12 prepend-top last">
{if $smarty.const.ENVIRONMENT!="prod"}
					<span class="smaller">
{if $smarty.const.ENVIRONMENT=="dev"}
						<strong>&raquo;</strong>
{else}
						&#8226;
{/if}
						<a href="http://vigilantmedia{$smarty.server.REQUEST_URI}">DEV</a>
{if $smarty.const.ENVIRONMENT=="test"}
						<strong>&raquo;</strong>
{else}
						&#8226;
{/if}
						<a href="http://test.vigilantmedia.com{$smarty.server.REQUEST_URI}">TEST</a>
						&#8226; <a href="http://www.vigilantmedia.com{$smarty.server.REQUEST_URI}">PROD</a>
					</span>
{/if}
{if $smarty.server.REQUEST_URI=="/"}
					<strong>&raquo;</strong>
{else}
					&#8226;
{/if}
					<a href="/">portfolio</a>
{if preg_match("/resume/", $smarty.server.REQUEST_URI)}
					<strong>&raquo;</strong>
{else}
					&#8226;
{/if}
					<a href="/index.php/vm/resume/">r&eacute;sum&eacute;</a>
{if preg_match("/contact/", $smarty.server.REQUEST_URI)}
					<strong>&raquo;</strong>
{else}
					&#8226;
{/if}
					<a href="/index.php/vm/contact/">contact</a>
				</nav>

			</div>
		</header>

		<div id="content">
			<div class="container">
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
