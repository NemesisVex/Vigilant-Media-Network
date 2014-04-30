<!DOCTYPE html>
<html lang="en">
	<head>
		<title>作譜{if $page_title}: {$page_title}{/if}</title>
		<meta charset="utf-8" />
		<link rel="alternate" type="application/rss+xml" title="作譜 RSS" href="http://www.gregbueno.com/mt/sakufu_index.xml" />
		<link rel="icon" href="/images/sakufu.ico" type="image/vnd.microsoft.icon" />
		<link rel="shortcut icon" href="/images/sakufu.ico" type="image/x-icon" />
		<link rel="stylesheet" href="{$smarty.const.VIGILANTMEDIA_CDN_BASE_URI}/web/css/blueprint/screen.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="{$smarty.const.VIGILANTMEDIA_CDN_BASE_URI}/web/css/blueprint/print.css" type="text/css" media="print" />
		<!--[if lt IE 8]><link rel="stylesheet" href="{$smarty.const.VIGILANTMEDIA_CDN_BASE_URI}/web/css/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->
		<link rel="stylesheet" href="/css/greg.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="/css/sakufu.css" type="text/css" />
		<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
		<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script type="text/javascript" src="{$smarty.const.VIGILANTMEDIA_CDN_BASE_URI}/web/js/modernizr-1.6.min.js"></script>
		<!--[if lt IE 9]><script type="text/javascript" src="{$smarty.const.VIGILANTMEDIA_CDN_BASE_URI}/web/js/html5.js"></script><![endif]-->
	</head>

	<body>
		<div id="container" class="container">

			<div id="frame-1" class="span-16">
				<div id="masthead" class="span-14 prepend-1 append-1 append-bottom">
					<header>
						<h1 id="title"><a href="/index.php/sakufu/">作譜</a></h1>
					</header>
				</div>

				<div class="span-14 append-1 prepend-1">
{if $section_head}<header>{/if}
{if $section_label}<hgroup>{/if}
{if $section_head}<h1>{$section_head}</h1>{/if}
{if $section_label}<h2>{$section_label}</h2>{/if}
{if $section_label}</hgroup>{/if}
{if $section_head}</header>{/if}

{if $content_template}{include file=$content_template}{/if}
				</div>
			</div>

			<div id="frame-2" class="span-8 prepend-top last">

				<h3>About this weblog</h3>

				<p>
					「作譜」 is pronounced &quot;sakufu&quot;, and it means &quot;log&quot; or &quot;work file&quot; in Japanese. It's not the correct translation of &quot;weblog&quot;, but it seems appropriate for this site.
				</p>

				<p>This site started as a general dumping ground for external links, but these days, it's where I think about things related to the various technologies with which I work -- digital audio, web software engineering.</p>

				<nav>
					<ul>
						<li> <a href="/index.php/gb/contact/">Contact</a></li>
						<li> <a href="/">Gregbueno.com</a></li>
					</ul>
				</nav>

				<p><a href="/mt/sakufu_index.xml"><img src="/images/rss_button.gif" alt="[RSS]" width="36" height="14" title="[RSS]" /></a></p>

				<hr />

				<h3>Search</h3>

				<form method="post" action="{$config.to_mt}/cgi-bin/mt/mt-search.cgi">
					<p>
						<input type="hidden" name="IncludeBlogs" value="{$blog_id}" />
						<input type="hidden" name="Template" value="sakufusearch" />
						<input type="search" id="search" name="search" size="20" />
						<input type="submit" value="Go" />
					</p>
				</form>

				<hr />

				<div class="span-4">
					<h3>Categories</h3>

					<nav>
						<ul>
{foreach item=rsCategories from=$rsCategories name=categories}
							<li> <a href="/index.php/sakufu/category/{$rsCategories->category_id}/">{$rsCategories->category_label}</a></li>
{/foreach}
						</ul>
					</nav>
				</div>

				<div class="span-4 last">
					<h3>Calendar</h3>

					<nav>
						<ul>
{foreach item=rsCalendar from=$rsCalendar name=archive}
							<li> <a href="/index.php/sakufu/date/{$rsCalendar->entry_year}/">{$rsCalendar->entry_year}</a></li>
{/foreach}
						</ul>
					</nav>
				</div>


				<hr />

{include file=gb_root__links.tpl}

			</div>

		</div>


		<script type="text/javascript" src="http://embed.technorati.com/embed/8h588zcn3.js"></script>
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
