<div id="column-1" class="span-17 append-1">
{include file=obr_global_header.tpl}

	{if !empty($rsRelease)}
	<p>
		<a href="/index.php/admin/release/edit/{$release_id}/" class="button"><img src="{$config.to_vigilante}/images/icons/edit-page-blue.gif" alt="[Edit]" title="[Edit]" /> Edit</a>
		<a href="/index.php/admin/release/delete/{$release_id}/" class="button"><img src="{$config.to_vigilante}/images/icons/delete-page-blue.gif" alt="[Delete]" title="[Delete]" /> Delete</a>
	</p>

	<ul class="two-column-bubble-list">
		<li>
			<div>
				<label>Format</label> {$rsRelease->format_name}
			</div>
		</li>
	{if !empty($rsRelease->release_label)}
		<li>
			<div>
				<label>Label</label> {$rsRelease->release_label}
			</div>
		</li>
	{/if}
	{if !empty($rsRelease->release_alternate_title)}
		<li>
			<div>
				<label>Alternate title</label> {$rsRelease->release_alternate_title}
			</div>
		</li>
	{/if}
	{if !empty($rsRelease->release_upc_num)}
		<li>
			<div>
				<label>UPC No.</label> {$rsRelease->release_upc_num}
			</div>
		</li>
	{/if}
	{if !empty($rsRelease->release_catalog_num)}
		<li>
			<div>
				<label>Catalog No.</label> {$rsRelease->release_catalog_num}
			</div>
		</li>
	{/if}
	{if !empty($rsRelease->release_release_date)}
		<li>
			<div>
				<label>Release Date</label> {$rsRelease->release_release_date|date_format:"%m/%d/%Y"}
			</div>
		</li>
	{/if}
	{if !empty($rsRelease->release_alias)}
		<li>
			<div>
				<label>Alias</label> {$rsRelease->release_alias}
			</div>
		</li>
	{/if}
	{if !empty($rsRelease->release_image)}
		<li>
			<div>
				<label>Image</label> {$rsRelease->release_image}
			</div>
		</li>
	{/if}
		<li>
			<div>
				<label>Visibile?</label> <input type="checkbox" disabled="disabled" value="1" {if ($rsRelease->release_is_visible==true)}checked{/if} />
			</div>
		</li>
	</ul>
			
	<h3>Tracks</h3>

	<p>
		<a href="/index.php/admin/track/add/{$release_id}/" class="button"><img src="{$config.to_vigilante}/images/icons/add-page-blue.gif" alt="[Add]" title="[Add]" /> Add a track</a>
	</p>

	{if !empty($rsRelease->tracks)}
		<ol class="track-list">
		{foreach item=rsTrack from=$rsRelease->tracks}
			<li>
				<div>
					<a href="/index.php/admin/track/edit/{$rsTrack->track_id}"><img src="{$config.to_vigilante}/images/icons/edit-page-purple.gif" alt="[Edit]" title="[Edit]" /></a>
					<a href="/index.php/admin/track/delete/{$rsTrack->track_id}"><img src="{$config.to_vigilante}/images/icons/delete-page-purple.gif" alt="[Delete]" title="[Delete]" /></a>
					<a href="/index.php/admin/track/view/{$rsTrack->track_id}">{$rsTrack->song_title}</a>
				</div>
			</li>
		{/foreach}
		</ol>
	{else}
		<p>This release has no tracks.</p>
	{/if}

	{else}
		<p>This release has no information.</p>
	{/if}
</div>

<div id="column-2" class="span-6 last">
	{if !empty($rsRelease)}
	<p>
		<img src="/images/_covers/_exm_front_200_{if !empty($rsRelease->release_image)}{$rsRelease->release_image}{else}tbd.jpg{/if}" />
	</p>
	{/if}
</div>
