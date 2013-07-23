<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Starting to Remember: A Supernatural Detective Novel by Greg Bueno</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" href="/images/gbueno.ico" type="image/vnd.microsoft.icon" />
		<link rel="shortcut icon" href="/images/gbueno.ico" type="image/x-icon" />
		<link rel="stylesheet" href="{$smarty.const.VIGILANTMEDIA_CDN_BASE_URI}/web/css/blueprint/screen.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="{$smarty.const.VIGILANTMEDIA_CDN_BASE_URI}/web/css/blueprint/print.css" type="text/css" media="print" />
		<!--[if lt IE 8]><link rel="stylesheet" href="{$smarty.const.VIGILANTMEDIA_CDN_BASE_URI}/web/css/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->
		<link rel="stylesheet" href="/css/crux/typography.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="/css/crux/layout.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="/css/crux/mobile.css" type="text/css" media="screen and (max-width: 600px)" />
		<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
		<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script type="text/javascript" src="{$smarty.const.VIGILANTMEDIA_CDN_BASE_URI}/web/js/jquery.swfobject.js"></script>
		<script type="text/javascript" src="{$smarty.const.VIGILANTMEDIA_CDN_BASE_URI}/web/js/jquery.swfobject.ext.js"></script>
		<script type="text/javascript" src="{$smarty.const.VIGILANTMEDIA_CDN_BASE_URI}/web/js/modernizr-1.6.min.js"></script>
		<!--[if lt IE 9]><script type="text/javascript" src="{$smarty.const.VIGILANTMEDIA_CDN_BASE_URI}/web/js/html5.js"></script><![endif]-->
	</head>
	<body class="crux">

		<div id="container">

			<div id="masthead" class="centered">
				<header id="logo">
					<hgroup>
						<h1 id="title"><a href="/index.php/crux/"><img src="/images/starting_to_remember_logo.png" alt="[Starting to Remember]" title="[Starting to Remember]" id="logo" /></a></h1>
						<h2 id="subtitle">A supernatural detective novel</h2>
					</hgroup>
				</header>
			</div>

			<div id="content">
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
{if $section_head}
					</header>
{/if}

{if $content_template}{include file=$content_template}{/if}
			</div>
			
			<footer class="centered">
				<p>&copy; {'now'|date_format:"%Y"} Greg Bueno</p>
			</footer>
			
		</div>

		<img src="/images/starting_to_remember_skyline.jpg" class="bg" />

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
