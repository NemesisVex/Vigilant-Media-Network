<!DOCTYPE html>
<html lang="en">
	<head>
		<title>the closet{if $page_title}: {$page_title}{/if}</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/screen.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/print.css" type="text/css" media="print" />
		<!--[if IE]><link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->
		<link rel="stylesheet" href="/css/studio.css" type="text/css" />
	</head>

	<body>

		<div id="masthead">

			<div class="container">

				<div id="masthead-left" class="span-12">
					<h1 id="title"><a href="/index.php/studio/">The Closet</a></h1>
				</div>

				<div id="masthead-right" class="span-12 last">
{if $smarty.const.ENVIRONMENT!="prod"}
					<span class="smaller">
{if $smarty.const.ENVIRONMENT=="dev"}<strong>&raquo;</strong>{else}&#8226;{/if} <a href="http://vigilante{$smarty.server.REQUEST_URI}">DEV</a>
{if $smarty.const.ENVIRONMENT=="test"}<strong>&raquo;</strong>{else}&#8226;{/if} <a href="http://test.vigilante.vigilantmedia.com{$smarty.server.REQUEST_URI}">TEST</a>
						&#8226; <a href="http://vigilante.vigilantmedia.com{$smarty.server.REQUEST_URI}">PROD</a>
					</span>
{/if}
				</div>

			</div>

		</div>

		<div id="content">
			<div class="container">
				<div class="prepend-top">

{if $content_template}{include file=$content_template}{/if}

				</div>
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
