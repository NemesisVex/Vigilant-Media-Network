<div id="column-1" class="span-17 append-1">
{include file=obr_global_header.tpl}

	{if !empty($rsFile)}
	<p>
		<a href="/index.php/admin/audio/edit/{$audio_id}/" class="button"><img src="{$config.to_vigilante}/images/icons/edit-page-blue.gif" alt="[Edit]" title="[Edit]" /> Edit</a>
		<a href="/index.php/admin/audio/delete/{$audio_id}/" class="button"><img src="{$config.to_vigilante}/images/icons/edit-page-blue.gif" alt="[Delete]" title="[Delete]" /> Delete</a>
	</p>

	<ul class="two-column-bubble-list">
		<li>
			<div>
				<label>File name</label> {$rsFile->audio_mp3_file_name}
			</div>
		</li>
		<li>
			<div>
				<label>File path</label> {$rsFile->audio_mp3_file_path}
			</div>
		</li>
		<li>
			<div>
				<label>Display label</label> {$rsFile->audio_display_label}
			</div>
		</li>
		<li>
			<div>
				<label>File type</label> {$rsFile->audio_file_type}
			</div>
		</li>
	</ul>
	{else}
		<p>This audio file has no information.</p>
	{/if}
</div>

<div id="column-2" class="span-6 last">
	{if !empty($rsFile)}
	<h3>Listen</h3>
	
	<p>
		<a href="{$rsFile->audio_mp3_file_path}/{$rsFile->audio_mp3_file_name}" type="audio/mpeg" class="htrack" title="{$rsFile->song_title}">{$rsFile->song_title}</a>
	</p>
	{/if}
</div>
