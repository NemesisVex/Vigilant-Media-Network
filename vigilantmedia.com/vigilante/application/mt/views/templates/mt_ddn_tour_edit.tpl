<h4 class="admin_head">Tour information</h4>


<form action="/index.php/ddn/tour/{if $date_id}update/{$date_id}{else}create{/if}/" method="post" id="tour_form">

<p>
<label for="tour_name">Tour name:</label>
<input type="text" name="tour_name" value="{$rsTourDate->tour_name}" size="50">
<input type="hidden" name="tour_id" value="{$rsTourDate->tour_id}">
<input type="hidden" name="geocode_id" value="{$rsTourDate->geocode_id}">
</p>

<p>
<label for="date_tour_date">Concert date:</label>
{html_select_date prefix="concert_date_" start_year="1980" end_year="+5" time=$rsTourDate->date_tour_date month_empty="&nbsp;" day_empty="&nbsp;" year_empty="&nbsp;"}
<input type="hidden" name="date_tour_date" id="date_tour_date" value="">

</p>

<p>
<label for="geocode_location">Concert venue:</label>
<input type="text" name="geocode_location" value="{$rsTourDate->geocode_location}" size="50">
</p>

<p>
<label for="geocode_address">Address:</label>
<input type="text" name="geocode_address" value="{$rsTourDate->geocode_address}" size="50">
</p>

<p>
<label for="geocode_city">City:</label>
<input type="text" name="geocode_city" value="{$rsTourDate->geocode_city}" size="50">
</p>

<p>
<label for="geocode_state">State/Province:</label>
<input type="text" name="geocode_state" value="{$rsTourDate->geocode_state}" size="50">
</p>

<p>
<label for="geocode_country_id">Country:</label>
<select name="geocode_country_id">
{foreach item=rsCountry from=$rsCountries}
<option value="{$rsCountry->country_id}"{if $rsCountry->country_id==$rsTourDate->geocode_country_id} selected{/if}>{$rsCountry->country_name}</option>
{/foreach}
</select>
<span class="smaller">[<a href="javascript:" id="geocode_lookup">Look up geocode</a>] <span id="geocode_lookup_status">Status: Waiting for input.</span></span>
</p>

<p>
<label for="geocode_lat">Latitude:</label>
<input type="text" name="geocode_lat" value="{$rsTourDate->geocode_lat}" size="10">
</p>

<p>
<label for="geocode_lon">Longitude:</label>
<input type="text" name="geocode_lon" value="{$rsTourDate->geocode_lon}" size="10">
</p>

<p>
<input type="submit" value="Update">
</p>

</form>

{literal}
<script type="text/javascript">
function geocode_lookup()
{
		var url_base = '/index.php/ddn/tour/lookup';
		var location = $('input[name=geocode_location]').val() || '_';
		var address = $('input[name=geocode_address]').val() || '_';
		var city = $('input[name=geocode_city]').val() || '_';
		var state = $('input[name=geocode_state]').val() || '_';
		var country = $('select[name=geocode_country_id] option:selected').text() || '_';

		var url = encodeURI(url_base + '/' + location + '/' + address + '/' + city + '/' + state + '/' + country + '/');
		$('#geocode_lookup_status').html('Status: Lookup in progress');

		$.ajax({
			type: "POST",
			url: url,
			error: function (XMLHttpRequest, textStatus, errorThrown)
			{
				alert(errorThrown);
			},
			success: function (msg) {
				if (msg != '')
				{
					geocodes = msg.split(',');
					if (geocodes[0] == '200')
					{
						$('input[name=geocode_lat]').val(geocodes[2]);
						$('input[name=geocode_lon]').val(geocodes[3]);
						$('#geocode_lookup_status').html('Status: Lookup was successful.');
					}
					else
					{
						$('#geocode_lookup_status').html('Status: Lookup returned the following error code: ' + geocodes[0] + '.');
					}
				}
			}
		});
}

function format_item(item)
{
	return item[0] + ' (' + item[2] + ')';
}

$(document).ready(function () {
	$('input[name=tour_name]').autocomplete('/index.php/ddn/tour/tours/', {
		width: 260,
		selectFirst: false
	});
	$('input[name=geocode_location]').autocomplete('/index.php/ddn/tour/locations/geocode_location/', {
		width: 260,
		selectFirst: false,
		formatItem: format_item
	});
	$('input[name=geocode_location]').result(function (event, data, formatted) {
		if (data)
		{
			$('input[name=geocode_address]').val(data[1]);
			$('input[name=geocode_city]').val(data[2]);
			$('input[name=geocode_state]').val(data[3]);
			$('select[name=geocode_country_id]').val(data[4]);
			$('input[name=geocode_lat]').val(data[5]);
			$('input[name=geocode_lon]').val(data[6]);
		}
	});
	$('#geocode_lookup').click(function () {geocode_lookup();});
	$('#tour_form').submit(function() {build_smarty_select_date('concert_date_', $('input[name=date_tour_date]'));});
});
</script>
{/literal}
