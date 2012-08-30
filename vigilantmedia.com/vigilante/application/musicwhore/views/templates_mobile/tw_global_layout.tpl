<!DOCTYPE html>
<html>
	<head>
		<title>TVwhore.org{if $page_title}: {$page_title}{/if}</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="alternate" type="application/rss+xml" title="TVwhore.org RSS" href="http://www.tvwhore.org/index.xml" />
		<link rel="icon" href="/favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="{$config.to_vigilante}/css/blueprint/screen.css" />
		<link rel="stylesheet" type="text/css" href="{$config.to_vigilante}/css/blueprint/print.css" media="print" />
		<!--[if lt IE 8]><link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->
		<link rel="stylesheet" type="text/css" href="{$config.to_archive}/css/global.css" />
		<link rel="stylesheet" type="text/css" href="{$config.to_archive}/css/global_mobile.css" />
		<link rel="stylesheet" type="text/css" href="/css/tvwhore.css" />
		<link rel="stylesheet" type="text/css" href="/css/tvwhore_mobile.css" />
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.cookie.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.swfobject.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.swfobject.ext.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.validate.pack.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/modernizr-1.6.min.js"></script>
		<!--[if lt IE 9]><script type="text/javascript" src="{$config.to_vigilante}/js/html5.js"></script><![endif]-->
	</head>
	<body>
		<div id="masthead">
			<div>
				<header id="masthead-left">
					<h1 id="title"><a href="/">TVwhore.org</a></h1>
				</header>
				<nav id="masthead-right">
					<form method="get" action="{$config.to_mt}/cgi-bin/mt/mt-search.cgi">
						<a href="/index.php/tw/about/">About this site</a> &#8226;
						<a href="/index.php/tw/contact/">Contact</a> |
						<strong>Search:</strong>
						<input type="hidden" name="IncludeBlogs" value="{$config.blog_id}">
						<input type="hidden" name="Template" value="tvsearch" />
						<input id="search" name="search" size="20" />
						<input type="submit" value="Go" />
					</form>
				</nav>
			</div>
		</div>

		<div id="content">
			<div>
				<section id="body" class="box">
					<div id="body_text">

{if $section_head}<h2>{$section_head}</h2>{/if}

{if $section_label}<h3>{$section_label}</h3>{/if}

{if $section_sublabel}<h4>{$section_sublabel}</h4>{/if}

{if $content_template}{include file=$content_template}{/if}

					</div>
				</section>

				<aside class="prepend-1 prepend-top">
					<script type="text/javascript" src="http://embed.technorati.com/embed/v6ayg9gm6x.js"></script>

{if $rsLatest}
					<h3>Latest comments</h3>

					<p>
{foreach item=rsLatest from=$rsLatest}
						&#8226; <em>{$rsLatest->comment_text|strip_tags|truncate:40:" ..."}</em> by <strong>{$rsLatest->comment_author}</strong> in <a href="/index.php/tw/entry/{$rsLatest->entry_id}/#comments" title="[{$rsLatest->entry_title}]">{$rsLatest->entry_title|truncate:40:" ..."}</a>, <em>{$rsLatest->comment_created_on|date_format:"%Y-%m-%d"}</em><br />
{/foreach}
					</p>

{/if}

					<h3>Categories</h3>

					<p>
{foreach item=rsCategory from=$rsCategories}
						<a href="/index.php/tw/category/{$rsCategory->category_id}/">{$rsCategory->category_label}</a><br />
{/foreach}
					</p>

					<h3>Calendar</h3>

					<p>
{archive_date_output url="/index.php/tw/date/XXXXXX/" blog_id=$config.blog_id}<br />
					</p>

					<h3>Subscribe</h3>

					<p>
						<a href="/index.xml" class="feed_link">RSS</a><br />
					</p>


					<h3>Also by ...</h3>

					<p>
						<a href="{$config.to_archive}">archive.musicwhore.org</a><br />
						<a href="{$config.to_eponymous4}">eponymous4.com</a><br />
						<a href="{$config.to_filmwhore}">filmwhore.org</a><br />
						<a href="{$config.to_gregbueno}">gregbueno.com</a><br />
						<a href="{$config.to_musicwhore}">musicwhore.org</a><br />
					</p>

					<p>
						&copy; {"now"|date_format:"%Y"} <a href="{$config.to_gregbueno}">Greg Bueno</a><br />
						<a href="/index.php/mw/terms/">Terms &amp; conditions</a><br />
{if $smarty.const.ENVIRONMENT!="production"}
						<a href="http://dev.tv.musicwhore.org{$smarty.server.REQUEST_URI}">DEV</a> |
						<a href="http://test.tv.musicwhore.org{$smarty.server.REQUEST_URI}">TEST</a> |
						<a href="http://www.tvwhore.org{$smarty.server.REQUEST_URI}">PROD</a>
{/if}
					</p>

{include file=ep4_global_mw_ad.tpl}


					<p>
						<a href="http://www.spreadfirefox.com/?q=affiliates&amp;id=38994&amp;t=70"><img src="/images/get_firefox.gif" width="88" height="31" alt="[Get Firefox]" border="0" /></a><br />
					</p>

					<script type="text/javascript">
					<!--
					google_ad_client = "pub-7826276896407540";
					google_ad_width = 120;
					google_ad_height = 240;
					google_ad_format = "120x240_as";
					google_ad_channel ="";
					google_color_border = "CCCC99";
					google_color_bg = "333333";
					google_color_link = "#61CFD1";
					google_color_url = "FFCC00";
					google_color_text = "FFFFFF";
					//-->
					</script>
					<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>

				</aside>

			</div>

		</div>


	</body>
</html>
