{include file=obr_global_header.tpl}

<p>
	<a href="/index.php/admin/song/add/{$artist_id}/" class="button"><img src="{$config.to_vigilante}/images/icons/add-page-blue.gif" alt="[Add song]" title="[Add song]" /> Add a song</a>
</p>

{if (!empty($rsSongs))}
<ul class="two-column-bubble-list">
	{foreach item=rsSong from=$rsSongs}
	<li>
		<div>
			<a href="/index.php/admin/song/edit/{$rsSong->song_id}/"><img src="{$config.to_vigilante}/images/icons/edit-page-purple.gif" alt="[Edit]" title="[Edit]" /></a>
			{if ENVIRONMENT=='dev' || ENVIRONMENT=='development'}<a href="/index.php/admin/song/delete/{$rsSong->song_id}/"><img src="{$config.to_vigilante}/images/icons/delete-page-purple.gif" alt="[Delete]" title="[Delete]" /></a>{/if}
			<a href="/index.php/admin/song/view/{$rsSong->song_id}/">{$rsSong->song_title}</a>
		</div>
	</li>
	{/foreach}
</ul>
{else}
<p>
	This artist has no songs. Please add one.
</p>
{/if}
