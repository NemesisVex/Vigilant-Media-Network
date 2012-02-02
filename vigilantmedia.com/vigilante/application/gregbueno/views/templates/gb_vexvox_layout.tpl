<!DOCTYPE html>
<html lang="en">
	<head>
		<title>VexVox{if $page_title}: {$page_title}{/if}</title>
		<meta charset="utf-8" />
		<link rel="alternate" type="application/rss+xml" title="VexVox RSS" href="http://www.gregbueno.com/mt/vexvox_index.xml" />
		<link rel="icon" href="/images/gbueno.ico" type="image/vnd.microsoft.icon" />
		<link rel="shortcut icon" href="/images/gbueno.ico" type="image/x-icon" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/screen.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/print.css" type="text/css" media="print" />
		<!--[if IE]><link rel="stylesheet" href="{$config.to_vigilante}/css/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->
		<link rel="stylesheet" href="/css/greg.css" type="text/css" media="screen, projection" />
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.validate.pack.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.cookie.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.swfobject.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.swfobject.ext.js"></script>
		<script type="text/javascript" src="{$config.to_vigilante}/js/modernizr-1.6.min.js"></script>
		<!--[if lt IE9]<script type="text/javascript" src="{$config.to_vigilante}/js/html5.js"></script>[/if]-->
	</head>

	<body>
		<div id="container" class="container">

			<div id="frame-1" class="span-16">
				<header id="masthead" class="span-14 prepend-1 append-1 append-bottom">
					<h1 id="title"><a href="/index.php/vexvox/">VexVox</a></h1>
				</header>

				<div class="span-14 append-1 prepend-1">
{if $section_head}
					<header>
{/if}
{if $section_label}
						<hgroup>
{/if}
{if $section_head}
							<h1>{$section_head}</h1>
{/if}

{if $section_label}
							<h2>{$section_label}</h2>
{/if}
{if $section_label}
						</hgroup>
{/if}
{if $section_head}
					</header>
{/if}

					<section id="content">
{if $content_template}{include file=$content_template}{/if}
					</section>
				</div>
			</div>

			<aside id="frame-2" class="span-8 prepend-top last">
				<h3>About this weblog</h3>

				<p>First, there was 「日々の本」, an online journal I kept for 10 years. Six months after I retired that site, I felt the urge to start keeping a journal again. So I signed up for a Vox account. Then Vox shut down in 2010. I moved those entries back here.</p>

				<p>Notice I don't call it a weblog. This site is a journal in the traditional sense.</p>

				<nav>
					<ul>
						<li> <a href="/index.php/gb/contact/">Contact</a></li>
						<li> <a href="/">Gregbueno.com</a></li>
					</ul>
				</nav>

				<p><a href="/mt/vexvox_index.xml"><img src="/images/rss_button.gif" alt="[RSS]" width="36" height="14" title="[RSS]" /></a></p>

				<hr />

				<h3>Search</h3>

				<form method="get" action="{$config.to_mt}/cgi-bin/mt/mt-search.cgi">
					<p>
						<strong>Search</strong><br />
						<input type="hidden" name="IncludeBlogs" value="{$blog_id}" />
						<input type="hidden" name="Template" value="vexvoxsearch" />
						<input id="search" name="search" size="20" />
						<input type="submit" value="Go" />
					</p>
				</form>

				<hr />

				<h3>Calendar</h3>

				<nav>
					<ul>
{foreach item=rsCalendar from=$rsCalendar name=archive}
						<li> <a href="/index.php/vexvox/date/{$rsCalendar->entry_year}/">{$rsCalendar->entry_year}</a></li>
{/foreach}
					</ul>
				</nav>

				<hr />

{include file=gb_root__links.tpl}
			</aside>

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
