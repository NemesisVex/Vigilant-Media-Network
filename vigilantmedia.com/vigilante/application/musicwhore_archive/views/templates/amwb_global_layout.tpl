<!DOCTYPE html>
<html>
	<head>
		<title>Archive.Musicwhore.org{if $page_title}: {$page_title}{/if}</title>
		<meta charset="utf-8" />
		<link rel="icon" href="/favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="{$config.to_vigilante}/css/blueprint/screen.css" />
		<link rel="stylesheet" type="text/css" href="{$config.to_vigilante}/css/blueprint/print.css" media="print" />
		<!--[if IE]><link rel="stylesheet" type="text/css" href="{$config.to_vigilante}/css/blueprint/ie.css" media="screen, projection" /><![endif]-->
		<link rel="stylesheet" type="text/css" href="/css/global.css" />
		<link rel="stylesheet" type="text/css" href="/css/musicwhore.css" />
		<link rel="stylesheet" type="text/css" href="/includes/musicwhore.css" />
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.swfobject.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.swfobject.ext.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.query.js"></script>
		<script type="text/javascript" src="/includes/musicwhore.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/modernizr-1.6.min.js"></script>
		<!--[if lt IE9]<script type="text/javascript" src="{$config.to_vigilante}/js/html5.js"></script>[/if]-->
	</head>
	<body>

		<div id="masthead">
			<div id="container" class="container">
				<header id="masthead-left" class="span-12">
					<h1 id="title"><a href="/">Archive.Musicwhore.org</a></h1>
				</header>
				<nav id="masthead-right" class="span-12 last">
					<form method="get" action="{$config.to_mt}/cgi-bin/mt/mt-search.cgi">
						<strong>Search:</strong>
						<input type="hidden" name="IncludeBlogs" value="{$config.blog_id}">
						<input type="hidden" name="Template" value="archivesearch">
						<input id="search" name="search" size="20">
						<input type="submit" value="Go">
					</form>
				</nav>
			</div>
		</div>

		<div id="content">
			<div class="container">
				<section id="body" class="span-13 box">
					<div id="body_text">
{if $section_head}<h2>{$section_head}</h2>{/if}

{if $section_label}<h3>{$section_label}</h3>{/if}

{if $section_sublabel}<h4>{$section_sublabel}</h4>{/if}

{if $content_template}{include file=$content_template}{/if}

					</div>
				</section>

				<aside id="sidebar-col-1" class="span-4 prepend-1 colborder prepend-top">

					<script type="text/javascript" src="http://track3.mybloglog.com/js/jsserv.php?mblID=2007011712470964"></script>


					<h3>Artists</h3>

					<p>
{foreach item=rsArtistNav from=$rsArtistsNav}
							<a href="/index.php/artists/artist/browse/{$rsArtistNav->nav|lower}/">{$rsArtistNav->nav}</a>
{/foreach}
					</p>

					<h3>Categories</h3>

					<p>
						{foreach item=rsCategory from=$rsCategories}
							<a href="/index.php/content/category/{$rsCategory->category_id}/">{$rsCategory->category_label}</a><br>
						{/foreach}
					</p>

					<h3>Calendar</h3>

					<p>
						{archive_date_output url="/index.php/content/date/XXXXXX/" include_month=-1 blog_id=$config.blog_id}<br>
					</p>

					<h3>Also by ...</h3>

					<p>
						<a href="{$config.to_eponymous4}">eponymous4.com</a><br>
						<a href="{$config.to_filmwhore}">filmwhore.org</a><br>
						<a href="{$config.to_gregbueno}">gregbueno.com</a><br>
						<a href="{$config.to_musicwhore}">musicwhore.org</a><br>
						<a href="{$config.to_tvwhore}">tvwhore.org</a><br>
					</p>

					<p>
						&copy; {"now"|date_format:"%Y"} <a href="{$config.to_gregbueno}">Greg Bueno</a> | <a href="/index.php/archive/terms/">Terms &amp; conditions</a>
{if $smarty.const.ENVIRONMENT!="production"}
							| <a href="http://archive{$smarty.server.REQUEST_URI}">DEV</a> |
							<a href="http://test.archive.musicwhore.org{$smarty.server.REQUEST_URI}">TEST</a> |
							<a href="http://archive.musicwhore.org{$smarty.server.REQUEST_URI}">PROD</a>
{/if}
					</p>

				</aside>

				<aside id="sidebar-col-2" class="span-4 prepend-top last">
{include file=ep4_global_mw_ad.tpl}

{php}
	$amazonRnd = mt_rand();
	$this->assign("amazonRnd", $amazonRnd);
{/php}
					<script type="text/javascript">
						amazon_ad_tag="musicwhoreorg-{if $amazonRnd % 2==0}22{else}20{/if}";
						amazon_ad_width="120";
						amazon_ad_height="240";
						amazon_color_background="666666";
						amazon_color_border="CCCC99";
						amazon_color_logo="000000";
						amazon_color_text="FFFFFF";
						amazon_color_link="FFCC00";
					</script>
					<script type="text/javascript" src="http://www.assoc-amazon.{if $amazonRnd % 2==0}jp{else}com{/if}/s/asw.js"></script><br>

					<div style="font-size: smaller;">
						<p>
							<a href="http://astore.amazon.com/musicwhoreorg-20">Musicwhore.org aStore US</a><br>
							<a href="http://astore.amazon.co.jp/musicwhoreorg-22">Musicwhore.org aStore Japan</a><br>
						</p>
					</div>

{*
					<script type="text/javascript">
						google_ad_client = "pub-7826276896407540";
						google_ad_width = 120;
						google_ad_height = 240;
						google_ad_format = "120x240_as";
						google_ad_channel ="";
						google_color_border = "CCCC99";
						google_color_bg = "333333";
						google_color_link = "FF9999";
						google_color_url = "FFCC00";
						google_color_text = "000000";
					</script>
					<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script><br>
*}
				</aside>
			</div>
		</div>

		<script type="text/javascript">
			{literal}
			var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
			document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
			</script>
			<script type="text/javascript">
			try {
			var pageTracker = _gat._getTracker("UA-7828220-3");
			pageTracker._trackPageview();
			} catch(err) {}
			{/literal}
		</script>

	</body>
</html>
