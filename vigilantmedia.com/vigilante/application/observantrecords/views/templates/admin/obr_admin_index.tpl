			<div id="column-1" class="span-17 append-1">
{include file=obr_global_header.tpl}

	<section>
		<header>
			<h3>Artists</h3>
		</header>

		<p>
			<a href="/index.php/admin/artist/add/" class="button"><img src="{$config.to_vigilante}/images/icons/add-page-blue.gif" alt="[Add an artist]" title="[Add an artist]" /> Add an artist</a>
		</p>

		{if $rsArtists}
		<ul class="two-column-bubble-list">
			{foreach item=rsArtist from=$rsArtists}
			<li>
				<div>
					<a href="/index.php/admin/artist/edit/{$rsArtist->artist_id}/"><img src="{$config.to_vigilante}/images/icons/edit-page-purple.gif" alt="[Edit]" title="[Edit]" /></a>
					{if ENVIRONMENT=='dev' || ENVIRONMENT=='development'}<a href="/index.php/admin/artist/delete/{$rsArtist->artist_id}/"><img src="{$config.to_vigilante}/images/icons/delete-page-purple.gif" alt="[Delete]" title="[Delete]" /></a>{/if}
					<a href="/index.php/admin/artist/view/{$rsArtist->artist_id}/" title="[View {$rsArtist->artist_display_name}]">{$rsArtist->artist_display_name}</a>
				</div>
			</li>
			{/foreach}
		</ul>
		{/if}
	</section>
			</div>

			<div id="column-2" class="span-6 last">
			</div>
