<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Greg Bueno{if $page_title}: {$page_title}{/if}</title>
		<meta charset="utf-8" />
		<link rel="icon" href="/images/gbueno.ico" type="image/vnd.microsoft.icon" />
		<link rel="shortcut icon" href="/images/gbueno.ico" type="image/x-icon" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/screen.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/print.css" type="text/css" media="print" />
		<!--[if IE]><link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->
		<link rel="stylesheet" href="css/typography.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen, projection" />
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.swfobject.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.swfobject.ext.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/modernizr-1.6.min.js"></script>
		<!--[if lt IE9]<script type="text/javascript" src="{$config.to_vigilante}/js/html5.js"></script>[/if]-->
	</head>
	<body>

		<div class="container">

			<div id="masthead" class="span-24">
				<header class="prepend-4 span-14">
					<hgroup>
						<h1 id="title">Greg Bueno</h1>
					</hgroup>
				</header>
				
				<section class="span-6 last">
					<img width="100" height="100" title="[Greg Bueno]" alt="[Greg Bueno]" src="http://www.eponymous4.com/images/bio_wrp_vol_03_restraint.jpg" />
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
{if $seciont_head}
					</header>
{/if}

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
			var pageTracker = _gat._getTracker("UA-7828220-5");
			pageTracker._trackPageview();
		} catch(err) {}
		</script>
{/literal}

	</body>
</html>
