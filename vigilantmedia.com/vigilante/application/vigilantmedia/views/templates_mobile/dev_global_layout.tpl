<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Vigilant Media Development{if $page_title} &#8212; {$page_title}{/if}</title>
		<meta charset="uft-8" />
		<link rel="stylesheet" type="text/css" href="{$config.to_vigilantmedia}/css/global.css" />
		<link rel="stylesheet" type="text/css" href="/css/vigilante.css" />
		<script type="text/javascript" src="{$config.to_vigilante}/js/modernizr-1.6.min.js"></script>
		<!--[if lt IE 9]><script type="text/javascript" src="{$config.to_vigilante}/js/html5.js"></script><![endif]-->
	</head>

	<body>
		<div id="Masthead">

			<div id="Masthead-Left">
				<div class="Bottom-Align" style="text-align: left;">
					<header>
						<span style="font-size: 276%;"><a href="/" style="color: #FFF; text-decoration: none;">Vigliant Media</a></span>
						<span style="font-size: 85%;"><a href="/" style="color: #FFF; text-decoration: none;">Development projects</a></span>
					</header>
				</div>
			</div>

			<div id="Masthead-Right">
				<div class="Bottom-Align" style="text-align: right;">
					<nav>
{if $smarty.const.ENVIRONMENT!="production"}
						<span class="smaller">
{if $smarty.const.ENVIRONMENT=="development"}<strong>&raquo;</strong>{else}&#8226;{/if} <a href="http://vigilante{$smarty.server.REQUEST_URI}">DEV</a>
{if $smarty.const.ENVIRONMENT=="testing"}<strong>&raquo;</strong>{else}&#8226;{/if} <a href="http://dev.vigilantmedia.com{$smarty.server.REQUEST_URI}">TEST</a>
						</span>
{/if}
{if $smarty.server.REQUEST_URI=="/"}<strong>&raquo;</strong>{else}&#8226;{/if} <a href="/">home</a>
						&#8226; <a href="{$config.to_vigilantmedia}/">viglantmedia.com</a>
					</nav>
				</div>
			</div>

		</div>

		<div id="Content">

			<div id="Main">
{if $section_head}
				<h3><em>{$section_head}</em></h3>
{/if}

{if $content_template}{include file=$content_template}{/if}

			</div>

			<div id="Right" style="font-size: 85%;">
{if $side_template}{include file=$side_template}{/if}
			</div>
		</div>

	</body>
</html>
