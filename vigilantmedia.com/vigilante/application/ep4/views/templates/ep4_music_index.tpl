				<div id="column-1" class="span-22 prepend-1 append-1">
					<header>
						<h2>Music</h2>
					</header>

					
{if $rsDigitals}
					<ul class="album-list">
{foreach key=e item=rsDigital from=$rsDigitals name=digital}
{assign var=wrp_file value=$config.ep4_cover_root_path|cat:"/_exm_front_200_"|cat:$rsDigital->album_image}
					<li> <a href="/index.php/music/digital/{$rsDigital->album_alias}/" class="no-fx"><img src="/images/_covers/_{if file_exists($wrp_file)}exm{else}color{/if}_front_200_{$rsDigital->album_image}" alt="[{if $rsDigital->release_alternate_title}{$rsDigital->release_alternate_title}{else}{$rsDigital->album_title}{/if}]" title="[{if $rsDigital->release_alternate_title}{$rsDigital->release_alternate_title}{else}{$rsDigital->album_title}{/if}]" width="200" height="200" class="album-cover"></a></li>
{/foreach}
					</ul>
{else}
					<p>No digital albums are available.</p>
{/if}
				</div>

