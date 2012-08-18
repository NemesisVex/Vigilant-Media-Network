<div id="column-1" class="span-17 append-1">
{include file=obr_global_header.tpl}

	{if !empty($rsAlbum)}
	<p>
		<a href="/index.php/admin/album/edit/{$album_id}/" class="button"><img src="{$config.to_vigilante}/images/icons/edit-page-blue.gif" alt="[Edit]" title="[Edit]" /> Edit</a>
	</p>

	<ul class="two-column-bubble-list">
		<li>
			<div>
				<label>Title</label> {$rsAlbum->album_title}
			</div>
		</li>
	{if !empty($rsAlbum->album_ctype_locale)}
		<li>
			<div>
				<label>Title locale</label> {$rsAlbum->album_ctype_locale}
			</div>
		</li>
	{/if}
	{if !empty($rsAlbum->album_release_date)}
		<li>
			<div>
				<label>Release Date</label> {$rsAlbum->album_release_date|date_format:"%m/%d/%Y"}
			</div>
		</li>
	{/if}
	{if !empty($rsAlbum->album_alias)}
		<li>
			<div>
				<label>Alias</label> {$rsAlbum->album_alias}
			</div>
		</li>
	{/if}
	{if !empty($rsAlbum->album_image)}
		<li>
			<div>
				<label>Image</label> {$rsAlbum->album_image}
			</div>
		</li>
	{/if}
		<li>
			<div>
				<label>Visibile?</label> <input type="checkbox" disabled="disabled" value="1" {if ($rsAlbum->album_is_visible==true)}checked{/if} />
			</div>
		</li>
	</ul>


	<h3>Releases</h3>

	<p>
		<a href="/index.php/admin/release/add/{$album_id}/" class="button"><img src="{$config.to_vigilante}/images/icons/add-page-blue.gif" alt="[Add a release]" title="[Add a release]" /> Add a release</a>
	</p>

	{if !empty($rsAlbum->releases)}
		<ul class="two-column-bubble-list">
		{foreach item=rsRelease from=$rsAlbum->releases}
			<li>
				<div>
					<a href="/index.php/admin/release/view/{$rsRelease->release_id}/">{$rsRelease->format_name}</a>
				</div>
			</li>
		{/foreach}
		</ul>
	{else}
		<p>This album has no releases.</p>
	{/if}

	{else}
		<p>Album information is not available.</p>
	{/if}
</div>

<div id="column-2" class="span-6 last">
	{if !empty($rsAlbum)}
	<p>
		<img src="/images/_covers/_exm_front_200_{if !empty($rsAlbum->album_image)}{$rsAlbum->album_image}{else}tbd.jpg{/if}" />
	</p>
	{/if}
</div>
