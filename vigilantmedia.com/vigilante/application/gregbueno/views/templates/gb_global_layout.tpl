<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Greg Bueno{if $page_title}: {$page_title}{/if}</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" href="/images/gbueno.ico" type="image/vnd.microsoft.icon" />
		<link rel="shortcut icon" href="/images/gbueno.ico" type="image/x-icon" />
		<link rel="stylesheet" href="{$smarty.const.VIGILANTMEDIA_CDN_BASE_URI}/web/css/blueprint/screen.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="{$smarty.const.VIGILANTMEDIA_CDN_BASE_URI}/web/css/blueprint/print.css" type="text/css" media="print" />
		<!--[if lt IE 8]><link rel="stylesheet" href="{$smarty.const.VIGILANTMEDIA_CDN_BASE_URI}/web/css/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->
		<link rel="stylesheet" href="/css/typography.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="/css/layout.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="/css/mobile.css" type="text/css" media="screen and (max-width: 600px)" />
		<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
		<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script type="text/javascript" src="{$smarty.const.VIGILANTMEDIA_CDN_BASE_URI}/web/js/jquery.swfobject.js"></script>
		<script type="text/javascript" src="{$smarty.const.VIGILANTMEDIA_CDN_BASE_URI}/web/js/jquery.swfobject.ext.js"></script>
		<script type="text/javascript" src="{$smarty.const.VIGILANTMEDIA_CDN_BASE_URI}/web/js/modernizr-1.6.min.js"></script>
		<!--[if lt IE 9]><script type="text/javascript" src="{$smarty.const.VIGILANTMEDIA_CDN_BASE_URI}/web/js/html5.js"></script><![endif]-->
	</head>
	<body>

		<div id="container">

			<div id="masthead">
				<header id="logo">
					<hgroup>
						<h1 id="title"><a href="/">Greg Bueno</a></h1>
					</hgroup>
				</header>

				<section id="logo-pic">
					<img width="100" height="100" title="[Greg Bueno]" alt="[Greg Bueno]" src="/images/bio_wrp_vol_03_restraint.jpg" />
				</section>
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
