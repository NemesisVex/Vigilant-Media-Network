<div id="column-1" class="span-17 append-1">
{include file=obr_global_header.tpl}

	{if !empty($rsTrack)}
	<p>
		<a href="/index.php/admin/track/edit/{$track_id}/" class="button"><img src="{$config.to_vigilante}/images/icons/edit-page-blue.gif" alt="[Edit]" title="[Edit]" /> Edit</a>
		<a href="/index.php/admin/track/delete/{$track_id}/" class="button"><img src="{$config.to_vigilante}/images/icons/delete-page-blue.gif" alt="[Delete]" title="[Delete]" /> Delete</a>
	</p>

	<ul class="two-column-bubble-list">
		<li>
			<div>
				<label>Title</label> {$rsTrack->song_title}
			</div>
		</li>
		<li>
			<div>
				<label>Disc no.</label> {$rsTrack->track_disc_num}
			</div>
		</li>
		<li>
			<div>
				<label>Disc no.</label> {$rsTrack->track_track_num}
			</div>
		</li>
		{if $rsTrack->track_alias}
		<li>
			<div>
				<label>Alias</label> {$rsTrack->track_alias}
			</div>
		</li>
		{/if}
		{if $rsTrack->track_isrc_num}
		<li>
			<div>
				<label>ISRC no.</label> {$rsTrack->track_isrc_num}
			</div>
		</li>
		{/if}
		<li>
			<div>
				<label>Visible?</label> <input type="checkbox" disabled="disabled" value="1"{if ($rsTrack->track_is_visible == true)} checked{/if} />
			</div>
		</li>
		<li>
			<div>
				<label>Playable?</label> <input type="checkbox" disabled="disabled" value="1"{if ($rsTrack->track_audio_is_linked == true)} checked{/if} />
			</div>
		</li>
		<li>
			<div>
				<label>Downloadable?</label> <input type="checkbox" disabled="disabled" value="1"{if ($rsTrack->track_audio_is_downloadable == true)} checked{/if} />
			</div>
		</li>
		{if $rsTrack->track_uplaya_score}
		<li>
			<div>
				<label>uPlaya score</label> {$rsTrack->track_uplaya_score}
			</div>
		</li>
		{/if}
	</ul>
	
	<h3>Audio</h3>
	
	{if !empty($rsTrack->track_audio_id)}
		<ol class="track-list">
			<li>
				<div>
					<a href="/index.php/admin/audio/edit/{$rsTrack->audio_id}/"><img src="{$config.to_vigilante}/images/icons/edit-page-purple.gif" alt="[Edit]" title="[Edit]" /></a>
					<a href="/index.php/admin/audio/delete/{$rsTrack->audio_id}/"><img src="{$config.to_vigilante}/images/icons/delete-page-purple.gif" alt="[Delete]" title="[Delete]" /></a>
					<a href="/index.php/admin/audio/view/{$rsTrack->audio_id}/" title="{$rsTrack->audio_mp3_file_path}/{$rsTrack->audio_mp3_file_name}">{$rsTrack->audio_mp3_file_name}</a>
				</div>
			</li>
		</ol>
	{else}
		<p>This track has no audio information.</p>
	{/if}
	
	{else}
		<p>This song has no information.</p>
	{/if}
</div>

<div id="column-2" class="span-6 last">
</div>
