<!--[if lte IE 6]>
<div id="ie6">
<a href="#ie6_warning" rel="facebox"></a>
<div id="ie6_warning">
<h1>Please upgrade your browser</h1>

<p>Sorry for the inconvenience, but Internet Explorer 6 doesn't really work with the Eponymous 4 official website.</p>

<p>You can get the best results by upgrading your browser.</p>

<ul>
<li> <a href="http://www.mozilla.com/">Mozilla Firefox</a></li>
<li> <a href="http://www.microsoft.com/Windows/internet-explorer/">Microsoft Internet Explorer 9</a></li>
<li> <a href="http://www.google.com/chrome">Google Chrome</a></li>
<li> <a href="http://www.opera.com/">Opera</a></li>
<li> <a href="http://www.apple.com/safari/">Safari</a></li>
</ul>
</div>
</div>
<![endif]-->

{if $rsReleases}
				<div id="featured" class="span-22 append-1 prepend-1 append-bottom last">

					<header>
						<h2>Music</h2>
					</header>

					<section>
						<ul id="album-carousel" class="jcarousel-skin-ep4">
						{foreach item=rsRelease from=$rsReleases}
						{assign var=wrp_file value=$config.ep4_cover_root_path|cat:"/_exm_front_200_"|cat:$rsRelease->album_image}
							<li><a href="/index.php/music/digital/{$rsRelease->album_alias}/"><img src="/images/_covers/_{if file_exists($wrp_file)}exm{else}color{/if}_front_200_{$rsRelease->album_image}" alt="[{$rsRelease->album_title}]" title="[{$rsRelease->album_title}]" /></a></li>
						{/foreach}
						</ul>
						
						{literal}
						<script type="text/javascript">
							$(document).ready(function () {
								$('#album-carousel').jcarousel();
							});
						</script>
						{/literal}
					</section>
				</div>
{/if}
				
				<div id="column-1" class="span-14 prepend-1 append-1">

					<header>
						<h2>Blog</h2>
					</header>
{if $rsNews}
{foreach item=rsNewsItem from=$rsNews}
					<section>
						<header>
							<h3>{$rsNewsItem->entry_title}</h3>
						</header>

						<article>
{parse_line_breaks txt=$rsNewsItem->entry_text}

{if $rsNewsItem->entry_text_more}
							<p>
								<a href="/index.php/news/entry/{$rsNewsItem->entry_id}/">MORE</a> &raquo;
							</p>
{/if}

							<p>
								&#8212; <em>Posted <time datetime="{$rsNewsItem->entry_authored_on|date_format:"%Y-%m-%dT%H:%M:%S-06:00"}" pubdate><a href="/index.php/news/entry/{$rsNewsItem->entry_id}/">{$rsNewsItem->entry_authored_on|date_format:"%b %d, %Y %H:%M:%S"}</a></time></em>
							</p>
						</article>
					</section>
{/foreach}

					<p>
						<a href="/index.php/news/">More news</a> &raquo;
					</p>
{else}
					<p>
						No blog entries yet published.
					</p>
{/if}
				</div>

				<div id="column-2" class="span-6 prepend-1 append-1 last">
					<header>
						<h2>Links</h2>
					</header>

					<ul>
						<li> <a href="http://www.amazon.com/Eponymous-4/e/B001LHCBCQ">Amazon Central</a></li>
						<li> <a href="http://eponymous4.bandcamp.com/">Bandcamp</a></li>
						<li> <a href="http://www.cdbaby.com/Artist/Eponymous4">CD Baby</a></li>
						<li> <a href="http://www.facebook.com/eponymous4">Facebook</a></li>
						<li> <a href="http://www.ilike.com/artist/Eponymous+4">iLike</a></li>
						<li> <a href="http://www.last.fm/music/Eponymous+4">Last.fm</a></li>
						<li> <a href="http://www.myspace.com/eponymous4">MySpace</a></li>
						<li> <a href="http://www.soundcloud.com/observantrecords">SoundCloud</a></li>
						<li> <a href="http://twitter.com/eponymous4">Twitter</a></li>
						<li> <a href="http://www.youtube.com/user/observantrecords">YouTube</a></li>
					</ul>
					
					<p>
						<a href="{$config.to_observant}/"><img src="/images/observant_records_logo_200.png" width="200" alt="[Observant Records]" title="[Observant Records]" /></a>
					</p>
					
					{include file=ep4_root_links.tpl}
				</div>

				<script type="text/javascript" src="http://webplayer.yahooapis.com/player-beta.js"></script>