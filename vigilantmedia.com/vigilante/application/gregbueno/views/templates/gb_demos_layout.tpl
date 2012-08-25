<!DOCTYPE html>
<html lang="en">
	<head>
		<title>a loss for words</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/screen.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/print.css" type="text/css" media="print" />
		<!--[if IE]><link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->
		<link rel="stylesheet" href="/css/demos.css" type="text/css" />
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.swfobject.js"></script>
		<script type="text/javascript" src="{$config.to_eponymous4}/js/swfobject_eponymous4.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/modernizr-1.6.min.js"></script>
		<!--[if lt IE9]<script type="text/javascript" src="{$config.to_vigilante}/js/html5.js"></script>[/if]-->
{literal}
		<script type="text/javascript">
		var base_url = 'http://eponymous4.gregbueno.com';

		function jq_load_file(block_id, file_url, title, author)
		{
			if (author == '') {author = 'Eponymous 4';}
			block_id.flash(
			{
				swf: base_url + '/audio/mediaplayer.swf',
				height: 40,
				width: 250,
				params:
				{
					allowfullscreen: false,
					flashvars:
					{
						file: file_url,
						displaywidth: 0,
						autostart: false,
						title: title,
						author: author
					}
				}
			});
		}
		</script>
{/literal}
	</head>

	<body>

		<div class="container">

			<div id="masthead" class="span-24">
				<div id="masthead-left" class="span-12">
					<h1 id="title"><a href="/index.php/demos/">a loss for words</a></h1>
				</div>

				<div id="masthead-right" class="span-12 last">
{if $smarty.const.ENVIRONMENT!="production"}
					<span class="smaller">
{if $smarty.const.ENVIRONMENT=="development"}<strong>&raquo;</strong>{else}&#8226;{/if} <a href="http://gbueno{$smarty.server.REQUEST_URI}">DEV</a>
{if $smarty.const.ENVIRONMENT=="testing"}<strong>&raquo;</strong>{else}&#8226;{/if} <a href="http://test.gregbueno.com{$smarty.server.REQUEST_URI}">TEST</a>
						&#8226; <a href="http://www.gregbueno.com{$smarty.server.REQUEST_URI}">PROD</a>
					</span>
{/if}
				</div>
			</div>
{if $content_template}{include file=$content_template}{/if}
		</div>

		<script type="text/javascript">
		{literal}
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
		try {
		var pageTracker = _gat._getTracker("UA-7828220-5");
		pageTracker._trackPageview();
		} catch(err) {}
		{/literal}
		</script>

	</body>
</html>
