<h4 class="admin_head">Film information</h4>

<form action="/index.php/filmwhore/film/update/{$film_id}/" method="post" name="film_info" id="film_info">

<table class="Admin">
<tr>
	<th valign="top" colspan="2"><strong>FILM INFO</strong></th>
</tr>
<tr>
	<td valign="top"><strong>Title:</strong></td>
	<td valign="top"><input type="text" name="film_title" value="{$film_title|escape:"html"}" size="40"></td>
</tr>
<tr>
	<td valign="top"><strong>Title prefix:</strong><br><span style="font-size: smaller">("the", "a", "an", etc.)</span></td>
	<td valign="top"><input type="text" name="film_title_prefix" value="{$film_title_prefix|escape:"html"}" size="40"></td>
</tr>
<tr>
	<td valign="top"><strong>Studio:</strong></td>
	<td valign="top"><input type="text" name="film_label" value="{$film_label|escape:"html"}" size="35"></td>
</tr>
<tr>
	<td valign="top"><strong>Release Date:</strong></td>
	<td valign="top">
{html_select_date prefix="ReleaseDate_" start_year="1960" end_year="+5" time=$film_release_date year_empty="&nbsp;" month_empty="&nbsp;" day_empty="&nbsp;"}
<input type="hidden" id="film_release_date" name="film_release_date" value="">
	</td>
</tr>
<tr>
	<td valign="top"><strong>Image File:</strong></td>
	<td valign="top"><input type="text" name="film_image" value="{$film_image}" size="35"></td>
</tr>
<tr>
	<td valign="top"><strong>Director:</strong></td>
	<td valign="top"><input type="text" name="film_director_name" value="{$film_director_name|escape:"html"}" size="35"></td>
</tr>
<tr>
	<td valign="top"><strong>IMDB ID:</strong><br><span style="font-size: smaller;">[<a href="http://us.imdb.com/find?s=all&amp;q={$film_title|lower|escape:"url"}">Lookup</a>]</span></td>
	<td valign="top"><input type="text" name="film_imdb_id" value="{$film_imdb_id}" size="35"></td>
</tr>
<tr>
	<td valign="top"><strong>EAN or UPC Number:</strong></td>
	<td valign="top"><input type="text" name="film_ean_num" value="{$film_ean_num}" size="35"></td>
</tr>
<tr>
	<td valign="top"><strong>Amazon ASIN:</strong></td>
	<td valign="top"><input type="text" name="film_asin_num" value="{$film_asin_num}" size="35"></td>
</tr>
<tr>
	<td valign="top"><strong>View type:</strong></td>
	<td valign="top"><input type="text" name="film_viewed_type" value="{$film_viewed_type}" size="35"></td>
</tr>
<tr>
	<td valign="top"><strong>Date viewed:</strong></td>
	<td valign="top">
{html_select_date prefix="ViewedDate_" start_year="2004" end_year="+5" time=$film_viewed_date year_empty="&nbsp;" month_empty="&nbsp;" day_empty="&nbsp;"}
<input type="hidden" id="film_viewed_date" name="film_viewed_date" value="">
	</td>
</tr>
</table>

<p>
<input id="submit_form" type="submit" value="Update">
</p>

</form>


{literal}
<script type="text/javascript">
$(document).ready(function ()
{
	$('#film_info').submit(function ()
	{
		var release_year = $('select[name=ReleaseDate_Year]').val();
		var release_month = $('select[name=ReleaseDate_Month]').val();
		var release_day = $('select[name=ReleaseDate_Day]').val();
		if (release_date_year!='' && release_date_month!='' && release_date_day!='')
		{
			var film_release_date = release_year + '-' + release_month + '-' + release_day + ' 00:00:00';
			$('#film_release_date').val(film_release_date);
		}
		
		var viewed_year = $('select[name=ViewedDate_Year]').val();
		var viewed_month = $('select[name=ViewedDate_Month]').val();
		var viewed_day = $('select[name=ViewedDate_Day]').val();
		if (viewed_year!='' && viewed_month!='' && viewed_day!='')
		{
			var film_viewed_date = viewed_year + '-' + viewed_month + '-' + viewed_day + ' 00:00:00';
			$('#film_viewed_date').val(film_viewed_date);
		}
	});
});
</script>
{/literal}
