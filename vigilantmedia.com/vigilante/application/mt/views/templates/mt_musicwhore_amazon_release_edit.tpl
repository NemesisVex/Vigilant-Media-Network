<h4 class="admin_head">Release information</h4>

<form action="/index.php/musicwhore/release/update/{$release_id}/{$album_artist_id}/" method="post" name="release">

<table class="Admin">
<tr>
	<th valign="top" colspan="2"><strong>DISCOG INFO</strong></th>
</tr>
<tr>
	<td valign="top"><strong>Title:</strong></td>
	<td valign="top"><strong><a href="/index.php/musicwhore/release/edit/{$release_id}/{$album_artist_id}/">{$rsRelease->album_title}</a></strong></td>
</tr>
<tr>
	<td valign="top"><strong>EAN or UPC number:</strong><br></td>
	<td valign="top"><input type="text" name="release_ean_num" value="{$release_ean_num}" size="35"></td>
</tr>
<tr>
	<td valign="top"><strong>Amazon ASIN number:</strong><br>{if $release_asin_num}<a href="http://{$config.amazon_locale.$locale.domain}/exec/obidos/ASIN/{$release_asin_num}/{$config.amazon_locale.$locale.associateID}">View</a>{/if}</td>
	<td valign="top"><input type="text" name="release_asin_num" value="{$release_asin_num}" size="35"></td>
</tr>
</table>

<p>
<input type="submit" value="Update">
</p>

<p style="font-size: smaller;"><a href="{$request_uri}">Amazon request URI</a></p>

</form>