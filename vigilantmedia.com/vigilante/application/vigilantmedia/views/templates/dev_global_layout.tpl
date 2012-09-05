<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Vigilant Media Development{if $page_title} &#8212; {$page_title}{/if}</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/screen.css" type="text/css" media="screen, projection">
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/print.css" type="text/css" media="print">
		<!--[if lt IE 8]><link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->
		<link rel="stylesheet" href="{$config.to_vigilante}/css/typography.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/layout.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/mobile.css" type="text/css" media="screen and (max-width: 600px)" />
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/modernizr-1.6.min.js"></script>
		<!--[if lt IE 9]><script type="text/javascript" src="{$config.to_vigilante}/js/html5.js"></script><![endif]-->
	</head>

	<body>
		<div id="masthead">
			<div class="container">
				<header id="masthead-title">
					<hgroup>
						<h1 id="title"><a href="/">Vigilante</a></h1>
						<h2 id="subtitle">Development projects</h2>
					</hgroup>
				</header>

				<nav id="nav-main">
					<ul>
						<li class="active"><a href="/">Home</a></li>
						<li class="active"><a href="{$config.to_vigilantmedia}">Vigilant Media</a></li>
					</ul>
				</nav>
			</div>
		</div>

		<div id="content">
			<div class="container">
				<div class="full-column-last">
				<!--CONTENT START-->
{if $content_template}{include file=$content_template}{/if}
				<!--CONTENT END-->
				</div>
			</div>
		</div>

	</body>
</html>
