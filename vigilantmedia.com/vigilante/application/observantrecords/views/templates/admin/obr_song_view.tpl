<div id="column-1" class="span-17 append-1">
{include file=obr_global_header.tpl}

	{if !empty($rsSong)}
	<p>
		<a href="/index.php/admin/song/edit/{$song_id}/" class="button"><img src="{$config.to_vigilante}/images/icons/edit-page-blue.gif" alt="[Edit]" title="[Edit]" /> Edit</a>
		<a href="/index.php/admin/song/delete/{$song_id}/" class="button"><img src="{$config.to_vigilante}/images/icons/delete-page-blue.gif" alt="[Edit]" title="[Edit]" /> Delete</a>
	</p>

	<ul class="two-column-bubble-list">
		<li>
			<div>
				<label>Title</label> {$rsSong->song_title}
			</div>
		</li>
		<li>
			<div>
				<label>Alias</label> {$rsSong->song_alias}
			</div>
		</li>
		<li>
			<div>
				<label>Influences</label> {$rsSong->song_influences}
			</div>
		</li>
		<li>
			<div>
				<label>Style</label> {$rsSong->song_style}
			</div>
		</li>
		<li>
			<div>
				<label>Date written</label> {$rsSong->song_written_date}
			</div>
		</li>
		<li>
			<div>
				<label>Date revised</label> {$rsSong->song_revised_date}
			</div>
		</li>
		<li>
			<div>
				<label>Date recorded</label> {$rsSong->song_recorded_date}
			</div>
		</li>
	</ul>
	{else}
		<p>This song has no information.</p>
	{/if}
</div>

<div id="column-2" class="span-6 last">
</div>
