<!DOCTYPE html>
<html>
	<head>
		<title>Vigilante &#8212; Vigilant Media Framework{if $page_title} &#8212; {$page_title}{/if}</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="/css/blueprint/screen.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="/css/blueprint/print.css" type="text/css" media="print" />
		<!--[if IE 8]><link rel="stylesheet" href="/css/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->
		<link rel="stylesheet" href="/css/typography.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="/css/layout.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="/css/mobile.css" type="text/css" media="screen and (max-width: 600px)" />
		<script type="text/javascript" src="/js/jquery.js"></script>
		<script type="text/javascript" src="/js/modernizr-1.6.min.js"></script>
		<!--[if lt IE 9]><script type="text/javascript" src="/js/html5.js"></script><![endif]-->
	</head>

	<body>

		<div id="masthead">
			<div class="container">
				<header id="masthead-title">
					<hgroup>
						<h1 id="title"><a href="index.html">Vigilante</a></h1>
						<h2 id="subtitle">CodeIgniter libraries for Vigilant Media</h2>
					</hgroup>
				</header>

				<nav id="nav-main">
					<ul>
						<li><a href="/">Home</a></li>
						<li><a href="{$config.to_vigilantmedia}/">Vigilant Media</a></li>
					</ul>
				</nav>

			</div>
		</div>

		<div id="content">
			<div class="container">

				<section id="frame-1" class="full-column-last">
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
