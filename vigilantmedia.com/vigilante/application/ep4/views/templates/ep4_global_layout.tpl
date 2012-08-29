<!DOCTYPE html>
<html>
	<head>
		<title>Eponymous 4{if $page_title} &raquo; {$page_title}{else} &raquo; Official Site{/if}</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, intial-scale=1.0" />
		<link rel="alternate" type="application/rss+xml" title="Eponymous 4 News" href="/index.xml" />
		<link rel="icon" href="/favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/screen.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/print.css" type="text/css" media="print" />
		<!--[if lt IE 8]><link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->
		<link rel="stylesheet" href="{$config.to_vigilante}/css/facebox.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="/css/typography.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="/css/layout.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="/css/mobile.css" type="text/css" media="screen and (max-width: 600px)" />
		<link rel="stylesheet" href="/css/skins/ep4/skin.css" type="text/css" media="screen, projection" />
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.swfobject.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.swfobject.ext.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.validate.pack.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.jcarousel.pack.js"></script>
		<script type="text/javascript" src="/js/eponymous4.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/modernizr-1.6.min.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/facebox.js"></script>
		{literal}
		<script type="text/javascript">
		var facebox_options = {
			closeImage: 'http://vigilante.vigilantmedia.com/images/closelabel.gif',
			loadingImage: 'http://vigilante.vigilantmedia.com/images/loading.gif'
		};
		$(function () {
			$('a[rel*=facebox]').facebox(facebox_options);
		});
		</script>
		{/literal}
		<!--[if lt IE 9]><script type="text/javascript" src="{$config.to_vigilante}/js/html5.js"></script><![endif]-->
		<!--[if lte IE 6]>
		<link rel="stylesheet" href="{$config.to_vigilante}/css/facebox.css" type="text/css" media="screen, projection">
		<script type="text/javascript" src="{$config.to_vigilante}/js/facebox.js"></script>
		{literal}
				<script type="text/javascript">
				$(document).ready(function ()
				{
					$('a[rel*=facebox]').facebox({
						closeImage: 'http://vigilante.vigilantmedia.com/images/closelabel.gif',
						loadingImage: 'http://vigilante.vigilantmedia.com/images/loading.gif'
					});
					$('#ie6 a').trigger('click');
				});
				</script>
		{/literal}
				<![endif]-->
	</head>

	<body>
		<div id="container" class="container">
			<div id="masthead">
				<header>
					<h1 id="title"><a href="/">eponymous 4</a></h1>
				</header>

				<nav id="nav-column-1">
					<ul id="nav-main">
						<li><a href="/index.php/news/">Blog</a></li>
						<li><a href="/index.php/music/">Music</a></li>
						<li><a href="/index.php/music/video/">Video</a></li>
						<li><a href="/index.php/bio/">About</a></li>
						<li><a href="/index.php/contact/">Contact</a></li>
					</ul>
				</nav>

				<nav id="nav-column-2">
					<ul id="nav-social">
						<li><a href="http://twitter.com/eponymous4/"><img src="{$config.to_vigilante}/images/icons/twitter.png" alt="[Twitter]" title="[Twitter]" /></a></li>
						<li><a href="http://facebook.com/eponymous4/"><img src="{$config.to_vigilante}/images/icons/facebook.png" alt="[Facebook]" title="[Facebook]" /></a></li>
						<li><a href="http://soundcloud.com/observantrecords"><img src="{$config.to_vigilante}/images/icons/soundcloud.png" alt="[SoundCloud]" title="[SoundCloud]" /></a></li>
						<li><a href="http://youtube.com/user/observantrecords"><img src="{$config.to_vigilante}/images/icons/youtube.png" alt="[YouTube]" title="[YouTube]" /></a></li>
						<li><a href="/index.xml"><img src="{$config.to_vigilante}/images/icons/feed.png" alt="[RSS]" title="[RSS]" /></a></li>
						<li><a href="http://myspace.com/eponymous4"><img src="{$config.to_vigilante}/images/icons/myspace.png" alt="[MySpace]" title="[MySpace]" /></a></li>
					</ul>
				</nav>

				<!--[if lte IE 6]>
				<div class="box">
				To get the best experience from this site, please update your browser:<br/>
				<a href="http://www.mozilla.com/">Firefox</a> |
				<a href="http://www.microsoft.com/Windows/internet-explorer/">IE8</a> |
				<a href="http://www.google.com/chrome">Chrome</a> |
				<a href="http://www.opera.com/">Opera</a> |
				<a href="http://www.apple.com/safari/">Safari</a>
				</div>
				<![endif]-->

			</div>

			<div id="content">
{if $content_template}{include file=$content_template}{/if}
			</div>

			<img src="/images/exm_vol_03_restraint.jpg" class="bg" alt="[Eponymous 4 Background]"/>
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
