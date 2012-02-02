<div id="tabs">
	<ul>
		<li><a href="#artists">Artists</a></li>
		<li><a href="#songs">Songs</a></li>
		<li><a href="#files">Files</a></li>
	</ul>
	
	<div id="artists">
		<p>
			<a href="/index.php/ep4/artist/add/"><img src="{$config.to_vigilante}/images/icons/add-page-blue.gif" alt="[ADD]" /></a>
			<a href="/index.php/ep4/artist/add/">Add an artist</a>
		</p>

	{if $rsArtists}
		<ul class="browse-list">
		{foreach item=rsArtist from=$rsArtists}
			<li class="browse-info">
				<a href="/index.php/ep4/artist/info/{$rsArtist->artist_id}/"><img src="{$config.to_vigilante}/images/icons/edit-page-yellow.gif" alt="[EDIT]" /></a>
				<a href="/index.php/ep4/artist/delete/{$rsArtist->artist_id}/"><img src="{$config.to_vigilante}/images/icons/delete-page-yellow.gif" alt="[DELETE]" /></a>
				<a href="/index.php/ep4/artist/info/{$rsArtist->artist_id}/">{format_artist_name_object obj=$rsArtist}</a>
			</li>
		{/foreach}
		</ul>
	{/if}
	</div>
	
	<div id="songs">
		<p>
			<a href="/index.php/ep4/song/add/"><img src="{$config.to_vigilante}/images/icons/add-page-blue.gif" alt="[ADD]" /></a>
			<a href="/index.php/ep4/song/add/">Add a song</a>
		</p>

	{if $rsSongs}
		<ul class="browse-list">
		{foreach item=rsSong from=$rsSongs}
			<li class="browse-info">
				<a href="/index.php/ep4/song/edit/{$rsSong->song_id}/"><img src="{$config.to_vigilante}/images/icons/edit-page-yellow.gif" alt="[EDIT]" /></a>
				<a href="/index.php/ep4/song/delete/{$rsSong->song_id}/"><img src="{$config.to_vigilante}/images/icons/delete-page-yellow.gif" alt="[DELETE]" /></a>
				<a href="/index.php/ep4/song/edit/{$rsSong->song_id}/">{$rsSong->song_title}</a>
			</li>
		{/foreach}
		</ul>
	{/if}
	</div>
	
	<div id="files">
		<p>
			<a href="/index.php/ep4/file/add/"><img src="{$config.to_vigilante}/images/icons/add-page-blue.gif" alt="[ADD]" /></a>
			<a href="/index.php/ep4/file/add/">Add a file</a>
		</p>

	{if $rsObrFiles}
		<ul class="browse-list">
		{foreach item=rsObrFile from=$rsObrFiles}
			<li class="browse-info">
				<a href="/index.php/ep4/file/edit/{$rsObrFile->file_id}/"><img src="{$config.to_vigilante}/images/icons/edit-page-yellow.gif" alt="[EDIT]" /></a>
				<a href="/index.php/ep4/file/delete/{$rsObrFile->file_id}/"><img src="{$config.to_vigilante}/images/icons/delete-page-yellow.gif" alt="[DELETE]" /></a>
				<a href="/index.php/ep4/file/edit/{$rsObrFile->file_id}/">{if $rsObrFile->file_label}{$rsObrFile->file_label}{else}{$rsObrFile->file_path}/{$rsObrFile->file_name}{/if}</a>
			</li>
		{/foreach}
		</ul>
	{/if}
	</div>
</div>

{literal}
<script type="text/javascript">
	$(document).ready(function () {
		$('#tabs').tabs({
			cookie: {
				expires: 30
			}
		});
	});
</script>
{/literal}

