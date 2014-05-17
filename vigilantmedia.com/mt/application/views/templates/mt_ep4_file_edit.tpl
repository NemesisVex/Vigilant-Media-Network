<div id="tabs">
	<ul>
		<li><a href="#file-info">File information</a></li>
		<li><a href="#products">Products</a></li>
		<li><a href="#orders">Sales orders</a></li>
	</ul>

	<div id="file-info">
		<form action="/index.php/ep4/file/{if $file_id}update/{$file_id}{else}create{/if}/" enctype="multipart/form-data" method="post">

			<p>
				<label>Upload a file:</label>
				<input type="file" name="userfile" size="50" />
			</p>

			<p>
				<label>Label:</label>
				<input type="text" name="file_label" value="{$rsFile->file_label}" size="50" />
			</p>

			<p>Fill out the following fields if a file has already been uploaded.</p>

			<p>
				<label>File path:</label>
				<input type="text" name="file_path" value="{if $rsFile->file_path}{$rsFile->file_path}{else}{$smarty.const.OBSERVANTRECORDS_FILES_PATH}{/if}" size="50" />
			</p>

			<p>
				<label>File name:</label>
				<input type="text" name="file_name" value="{$rsFile->file_name}" size="50" />
			</p>

			<p>
				<input type="submit" value="Save" />
			</p>

		</form>
	</div>

	<div id="products">
	{if $file_id}
		<p>
			<a href="javascript:" class="create-product-map"><img src="{$config.to_vigilante}/images/icons/add-page-blue.gif" alt="[ADD]" /></a>
			<a href="javascript:" class="create-product-map">Map to a product</a>
		</p>

	{if $rsProductMaps}
		<ul class="browse-list">
		{foreach item=rsProductMap from=$rsProductMaps}
			<li class="browse-info">
				<a href="https://shop.observantrecords.com/index.php/admin/products/form/{$rsProductMap->file_product_product_id}/"><img src="{$config.to_vigilante}/images/icons/edit-page-yellow.gif" alt="[EDIT]" title="[EDIT]" /></a>
				<a href="/index.php/ep4/file/unmap/{$rsProductMap->file_product_id}/{$file_id}/" class="delete-product-map"><img src="{$config.to_vigilante}/images/icons/delete-page-yellow.gif" alt="[UNMAP]" /></a>
				<a href="https://shop.observantrecords.com/index.php/admin/products/form/{$rsProductMap->file_product_product_id}/">{$rsProductMap->name}</a>
			</li>
		{/foreach}
		</ul>

	{else}
		<p>No products have yet been associated.</p>
	{/if}

	<div id="map-product" title="Create product map">
		<form action="/index.php/ep4/file/map/{$file_id}/" method="post" name="product-form">

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
		<p>A file must be created before products may be associated with it.</p>
	{/if}
	</div>

	<div id="orders">
	{if $file_id}
	{if $rsOrderMaps}
		<ul class="browse-list">
		{foreach item=rsOrderMap from=$rsOrderMaps}
			<li class="browse-info">
				<a href="https://shop.observantrecords.com/index.php/admin/orders/view/{$rsOrderMap->id}/"><img src="{$config.to_vigilante}/images/icons/edit-page-yellow.gif" alt="[EDIT]" title="[EDIT]" /></a>
				<a href="https://shop.observantrecords.com/index.php/admin/orders/view/{$rsOrderMap->id}/">{$rsOrderMap->order_number}</a>
			</li>
		{/foreach}
		</ul>
	{else}
		<p>No orders have yet been placed.</p>
	{/if}
	{else}
		<p>A file must be created before orders may be associated with it.</p>
	{/if}
	</div>
</div>

{literal}
<script type="text/javascript">
	$(document).ready(function () {
		$('#tabs').tabs({
			cookie: 30
		});
		$('.create-product-map').click(function () {
			$('#map-product').dialog('open');
		});
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
	});
</script>
{/literal}