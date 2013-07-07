{include file=obr_global_header.tpl}

<p>
	<a href="/index.php/admin/recording/add/{$artist_id}/" class="button"><img src="{$config.to_vigilante}/images/icons/add-page-blue.gif" alt="[Add audio file]" title="[Add audio file]" /> Add recording</a>
</p>

{if (!empty($rsRecordings))}
<ul class="two-column-bubble-list">
	{foreach item=rsRecording from=$rsRecordings}
	<li>
		<div>
			<a href="/index.php/admin/recording/edit/{$rsRecording->recording_id}/"><img src="{$config.to_vigilante}/images/icons/edit-page-purple.gif" alt="[Edit]" title="[Edit]" /></a>
			<a href="/index.php/admin/recording/delete/{$rsRecording->recording_id}/"><img src="{$config.to_vigilante}/images/icons/delete-page-purple.gif" alt="[Delete]" title="[Delete]" /></a>
			<a href="/index.php/admin/recording/view/{$rsRecording->recording_id}/">{if empty($rsRecording->recording_isrc_num)}ISRC TBD{else}{$rsRecording->recording_isrc_num}{/if}: {$rsRecording->song->song_title}</a>
		</div>
	</li>
	{/foreach}
</ul>
{else}
<p>
	This artist has no songs. Please add one.
</p>
{/if}
