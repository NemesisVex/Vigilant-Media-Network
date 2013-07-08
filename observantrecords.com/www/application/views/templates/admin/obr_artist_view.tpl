<div id="admin-column-1">
{include file=obr_global_header.tpl}

	{if !empty($rsArtist)}
	<h3>Artist Info</h3>

	<p>
		<a href="/index.php/admin/artist/edit/{$rsArtist->artist_id}/" class="button"><img src="{$config.to_vigilante}/images/icons/edit-page-blue.gif" /> Edit</a>
		<a href="/index.php/admin/artist/delete/{$rsArtist->artist_id}/" class="button"><img src="{$config.to_vigilante}/images/icons/delete-page-blue.gif" /> Delete</a>
	</p>

	<ul class="two-column-bubble-list">
		<li>
			<div>
				<label>Last name:</label> {$rsArtist->artist_last_name}
			</div>
		</li>
	{if !empty($rsArtist->artist_first_name)}
		<li>
			<div>
				<label>First name:</label> {$rsArtist->artist_first_name}
			</div>
		</li>
	{/if}
	{if !empty($rsArtist->artist_display_name)}
		<li>
			<div>
				<label>Display name:</label> {$rsArtist->artist_display_name}
			</div>
		</li>
	{/if}
	{if !empty($rsArtist->artist_alias)}
		<li>
			<div>
				<label>Alias:</label> {$rsArtist->artist_alias}
			</div>
		</li>
	{/if}
	{if !empty($rsArtist->artist_url)}
		<li>
			<div>
				<label>URL:</label> <a href="{$rsArtist->artist_url}">{$rsArtist->artist_url}</a>
			</div>
		</li>
	{/if}
	</ul>

	<h3>Albums</h3>

	<p>
		<a href="/index.php/admin/album/add/{$artist_id}/" class="button"><img src="{$config.to_vigilante}/images/icons/add-page-blue.gif" /> Add album</a>
	</p>

	{if $rsAlbums}
		<ul class="two-column-bubble-list">
		{foreach item=rsAlbum from=$rsAlbums}
			<li>
				<div>
					<a href="/index.php/admin/album/edit/{$rsAlbum->album_id}/"><img src="{$config.to_vigilante}/images/icons/edit-page-blue.gif" alt="[Edit]" title="[Edit]" /></a>
					<a href="/index.php/admin/album/delete/{$rsAlbum->album_id}/"><img src="{$config.to_vigilante}/images/icons/delete-page-blue.gif" alt="[Delete]" title="[Delete]" /></a>
					<a href="/index.php/admin/album/view/{$rsAlbum->album_id}/">{$rsAlbum->album_title}</a>
				</div>
			</li>
		{/foreach}
		</ul>
	{else}
	<p>
		This artist has no albums. Please add one.
	</p>
	{/if}

	<h3>Catalogs</h3>

	<ul>
		<li><a href="/index.php/admin/song/browse/{$artist_id}/">Songs</a></li>
		<li><a href="/index.php/admin/recording/browse/{$artist_id}/">Recordings</a></li>
	</ul>

	{else}
		<p>Artist information is not available.</p>
	{/if}
</div>

<div id="admin-column-2">
</div>
