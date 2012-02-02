<div id="tabs">
	<ul>
		<li><a href="#album-releases">Releases</a></li>
		<li><a href="#album-info">Album info</a></li>
	</ul>

	<div id="album-info">
		<form action="/index.php/ep4/album/{if $album_id}update/{$album_id}{else}create{/if}/{$album_artist_id}/" method="post" name="album">

			{if $album_artist_id}<input type="hidden" name="album_artist_id" value="{$album_artist_id}">{/if}

			{if $album_id}<p>
				<label for="album_id">ID:</label>
				{$album_id}<input type="hidden" name="album_id" value="{$album_id}" />
			</p>{/if}

			<p>
				<label for="album_title">Title:</label>
				<input type="text" name="album_title" value="{$rsAlbum->album_title}" size="50" />
			</p>

			<p>
				<label for="album_alias">Alias:</label>
				<input type="text" name="album_alias" value="{$rsAlbum->album_alias}" size="50" />
			</p>

			<p>
				<label for="album_alias">Title locale:</label>
				<select name="album_ctype_locale">
					<option value="">&nbsp;</option>
					<option value="en"{if $rsAlbum->album_ctype_locale=='en'} selected{/if}>en</option>
					<option value="ja"{if $rsAlbum->album_ctype_locale=='ja'} selected{/if}>ja</option>
				</select>
			</p>

			<p>
				<label for="album_format_mask">Format:</label>
				<select name="album_format_mask">
					{foreach key=format_mask item=format_name from=$config.album_format_mask}
						<option value="{$format_mask}"{if $rsAlbum->album_format_mask==$format_mask} selected{/if}> {$format_name}
						{/foreach}
				</select>
			</p>

			<p>
				<label for="album_image">Image File:</label>
				<input type="text" name="album_image" value="{$rsAlbum->album_image}" size="50" />
			</p>

			<p>
				<label for="album_music_description">Description:</label>
				<textarea name="album_music_description" cols="40" rows="7">{$rsAlbum->album_music_description|escape:"html"}</textarea>
			</p>

			<p>
				<label for="album_is_visible">Visibility:</label>
				<input type="radio" name="album_is_visible" value="1"{if $rsAlbum->album_is_visible==1} checked{/if} /> Show
				<input type="radio" name="album_is_visible" value="0"{if $rsAlbum->album_is_visible==0} checked{/if} /> Hide
			</p>


			<p>
				<input type="submit" value="Update">
			</p>

			<p>
				<a href="/index.php/ep4/album/delete/{$album_id}/"><img src="{$config.to_vigilante}/images/icons/delete-page-yellow.gif" alt="[DELETE]" /></a>
				<a href="/index.php/ep4/album/delete/{$album_id}/">Delete album</a>
			</p>

		</form>
	</div>

	<div id="album-releases">
	{if $album_id}
		<p>
			<a href="/index.php/ep4/release/add/{$rsAlbum->album_artist_id}/{$album_id}/"><img src="{$config.to_vigilante}/images/icons/add-page-blue.gif" alt="[ADD]" /></a>
			<a href="/index.php/ep4/release/add/{$rsAlbum->album_artist_id}/{$album_id}/">Add a release</a>
		</p>
		
	{if $rsReleases}
		<ul class="browse-list">
	{foreach item=rsRelease from=$rsReleases}
			<li class="browse-info">
				<a href="/index.php/ep4/release/edit/{$rsRelease->release_id}/{$album_artist_id}/"><img src="{$config.to_vigilante}/images/icons/edit-page-yellow.gif" alt="[EDIT]" /></a>
				<a href="/index.php/ep4/release/delete/{$rsRelease->release_id}/{$album_artist_id}/"><img src="{$config.to_vigilante}/images/icons/delete-page-yellow.gif" alt="[DELETE]" /></a>
				<a href="/index.php/ep4/release/edit/{$rsRelease->release_id}/{$album_artist_id}/">{$rsRelease->format_name}{if $rsRelease->release_catalog_num} ({$rsRelease->release_catalog_num}){/if}</a>
			</li>
	{/foreach}
		</ul>
	{else}
		<p>This album has no releases yet. <a href="/index.php/ep4/release/{$album_artist_id}/{$album_id}/">Create one</a>.</p>
	{/if}
	{else}
		<p>An album must be created before releases can exist.</p>
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

