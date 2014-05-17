<div id="tabs">
	<ul>
		<li><a href="#release-info">Release info</a></li>
		<li><a href="#tracks">Tracks</a></li>
		<li><a href="#entries">Entries</a></li>
		<li><a href="#products">Products</a></li>
	</ul>
	
	<div id="release-info">
		<form action="/index.php/ep4/release/{if $release_id}update/{$release_id}{else}create/{$album_artist_id}{/if}/" method="post" name="album">

			<p>
				<label for="release_alternate_title">ID:</label>
				{if $release_id}{$release_id}<input type="hidden" name="release_id" value="{$release_id}">{else}TBD{/if}
			</p>

			<p>
				<label for="release_album_id">Album</label>
				<select name="release_album_id">
					<option value=""> &nbsp;
				{foreach item=rsAlbum from=$rsAlbums}
					<option value="{$rsAlbum->album_id}"{if ($rsRelease->release_album_id==$rsAlbum->album_id) || ($release_album_id==$rsAlbum->album_id)} selected{/if}> {$rsAlbum->album_title}
				{/foreach}
				</select>
			</p>

			<p>
				<label for="release_alternate_title">Alternate Title:</label>
				<input type="text" name="release_alternate_title" value="{$rsRelease->release_alternate_title}" size="40" />
			</p>

			<p>
				<label for="release_label">Label:</label>
				<input type="text" name="release_label" value="{$rsRelease->release_label}" size="40" />
			</p>

			<p>
				<label for="release_label">Release Date:</label>
				<input type="text" id="release_release_date" name="release_release_date" value="{$rsRelease->release_release_date|date_format:"%Y-%m-%d"}" size="20" />
			</p>

			<p>
				<label for="release_upc_num">UPC No.:</label>
				<input type="text" name="release_upc_num" value="{$rsRelease->release_upc_num}" size="40" />
			</p>

			<p>
				<label for="release_catalog_num">Catalog No.:</label>
				<input type="text" name="release_catalog_num" value="{$rsRelease->release_catalog_num}" size="20" />
			</p>

			<p>
				<label for="release_format_id">Format:</label>
				<select name="release_format_id">
					<option value="0"> &nbsp;
				{foreach item=rsFormat from=$rsFormats}
					<option value="{$rsFormat->format_id}"{if $rsRelease->release_format_id==$rsFormat->format_id} selected{/if}> {$rsFormat->format_name}
				{/foreach}
				</select>
			</p>

			<p>
				<label for="release_image">Image:</label>
				<input type="text" name="release_image" value="{$rsRelease->release_image}" size="40" />
			</p>

			<p>
				<label for="release_is_visible">Visibility:</label>
				<input type="radio" name="release_is_visible" value="1"{if $rsRelease->release_is_visible==1} checked{/if} /> Show
				<input type="radio" name="release_is_visible" value="0"{if $rsRelease->release_is_visible==0} checked{/if} /> Hide
			</p>

			<p>
				<label for="release_music_description">Description:</label>
				<textarea name="release_music_description" cols="50" rows="10">{$rsRelease->release_music_description|escape:"html"}</textarea>
			</p>

			<p>
				<label for="release_music_description_more">Description (more):</label>
				<textarea name="release_music_description_more" cols="50" rows="10">{$rsRelease->release_music_description_more|escape:"html"}</textarea>		
			</p>

			<p>
				<input type="submit" value="Save" />
			</p>

		</form>
	</div>

	<div id="tracks">
	{if $release_id}
		<ul class="inline-nav">
			<li>
				<a href="javascript:" class="add-track"><img src="{$config.to_vigilante}/images/icons/add-page-blue.gif" alt="[ADD]" /></a>
				<a href="javascript:" class="add-track">Add a track</a>
			</li>
		{if $rsTracks}
			<li>
				<a href="javascript:" class="export-tracks"><img src="{$config.to_vigilante}/images/icons/download-page-blue.gif" alt="[ADD]" /></a>
				<a href="javascript:" class="export-tracks">Export</a>
			</li>
		{/if}
		</ul>
		
	{if $rsTracks}
		<ul id="track-list" class="browse-list">
		{foreach item=rsTrack from=$rsTracks}
			<li class="browse-info" id="track-{$rsTrack->track_id}">
				<a href="javascript:" id="edit-{$rsTrack->track_id}"><img src="{$config.to_vigilante}/images/icons/edit-page-yellow.gif" alt="[EDIT]" /></a>
				{*<a href="/index.php/ep4/tracks/delete/{$rsTrack->track_id}/"><img src="{$config.to_vigilante}/images/icons/delete-page-yellow.gif" alt="[DELETE]" /></a>*}
				<span class="track-num-display">{$rsTrack->track_track_num}</span>. {$rsTrack->song_title}
				<input type="hidden" name="track_id" value="{$rsTrack->track_id}" />
				
				<div class="edit-track-info" id="edit-track-{$rsTrack->track_id}" title="Edit {$rsTrack->song_title}">
					<form action="/index.php/ep4/tracks/update/{$rsTrack->track_id}/" method="post" name="track-form">
						<input type="hidden" name="track_release_id" value="{$release_id}" />
						<input type="hidden" name="track_album_id" value="{$rsRelease->release_album_id}" />
						<input type="hidden" name="map_id" value="{$rsTrack->map_id}" />
						
						<p>
							<label for="track_song_id">Track:</label>
							<span class="track-num-display"></span>
							<input type="hidden" name="track_track_num" value="" />
						</p>
						
						<p>
							<label for="track_song_id">Song:</label>
							<select name="track_song_id">
							{foreach item=rsSong from=$rsSongs}
								<option value="{$rsSong->song_id}"{if $rsSong->song_id == $rsTrack->track_song_id} selected{/if}>{$rsSong->song_title}</option>
							{/foreach}
							</select>
						</p>
						
						<p>
							<label for="track_isrc_num">ISRC No.:</label>
							<input type="text" name="track_isrc_num" value="{$rsTrack->track_isrc_num}" size="20" />
						</p>
						
						<p>
							<label for="track_is_visible">Visibility:</label>
							<input type="radio" name="track_is_visible" value="1"{if $rsTrack->track_is_visible==true} checked{/if} /> Yes
							<input type="radio" name="track_is_visible" value="0"{if $rsTrack->track_is_visible==false} checked{/if} /> No
						</p>
						
						<p>
							<label for="track_audio_is_playable">Playable:</label>
							<input type="radio" name="track_audio_is_linked" value="1"{if $rsTrack->track_audio_is_linked==true} checked{/if} /> Yes
							<input type="radio" name="track_audio_is_linked" value="0"{if $rsTrack->track_audio_is_linked==false} checked{/if} /> No
						</p>
						
						<p>
							<label for="track_audio_is_downloadable">Downloadable:</label>
							<input type="radio" name="track_audio_is_downloadable" value="1"{if $rsTrack->track_audio_is_downloadable==true} checked{/if} /> Yes
							<input type="radio" name="track_audio_is_downloadable" value="0"{if $rsTrack->track_audio_is_downloadable==false} checked{/if} /> No
						</p>
						
						<p>
							<label for="track_uplaya_score">uPlaya Score:</label>
							<input type="text" name="track_uplaya_score" value="{$rsTrack->track_uplaya_score}" size="4" />
						</p>
						
						<p>
							<label for="map_audio_id">Audio:</label>
							<select name="map_audio_id">
								<option value=""></option>
								{foreach item=rsFile from=$rsFiles}
								<option value="{$rsFile->audio_id}" title="{$rsFile->audio_mp3_file_path}/{$rsFile->audio_mp3_file_name}"{if $rsTrack->map_audio_id==$rsFile->audio_id} selected{/if}>{$rsFile->audio_mp3_file_name|truncate:'48'}</option>
								{/foreach}
							</select>
						</p>
					</form>
				</div>
				
				<script type="text/javascript">
					$(document).ready(function () {ldelim}
						$('#edit-{$rsTrack->track_id}').click(function () {ldelim}
							$('#edit-track-{$rsTrack->track_id}').dialog('open');
						{rdelim});
					{rdelim});
				</script>
			</li>
		{/foreach}
		</ul>
		
		<form action="/index.php/ep4/tracks/save_order/{$release_id}/" method="post" id="save-order-form">
			<p>
				<input type="button" value="Save track order" id="save-order" />
			</p>
			
			<div id="save-order-dialog">
				<p class="msg"></p>
			</div>
		</form>
		
		<div id="export-track-info" title="Export">
			<form action="/index.php/ep4/tracks/export/{$release_id}/" method="post" name="export-form">
				<p>
					<label for="url_base">URL base:</label>
					<input type="text" name="url_base" value="www.eponymous4.com" size="50" />
				</p>

				<p>
				<label for="version">Directory:</label>
					<input type="radio" name="version" value="vocals" checked> Vocals
					<input type="radio" name="version" value="ex_machina"> Ex Machina
				</p>

				<p>
				<label for="file_format">File type:</label>
					<input type="radio" name="file_format" value="xspf" checked /> XSPF
					<input type="radio" name="file_format" value="m3u" /> M3u
					<input type="radio" name="file_format" value="text" /> Text
				</p>

				<p>
				<input type="submit" value="Export">
				</p>
			</form>
		</div>
	{/if}

		<div class="hidden" id="create-track" title="Add track">
			<form action="/index.php/ep4/tracks/create/{$release_id}/" method="post" name="track-form">
				<input type="hidden" name="track_album_id" value="{$rsRelease->release_album_id}" />

				<p>
					<label for="track_song_id">Track:</label>
					<span class="track-num-display"></span>
					<input type="hidden" name="track_track_num" value="" />
				</p>

				<p>
					<label for="track_song_id">Song:</label>
					<select name="track_song_id">
					{foreach item=rsSong from=$rsSongs}
						<option value="{$rsSong->song_id}" title="{$rsSong->song_title}">{$rsSong->song_title|truncate:"48"}</option>
					{/foreach}
					</select>
				</p>

				<p>
					<label for="track_isrc_num">ISRC No.:</label>
					<input type="text" name="track_isrc_num" value="" size="20" />
				</p>

				<p>
					<label for="track_is_visible">Visibility:</label>
					<input type="radio" name="track_is_visible" value="1" /> Yes
					<input type="radio" name="track_is_visible" value="0" checked /> No
				</p>

				<p>
					<label for="track_audio_is_playable">Playable:</label>
					<input type="radio" name="track_audio_is_linked" value="1" /> Yes
					<input type="radio" name="track_audio_is_linked" value="0" checked /> No
				</p>

				<p>
					<label for="track_audio_is_downloadable">Downloadable:</label>
					<input type="radio" name="track_audio_is_downloadable" value="1" /> Yes
					<input type="radio" name="track_audio_is_downloadable" value="0" checked /> No
				</p>

				<p>
					<label for="track_uplaya_score">uPlaya Score:</label>
					<input type="text" name="track_uplaya_score" value="" size="4" />
				</p>

				<p>
					<label for="map_audio_id">Audio:</label>
					<select name="map_audio_id">
						<option value=""></option>
						{foreach item=rsFile from=$rsFiles}
						<option value="$rsFile->audio_id" title="{$rsFile->audio_mp3_file_path}/{$rsFile->audio_mp3_file_name}">{$rsFile->audio_mp3_file_name|truncate:'48'}</option>
						{/foreach}
					</select>
				</p>
			</form>
		</div>
{else}
		<p>A release is required before tracks may be edited.</p>
{/if}
	</div>
	
	<div id="entries">
{if $release_id}
		<p>
			<a href="javascript:" class="create-entry-map"><img src="{$config.to_vigilante}/images/icons/add-page-blue.gif" alt="[ADD]" /></a>
			<a href="javascript:" class="create-entry-map">Map to an entry</a>
		</p>
	{if $rsEntries}	
		<ul class="browse-list">
		{foreach item=rsEntry from=$rsEntries}
			<li class="browse-info" id="content-{$rsEntry->content_id}">
				<a id="edit-content-{$rsEntry->content_id}" href="javascript:" class="edit-entry-map"><img src="{$config.to_vigilante}/images/icons/edit-page-yellow.gif" alt="[EDIT]" /></a>
				<a href="/index.php/ep4/content/unmap/{$rsEntry->content_id}/{$release_id}/" class="delete-entry-map"><img src="{$config.to_vigilante}/images/icons/delete-page-yellow.gif" alt="[EDIT]" /></a>
				{$rsEntry->entry_title}
				
				<div class="edit-entry-info" id="edit-entry-{$rsEntry->content_id}" title="Edit {$rsEntry->entry_title}" name="entry-form">
					<form action="/index.php/ep4/content/update/{$rsEntry->content_id}/" method="post" name="entry-form">
						
						<p>
							<label>Entry:</label> {$rsEntry->entry_title}
						</p>
						
						<p>
							<label for="content_release_id">Release:</label>
							<select name="content_release_id">
								<option value="0">&nbsp;</option>
							{foreach item=rsEntryRelease from=$rsReleases}
								<option value="{$rsEntryRelease->release_id}"{if $rsEntryRelease->release_id==$rsEntry->content_release_id} selected{/if}>[{$rsEntryRelease->format_name}] {$rsEntryRelease->album_title}</option>
							{/foreach}
							</select>
						</p>
						
						<p>
							<label for="content_track_id">Track:</label>
							<select name="content_track_id">
								<option value="0">&nbsp;</option>
							{foreach item=rsEntryTrack from=$rsTracks}
								<option value="{$rsEntryTrack->track_id}"{if $rsEntryTrack->track_id==$rsEntry->content_track_id} selected{/if}>{$rsEntryTrack->song_title}</option>
							{/foreach}
							</select>
						</p>
					</form>
					
					<script type="text/javascript">
						$(document).ready(function () {ldelim}
							$('#edit-content-{$rsEntry->content_id}').click(function () {ldelim}
								$('#edit-entry-{$rsEntry->content_id}').dialog('open');
							{rdelim});
						{rdelim});
					</script>
				</div>
			</li>
		{/foreach}
		</ul>
	{/if}
	
		<div class="hidden" id="map-entry" title="Create content map">
			<form action="/index.php/ep4/content/create/" method="post" name="entry-form">
				<input type="hidden" name="content_release_id" value="{$release_id}" />
				
				<p>
					<label for="content_track_id">Track:</label>
					<select name="content_track_id">
						<option value="0">&nbsp;</option>
					{foreach item=rsTrack from=$rsTracks}
						<option value="{$rsTrack->track_id}">{$rsTrack->song_title|truncate:'48'}</option>
					{/foreach}
					</select>
				</p>
				
				<p>
					<label for="category_id">Category:</label>
					<select name="category_id">
						<option value="">&nbsp;</option>
					{foreach item=rsCategory from=$rsCategories}
						<option value="{$rsCategory->category_id}">{$rsCategory->category_label}</option>
					{/foreach}
					</select>
				</p>
				
				<p>
					<label for="content_entry_id">Entry:</label>
				</p>
				
				<table id="entry-list-table" class="Admin">
					<tr>
						<th>TITLE</th>
					</tr>
				</table>
				
				
			</form>
		</div>
{else}
		<p>A release is required before entries may be associated.</p>
{/if}
	</div>
	
	<div id="products">
{if $release_id}
		<p>
			<a href="javascript:" class="create-product-map"><img src="{$config.to_vigilante}/images/icons/add-page-blue.gif" alt="[ADD]" /></a>
			<a href="javascript:" class="create-product-map">Map to a product</a>
		</p>
		
	{if $rsProductMaps}
		<ul class="browse-list">
		{foreach item=rsProductMap from=$rsProductMaps}
			<li class="browse-info">
				<a href="/index.php/ep4/product/unmap/{$rsProductMap->product_release_id}/{$release_id}/" class="delete-product-map"><img src="{$config.to_vigilante}/images/icons/delete-page-yellow.gif" alt="[EDIT]" /></a>
				<a href="http://shop.observantrecords.com/index.php/admin/products/form/{$rsProductMap->id}/">{$rsProductMap->name}</a>
				
			</li>
		{/foreach}
		</ul>
	{/if}
	
	<div class="hidden" id="map-product" title="Create product map">
		<form action="/index.php/ep4/product/create/" method="post" name="product-form">
			<input type="hidden" name="product_release_release_id" value="{$release_id}" />
			<input type="hidden" name="product_release_album_id" value="{$rsRelease->release_album_id}" />
			
			<p>Select products to map with this release.</p>
			
			<select name="product_ids[]" multiple="multiple">
				<option value="">&nbsp;</option>
			{foreach item=rsProduct from=$rsProducts}
				<option value="{$rsProduct->id}">{$rsProduct->name}</option>
			{/foreach}
			</select>
		</form>
	</div>
{else}
		<p>A release is required before products may be associated.</p>
{/if}
	</div>

</div>

{literal}
<script type="text/javascript">
	$(document).ready(function () {
		// Tabs.
		$('#tabs').tabs({
			cookie: {
				expires: 30
			}
		});
		// Date pickers.
		$('#release_release_date').datepicker({
			dateFormat: 'yy-mm-dd'
		});
		// Sortable.
		$('#track-list').sortable({
			update: function (event, ui) {
				var new_track_num = 1;
				$(this).children().each(function () {
					$(this).find('.track-num-display').html(new_track_num);
					new_track_num++;
				});
			}
		});
		// Click handlers
		$('.add-track').click(function () {
			$('#create-track').dialog('open');
		});
		$('.export-tracks').click(function () {
			$('#export-track-info').dialog('open');
		});
		$('.create-entry-map').click(function () {
			$('#map-entry').dialog('open');
		});
		$('.create-product-map').click(function () {
			$('#map-product').dialog('open');
		});
		// Dialog boxes
		var edit_track_dialog_options = {
			autoOpen: false,
			modal: true,
			width: 600,
			height: 450,
			buttons: {
				"Save": function () {
					$(this).find('form[name=track-form]').submit();
					$(this).dialog('close');
				},
				"Cancel": function () {
					$(this).dialog('close');
				}
			}
		}
		$('.edit-track-info').dialog(edit_track_dialog_options);
		$('.edit-track-info').bind("dialogopen", function (event, ui) {
			var parent_id = this.id.replace('edit-', '');
			var parent_selector = '#' + parent_id;
			var new_track_num = $(parent_selector).find('.track-num-display').html();
			$(this).find('input[name=track_track_num]').val(new_track_num);
			$(this).find('.track-num-display').html(new_track_num);
		});
		$('#create-track').dialog(edit_track_dialog_options);
		$('#create-track').bind("dialogopen", function (event, ui) {
			var track_list_length = $('#track-list').children().length;
			var new_track_num = track_list_length == 0 ? 1 : $('#track-list').children().length + 1;
			$(this).find('input[name=track_track_num]').val(new_track_num);
			$(this).find('.track-num-display').html(new_track_num);
		});
		var map_entry_dialog_options = {
			autoOpen: false,
			modal: true,
			width: 800,
			height: 650,
			buttons: {
				"Save": function () {
					$(this).find('form[name=entry-form]').submit();
					$(this).dialog('close');
				},
				"Cancel": function () {
					$(this).dialog('close');
				}
			}
		}
		$('#map-entry').dialog(map_entry_dialog_options);
		var map_product_dialog = {
			autoOpen: false,
			modal: true,
			width: 600,
			height: 450,
			buttons: {
				"Save": function () {
					$(this).find('form[name=product-form]').submit();
					$(this).dialog('close');
				},
				"Cancel": function () {
					$(this).dialog('close');
				}
			}
		}
		$('#map-product').dialog(map_product_dialog);
		$('.edit-entry-info').dialog(map_entry_dialog_options);
		$('#save-order-dialog').dialog({
			autoOpen: false,
			modal: true,
			buttons: {
				"OK": function () {
					$(this).dialog('close');
				}
			}
		});
		$('#export-track-info').dialog({
			autoOpen: false,
			modal: true,
			width: 600,
			height: 450,
			buttons: {
				"Save": function () {
					$(this).find('form[name=export-form]').submit();
					$(this).dialog('close');
				},
				"Cancel": function () {
					$(this).dialog('close');
				}
			}
		});
		// AJAX
		$('select[name=category_id]').change(function () {
			var populate_entries = function(result) {
				if (result != '') {
					$('.retrieved-entry').remove();
					var entries = jQuery.parseJSON(result), input_text, input_entry_id, tr, td;
					for (var i in entries) {
						input_text = ' ' + entries[i].entry_title;
						input_entry_id = $('<input>').attr('type', 'radio').attr('name', 'content_entry_id').attr('value', entries[i].entry_id);
						td = $('<td>').addClass('retrieved-entry').append(input_entry_id).append(input_text);
						tr = $('<tr>').append(td);
						$('#entry-list-table').append(tr);
					}
				}
			};
			
			if (this.value != '') {
				var url = '/index.php/ep4/content/entry_list/';
				var data = {
					category_id: this.value
				};
				$.post(url, data, populate_entries);
			}
			else {
				$('.retrieved-entry').remove();
			}
		});
		$('select[name=content_release_id]').change(function () {
			var populate_entry_tracks = function (result) {
				if (result != '') {
					$('select[name=content_track_id]').children().remove();
					var tracks = jQuery.parseJSON(result), track_option;
					for (var i in tracks) {
						track_option = $('<option>').val(tracks[i].track_id).html(tracks[i].song_title);
						$('select[name=content_track_id]').append(track_option);
					}
				}
			}
			
			if (this.value > 0) {
				var url = '/index.php/ep4/tracks/track_list/';
				var data = {
					track_release_id: this.value
				};
				$.post(url, data, populate_entry_tracks);
			}
			else {
				$('select[name=content_track_id]').children().remove();
				var track_option = $('<option>').val(0).html('&nbsp;');
				$('select[name=content_track_id]').append(track_option);
			}
		});
		$('#save-order').click(function () {
			var tracks = [], track_num, track_id, track_info;
			$('#track-list').children().each(function () {
				track_num = $(this).find('.track-num-display').html();
				track_id = $(this).find('input[name=track_id]').val();
				track_info = {
					'track_id': track_id,
					'track_track_num': track_num
				}
				tracks.push(track_info);
			});
			var url = $('#save-order-form').attr('action');
			var data = {
				'tracks': tracks
			};
			$.post(url, data, function (result) {
				$('#save-order-dialog').dialog('open');
				$('#save-order-dialog').find('.msg').html(result);
			});
		});
	});
</script>
{/literal}

