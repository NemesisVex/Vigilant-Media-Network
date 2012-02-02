<h4 class="admin_head">Tour information</h4>

{if $rsTourDates}
<p>Choose a tour date to edit:</p>

<table class="Admin_Wide">
<tr>
	<th>VENUE</th>
	<th>DATE</th>
	<th>LOCATION</th>
</tr>
{foreach item=rsTourDate from=$rsTourDates}
<tr>
	<td valign="top"><strong><a href="/index.php/ddn/tour/edit/{$rsTourDate->date_id}/">{$rsTourDate->geocode_location}</a></strong></td>
	<td valign="top">{$rsTourDate->date_tour_date|date_format:"%b %d, %Y"}</td>
	<td valign="top">{$rsTourDate->country_name}</td>
</tr>
{/foreach}
</table>


{else}
<p>No tours are avaialble. Perhaps you would like <a href="/index.php/ddn/tour/add/">to add one</a>?</p>

{/if}
