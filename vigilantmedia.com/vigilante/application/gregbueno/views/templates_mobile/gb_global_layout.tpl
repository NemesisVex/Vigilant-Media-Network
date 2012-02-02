<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Greg Bueno{if $page_title}: {$page_title}{/if}</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="alternate" type="application/rss+xml" title="gregbueno.com combined feed" href="http://www.gregbueno.com/index.xml" />
		<link rel="icon" href="/images/gbueno.ico" type="image/vnd.microsoft.icon" />
		<link rel="shortcut icon" href="/images/gbueno.ico" type="image/x-icon" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/screen.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/print.css" type="text/css" media="print" />
		<!--[if IE]><link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->
		<link rel="stylesheet" href="/css/greg.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="/css/greg_mobile.css" type="text/css" media="screen, projection" />
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.swfobject.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.swfobject.ext.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/modernizr-1.6.min.js"></script>
		<!--[if lt IE9]<script type="text/javascript" src="{$config.to_vigilante}/js/html5.js"></script>[/if]-->
	</head>
	<body>

		<div>

			<div id="frame-1">
				<header id="masthead" class="prepend-1 append-1 append-bottom">
					<h1 id="title"><a href="/">Greg Bueno</a></h1>
				</header>

				<section id="content" class="append-1 prepend-1">
{if $section_head}
					<header id="content-header">
{/if}
{if $section_label}
						<hgroup>
{/if}
{if $section_head}
							<h2 class="section-head">{$section_head}</h2>
{/if}
{if $section_label}
							<h3 class="section-label">{$section_label}</h3>
{/if}
{if $section_label}
						</hgroup>
{/if}
{if $seciont_head}
					</header>
{/if}

{if $content_template}{include file=$content_template}{/if}
				</section>
			</div>

			<aside id="frame-2" class="prepend-top last">

				<h3>Profile</h3>

				<p><img src="{$config.to_eponymous4}/images/bio_wrp_vol_03_restraint.jpg" width="100" height="100" alt="[Greg Bueno]" title="[Greg Bueno]" class="right"></p>

				<p>
					A lapsed musician and web developer, or a lapsed developer and web musician. It depends.
				</p>

				<nav id="site-nav">
					<ul>
						<li> <a href="/index.php/gb/profile/">Bio</a></li>
						<li> <a href="/index.php/gb/contact/">Contact</a></li>
						<li> <a href="{$config.to_vigilantmedia}/">Portfolio</a></li>
					</ul>
				</nav>

				<hr />

				<h3>Eponymous 4</h3>

				<p>Listen to the latest release of my home studio project.</p>

				<p id="ep4_bandcamp_player">&nbsp;</p>

{literal}
				<script type="text/javascript">
				$(function () {
					$ep4($('#ep4_bandcamp_player')[0]).bandcamp_widget(999064339, 'grande', 'F0F0F0', '1D4575', 100, 300, 'FFFFFF');
				});
				</script>
{/literal}

				<nav>
					<ul>
						<li> <a href="{$config.to_eponymous4}">Eponymous 4 official site</a></li>
						<li> <a href="http://www.myspace.com/eponymous4">Myspace</a></li>
					</ul>
				</nav>
				<hr />

{include file=gb_root__links.tpl}

			</aside>
		</div>


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
