<h4 class="admin_head">Film information</h4>

<form action="/index.php/filmwhore/film/update/{$film_id}/" method="post" name="release">

<table class="Admin">
<tr>
	<th valign="top" colspan="2"><strong>FILM INFO</strong></th>
</tr>
<tr>
	<td valign="top"><strong>Title:</strong></td>
	<td valign="top"><strong><a href="/index.php/filmwhore/film/edit/{$film_id}/">{$rsFilm->film_title}</a></strong><input type="hidden" name="film_title" value="{$rsFilm->film_title}"></td>
</tr>
<tr>
	<td valign="top"><strong>EAN or UPC number:</strong><br></td>
	<td valign="top"><input type="text" name="film_ean_num" value="{$film_ean_num}" size="35"></td>
</tr>
<tr>
	<td valign="top"><strong>Amazon ASIN number:</strong><br>{if $film_asin_num}<a href="http://{$config.amazon_locale.$locale.domain}/exec/obidos/ASIN/{$film_asin_num}/{$config.amazon_locale.$locale.associateID}">View</a>{/if}</td>
	<td valign="top"><input type="text" name="film_asin_num" value="{$film_asin_num}" size="35"></td>
</tr>
</table>

<p>
<input type="submit" value="Update">
</p>


</form>