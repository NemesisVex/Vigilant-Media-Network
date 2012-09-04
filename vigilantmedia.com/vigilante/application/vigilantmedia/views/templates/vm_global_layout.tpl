<!DOCTYPE html>
<html>
	<head>
		<title>Vigilant Media{if $page_title} &#8212; {$page_title}{/if}</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="http://vigilante.vigilantmedia.com/css/blueprint/screen.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="http://vigilante.vigilantmedia.com/css/blueprint/print.css" type="text/css" media="print" />
		<!--[if lt IE 8]><link rel="stylesheet" href="http://vigilante.vigilantmedia.com/css/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->
		<link rel="stylesheet" href="http://vigilante.vigilantmedia.com/css/facebox.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="/css/typography.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="/css/layout.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="/css/mobile.css" type="text/css" media="screen and (max-width: 600px)" />
		<script type="text/javascript" src="http://vigilante.vigilantmedia.com/js/jquery.js"></script>
		<script type="text/javascript" src="http://vigilante.vigilantmedia.com/js/modernizr-1.6.min.js"></script>
		<!--[if lt IE 9]><script type="text/javascript" src="http://vigilante.vigilantmedia.com/vigilante/js/html5.js"></script><![endif]-->
	</head>
	<body>
		<div id="masthead">
			<div class="container">
				<header id="masthead-title">
					<hgroup>
						<h1 id="title"><a href="/">Vigilant Media</a></h1>
						<h2 id="subtitle">The online portfolio of Greg Bueno</h2>
					</hgroup>
				</header>

				<nav id="nav-main">
					<ul>
						<li class="active"><a href="/">Home</a></li>
						<li><a href="/index.php/vm/projects/">Projects</a></li>
						<li><a href="/index.php/vm/resume/">Résumé</a></li>
						<li><a href="http://blog.vigilantmedia.com/">Blog</a></li>
						<li><a href="/index.php/vm/contact/">Contact</a></li>
					</ul>
				</nav>
			</div>
		</div>

		<div id="content">
			<div class="container">
				<!--CONTENT START-->
{if $content_template}{include file=$content_template}{/if}
				<!--CONTENT END-->
			</div>
		</div>

		<footer id="footer">
			<div class="container centered">

			&copy; 2012 Greg Bueno
			</div>
		</footer>

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
