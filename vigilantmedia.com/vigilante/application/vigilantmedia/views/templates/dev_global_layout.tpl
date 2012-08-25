<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Vigilant Media Development{if $page_title} &#8212; {$page_title}{/if}</title>
		<meta charset="uft-8" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/screen.css" type="text/css" media="screen, projection">
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/print.css" type="text/css" media="print">
		<!--[if IE]><link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
		<link rel="stylesheet" type="text/css" href="{$config.to_vigilantmedia}/css/global.css" />
		<link rel="stylesheet" type="text/css" href="{$config.to_vigilante}/css/vigilante_blueprint.css" />
		<script type="text/javascript" src="{$config.to_vigilante}/js/modernizr-1.6.min.js"></script>
		<!--[if lt IE9]<script type="text/javascript" src="{$config.to_vigilante}/js/html5.js"></script>[/if]-->
	</head>

	<body>
		<div id="masthead">
			<div class="container">

				<header id="masthead-left" class="span-12">
					<hgroup>
						<h1 id="title"><a href="/" style="color: #FFF; text-decoration: none;">Vigliant Media</a></h1>
						<h3 id="subtitle">><a href="/" style="color: #FFF; text-decoration: none;">Development projects</a></h3>
					</hgroup>
				</header>

				<nav id="masthead-right" class="span-12 prepend-top last">
{if $smarty.const.ENVIRONMENT!="production"}
						<span class="smaller">
{if $smarty.const.ENVIRONMENT=="development"}<strong>&raquo;</strong>{else}&#8226;{/if} <a href="http://vigilante{$smarty.server.REQUEST_URI}">DEV</a>
{if $smarty.const.ENVIRONMENT=="test"}<strong>&raquo;</strong>{else}&#8226;{/if} <a href="http://dev.vigilantmedia.com{$smarty.server.REQUEST_URI}">TEST</a>
						</span>
{/if}
{if $smarty.server.REQUEST_URI=="/"}<strong>&raquo;</strong>{else}&#8226;{/if} <a href="/">home</a>
						&#8226; <a href="{$config.to_vigilantmedia}/">viglantmedia.com</a>
				</nav>

			</div>
		</div>

		<div id="content">
			<div class="container">

				<section id="frame-1" class="span-14 prepend-1 append-1 prepend-top box">
{if $section_head}
				<h3><em>{$section_head}</em></h3>
{/if}

{if $content_template}{include file=$content_template}{/if}

				</section>

				<aside id="frame-2" class="span-6 prepend-1 prepend-top">
{if $side_template}{include file=$side_template}{/if}
				</aside>

			</div>
		</div>

	</body>
</html>
