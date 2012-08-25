<!DOCTYPE html>
<html>
	<head>
		<title>Vigilante &#8212; Vigilant Media Framework{if $page_title} &#8212; {$page_title}{/if}</title>
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="/css/blueprint/screen.css" type="text/css" media="screen, projection">
		<link rel="stylesheet" href="/css/blueprint/print.css" type="text/css" media="print">
		<!--[if IE]><link rel="stylesheet" href="/css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
		<link rel="stylesheet" type="text/css" href="{$config.to_vigilantmedia}/css/global.css">
		<link rel="stylesheet" type="text/css" href="/css/vigilante_blueprint.css">
		<script type="text/javascript" src="/js/modernizr-1.6.min.js"></script>
		<!--[if lt IE9]<script type="text/javascript" src="/js/html5.js"></script>[/if]-->
	</head>

	<body>

		<div id="masthead">
			<div class="container">

				<header id="masthead-left" class="span-12">
					<hgroup>
						<h1 id="title"><a href="/" style="color: #FFF; text-decoration: none;">Vigilante</a></h1>
						<h3 id="subtitle"><a href="/" style="color: #FFF; text-decoration: none;">Vigliant Media Framework</a></h3>
					</hgroup>
				</header>

				<nav id="masthead-right" class="span-12 prepend-top last">
{if $smarty.const.ENVIRONMENT!="production"}
					<span class="smaller">
						{if $smarty.const.ENVIRONMENT=="development"}<strong>&raquo;</strong>{else}&#8226;{/if} <a href="http://vigilante{$smarty.server.REQUEST_URI}">DEV</a>
						{if $smarty.const.ENVIRONMENT=="test"}<strong>&raquo;</strong>{else}&#8226;{/if} <a href="http://test.vigilante.vigilantmedia.com{$smarty.server.REQUEST_URI}">TEST</a>
						&#8226; <a href="http://vigilante.vigilantmedia.com{$smarty.server.REQUEST_URI}">PROD</a>
					</span>
{/if}
					{if $smarty.server.REQUEST_URI=="/"}<strong>&raquo;</strong>{else}&#8226;{/if} <a href="/">home</a>
					{if preg_match("/docs/", $smarty.server.REQUEST_URI)}<strong>&raquo;</strong>{else}&#8226;{/if} <a href="/index.php/vg/docs/">documentation</a>
					&#8226; <a href="{$config.to_vigilantmedia}/">viglantmedia.com</a>
				</nav>

			</div>
		</div>

		<div id="content">
			<div class="container">

				<section id="frame-1" class="span-14 prepend-1 append-1 prepend-top box">
{if $section_head}
					<header>
						<h3><em>{$section_head}</em></h3>
					</header>
{/if}

{if $content_template}{include file=$content_template}{/if}

				</section>

				<aside id="frame-2" class="span-6 prepend-1 prepend-top">
{if $side_template}{include file=$side_template}{/if}
				</aside>

			</div>
		</div>

{literal}
		<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
		try {
			var pageTracker = _gat._getTracker("UA-7828220-7");
			pageTracker._trackPageview();
		} catch(err) {}
		</script>
{/literal}

	</body>
</html>
