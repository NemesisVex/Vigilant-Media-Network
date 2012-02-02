<div id="tabs">
	<ul>
		<li><a href="#albums">Albums</a></li>
		<li><a href="#releases">Releases</a></li>
		<li><a href="#audio">Audio</a></li>
		<li><a href="#artist-info">Artist Info</a></li>
	</ul>
	
	<div id="artist-info">
		<form action="/index.php/ep4/artist/update/{$artist_id}/" method="post" name="artist-form" id="artist-form">
			<p>
				<label for="artist_last_name">Last name/Band name:</label>
				<input type="text" name="artist_last_name" value="{$rsArtist->artist_last_name|escape:htmlall}" size="45" />
			</p>

			<p>
				<label for="artist_last_name">First name:</label>
				<input type="text" name="artist_first_name" value="{$rsArtist->artist_first_name|escape:htmlall}" size="45" />
			</p>

			<p>
				<label for="artist_url">URL:</label>
				<input type="text" name="artist_url" value="{$rsArtist->artist_url|escape:htmlall}" size="45" />
			</p>

			<p>
				<label for="artist_bio">Biography:</label>
				<textarea name="artist_bio">{$rsArtist->artist_bio|escape:htmlall}</textarea>
			</p>

			<p>
				<label for="artist_bio_more">Biography (more):</label>
				<textarea name="artist_bio_more">{$rsArtist->artist_bio_more|escape:htmlall}</textarea>
			</p>

			<p>
			{if $artist_id}<input type="hidden" name="artist_id" value="{$artist_id}" />{/if}
			<input type="submit" value="Save" />
			</p>
		</form>
	</div>
	
	<div id="albums">
		<p>
			<a href="/index.php/ep4/album/add/{$artist_id}/"><img src="{$config.to_vigilante}/images/icons/add-page-blue.gif" alt="[EDIT]" /></a>
			<a href="/index.php/ep4/album/add/{$artist_id}/">Add an album</a>
		</p>

	{if $rsAlbums}
		<ul id="album-list">
	{foreach item=rsAlbum from=$rsAlbums}
	{assign var=wrp_file value=$config.ep4_cover_root_path|cat:"/_exm_front_120_"|cat:$rsAlbum->album_image}
		<li>
			<a href="/index.php/ep4/album/edit/{$rsAlbum->album_id}/"><img src="{if $rsArtist->artist_url}{$rsArtist->artist_url}{else}{$config.to_eponymous4}{/if}/images/_covers/_{if file_exists($wrp_file)}exm{else}color{/if}_front_120_{$rsAlbum->album_image}" alt="[{$rsAlbum->album_title}]" title="[{$rsAlbum->album_title}]" /></a>
		</li>
	{/foreach}
		</ul>
	{/if}
	
	</div>
	
	<div id="releases">
		<p>
			<a href="/index.php/ep4/release/add/{$artist_id}/"><img src="{$config.to_vigilante}/images/icons/add-page-blue.gif" alt="[EDIT]" /></a>
			<a href="/index.php/ep4/release/add/{$artist_id}/">Add a release</a>
		</p>

	{if $rsReleases}
		<table class="Admin">
			<tr>
				<th></th>
				<th>TITLE</th>
				<th>FORMAT</th>
				<th>CATALOG NO.</th>
				<th>VISIBLE</th>
			</tr>
		{foreach item=rsRelease from=$rsReleases}
			<tr>
				<td>
					<a href="/index.php/ep4/release/edit/{$rsRelease->release_id}/"><img src="{$config.to_vigilante}/images/icons/edit-page-yellow.gif" /></a>
					<a href="/index.php/ep4/release/delete/{$rsRelease->release_id}/"><img src="{$config.to_vigilante}/images/icons/delete-page-yellow.gif" /></a>
				</td>
				<td>{$rsRelease->album_title}</td>
				<td>{$rsRelease->format_name}</td>
				<td>{$rsRelease->release_catalog_num}</td>
				<td>{if $rsRelease->release_is_visible==1}Yes{else}No{/if}</td>
			</tr>
		{/foreach}
		</table>
	{/if}
	</div>
	
	<div id="audio">
		<p>
			<a href="/index.php/ep4/audio/add/{$artist_id}/"><img src="{$config.to_vigilante}/images/icons/add-page-blue.gif" alt="[EDIT]" /></a>
			<a href="/index.php/ep4/audio/add/{$artist_id}/">Add an audio file</a>
		</p>
		
	{if $rsFiles}
		<ul class="browse-list">
		{foreach item=rsFile from=$rsFiles}
			<li class="browse-info">
				<a href="/index.php/ep4/audio/edit/{$rsFile->audio_id}/{$artist_id}/"><img src="{$config.to_vigilante}/images/icons/edit-page-yellow.gif" alt="[EDIT]" /></a>
				<a href="/index.php/ep4/audio/delete/{$rsFile->audio_id}/{$artist_id}/"><img src="{$config.to_vigilante}/images/icons/delete-page-yellow.gif" alt="[EDIT]" /></a>
				<a href="/index.php/ep4/audio/edit/{$rsFile->audio_id}/{$artist_id}/">{$rsFile->audio_mp3_file_path}/{$rsFile->audio_mp3_file_name}</a>
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

