<!DOCTYPE html>
<html>
	<head lang="en-us">
		<title>Observant Records{if $page_title} &raquo; {$page_title}{/if}</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" href="/favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/screen.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/print.css" type="text/css" media="print" />
		<!--[if lt IE 8]><link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->
		<link rel="stylesheet" href="/css/typography.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="/css/layout.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="/css/mobile.css" type="text/css" media="screen and (max-width: 600px)" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/jquery.autocomplete.css" type="text/css" />
		<link rel="stylesheet" href="{$config.to_vigilante}/js/lib/thickbox.css" type="text/css" />
		<link rel="stylesheet" href="{$config.to_vigilante}/js/ui/css/smoothness/jquery-ui-1.8.23.custom.css" type="text/css" />
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.swfobject.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.swfobject.ext.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.validate.pack.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/ui/js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/modernizr-1.6.min.js"></script>
		<!--[if lt IE 9]><script type="text/javascript" src="{$config.to_vigilante}/js/html5.js"></script><![endif]-->
		<script type="text/javascript" src="http://webplayer.yahooapis.com/player-beta.js"></script>
	</head>

	<body>
		<div id="container">
			<div id="masthead">
				<header id="logo">
					<a href="/"><img src="/images/observant_records_logo.png" alt="[Observant Records]" id="observant-records-logo" /></a>
				</header>

				<nav id="nav-column-1">
					<ul id="nav-main">
						<li><a href="/index.php/news/">Blog</a></li>
						<li><a href="{$config.to_observantshop}/">Shop</a></li>
						<li><a href="/index.php/contact/">Contact</a></li>
						{if $smarty.session.is_logged_in}<li><a href="/index.php/admin/logout/">Logout</a></li>{/if}
					</ul>
				</nav>

				<nav id="nav-column-2">
					<ul id="nav-social">
						<li><a href="http://twitter.com/ObservantRecs"><img src="{$config.to_vigilante}/images/icons/twitter.png" alt="[Twitter]" title="[Twitter]" /></a></li>
						<li><a href="http://youtube.com/user/observantrecords"><img src="{$config.to_vigilante}/images/icons/youtube.png" alt="[YouTube]" title="[YouTube]" /></a></li>
						<li><a href="http://soundcloud.com/observantrecords"><img src="{$config.to_vigilante}/images/icons/soundcloud.png" alt="[SoundCloud]" title="[SoundCloud]" /></a></li>
					</ul>
				</nav>
			</div>

			<div id="content">
			{if $content_template}{include file=$content_template}{/if}
			</div>

			<footer class="centered">
				<p>&copy; {'now'|date_format:"%Y"} Observant Records</p>
			</footer>
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
