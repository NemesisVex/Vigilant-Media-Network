			<div id="column-1" class="span-15 append-1">
{include file=obr_global_header.tpl}

				<section>
					<header>
						<h3>Artists</h3>
					</header>

					<p>
						<a href="/index.php/admin/artist/add/"><img src="{$config.to_vigilante}/images/icons/add-page-blue.gif" alt="[Add an artist]" title="[Add an artist]" /></a>
						<a href="/index.php/admin/artist/add/">Add an artist</a>
					</p>

					{if $rsArtists}
					<ul>
						{foreach item=rsArtist from=$rsArtists}
						<li><a href="/index.php/admin/artist/view/{$rsArtist->artist_id}/">{$rsArtist->artist_display_name}</a></li>
						{/foreach}
					</ul>
					{/if}
				</section>
			</div>

			<div id="column-2" class="span-8 last">
			</div>
