<div id="column-1" class="span-17 append-1">
{include file=obr_global_header.tpl}

	{if !empty($rsTrack)}
	<p>
		<a href="/index.php/admin/track/edit/{$track_id}/" class="button"><img src="{$config.to_vigilante}/images/icons/edit-page-blue.gif" alt="[Edit]" title="[Edit]" /> Edit</a>
	</p>

	<ul class="two-column-bubble-list">
		<li>
			<div>
				<label>Title</label> {$rsTrack->song_title}
			</div>
		</li>
	</ul>
	{else}
		<p>This song has no information.</p>
	{/if}
</div>

<div id="column-2" class="span-6 last">
</div>
