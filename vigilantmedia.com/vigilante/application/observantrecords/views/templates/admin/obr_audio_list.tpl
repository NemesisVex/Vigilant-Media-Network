{include file=obr_global_header.tpl}

<p>
	<a href="/index.php/admin/audio/add/{$artist_id}/" class="button"><img src="{$config.to_vigilante}/images/icons/add-page-blue.gif" alt="[Add audio file]" title="[Add audio file]" /> Add audio file</a>
</p>

{if (!empty($rsFiles))}
<ul class="two-column-bubble-list">
	{foreach item=rsFile from=$rsFiles}
	<li>
		<div>
			<a href="/index.php/admin/audio/view/{$rsFile->audio_id}/" title="{$rsFile->audio_mp3_file_path}/{$rsFile->audio_mp3_file_name}">{$rsFile->song_title}</a>
		</div>
	</li>
	{/foreach}
</ul>
{else}
<p>
	This artist has no songs. Please add one.
</p>
{/if}
