			<div id="column-1" class="span-15 append-1">
{include file=obr_global_header.tpl}
			
				<section>
					
					{if $rsArtists}
					<ul>
						{foreach item=rsArtist from=$rsArtists}
						<li><a href="/index.php/admin/artist/{$rsArtist->artist_id}/">{$rsArtist->artist_display_name}</a></li>
						{/foreach}
					</ul>
					{/if}
				</section>

			</div>

			<div id="column-2" class="span-8 last">
			</div>
