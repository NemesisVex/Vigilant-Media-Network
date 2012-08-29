<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Vigilant Media{if $page_title} &#8212; {$page_title}{/if}</title>
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/screen.css" type="text/css" media="screen, projection">
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/print.css" type="text/css" media="print">
		<!--[if lt IE 8]><link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->
		<link rel="stylesheet" type="text/css" href="{$config.to_vigilante}/css/vigilante_blueprint.css">
		<link rel="stylesheet" type="text/css" href="/css/mt_blueprint.css">
		<link rel="stylesheet" type="text/css" href="{$config.to_vigilante}/css/jquery.autocomplete.css">
		<link rel="stylesheet" type="text/css" href="{$config.to_vigilante}/js/lib/thickbox.css">
		<link rel="stylesheet" type="text/css" href="{$config.to_vigilante}/js/ui/css/custom-theme/jquery-ui-1.8.16.custom.css">
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/lib/jquery.bgiframe.min.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/lib/jquery.ajaxQueue.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/lib/thickbox-compressed.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/ui/js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.validate.pack.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.autocomplete.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.cookie.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.vigilante.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/modernizr-1.6.min.js"></script>
		<!--[if lt IE 9]><script type="text/javascript" src="{$config.to_vigilante}/js/html5.js"></script><![endif]-->
	</head>

	<body>

		<div id="masthead">
			<div class="container">

				<div id="masthead-left" class="span-12">
					<h1 id="title"><a href="/" style="color: #FFF; text-decoration: none;">Vigilant Media</a></h1>
					<h3 id="subtitle"><a href="/" style="color: #FFF; text-decoration: none;">Central administration</a></h3>
				</div>

				<div id="masthead-right" class="span-12 prepend-top last">
{if $smarty.const.ENVIRONMENT!="production"}
					<span style="font-size: smaller;">
{if $smarty.const.ENVIRONMENT=="development"}<strong>&raquo;</strong>{else}&#8226;{/if} <a href="http://mt{$smarty.server.REQUEST_URI|escape}">DEV</a>
{if $smarty.const.ENVIRONMENT=="testing"}<strong>&raquo;</strong>{else}&#8226;{/if} <a href="http://test.mt.vigilantmedia.com{$smarty.server.REQUEST_URI|escape}">TEST</a>
						&#8226; <a href="http://mt.vigilantmedia.com{$smarty.server.REQUEST_URI|escape}">PROD</a>
					</span>
{/if}
					&raquo; <a href="/">home</a>
{if $smarty.session.is_logged_in && $smarty.session.user_level_mask>=16}
					<strong>&#8226; {$smarty.session.user_login}</strong> logged in
					<span style="font-size: smaller;">
						[<a href="{$smarty.server.SCRIPT_NAME|cat:"/session/logout/"}">LOGOUT</a>]
					</span>
{/if}
				</div>

			</div>
		</div>

		<div id="content">
			<div class="container">

				<div id="frame-1" class="span-22 prepend-1 append-1 prepend-top box">
{if $section_head}<h3><em>{$section_head}</em></h3>{/if}

{if $section_label}<h2><em>{$section_label}{if $section_sublabel}: {$section_sublabel}{/if}</em></h2>{/if}

{include file=mt_root_content.tpl}
				</div>


			</div>
		</div>

	</body>
</html>

