<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key={$config.google_map_key}" type="text/javascript"></script>
<script src="/includes/ddn_tour_map.js" type="text/javascript"></script>

{if $rsTours}
<div class="span-22 append-bottom">
<ul id="mycarousel" class="jcarousel-skin-ddn span-22 append-bottom">
{foreach item=rsTour from=$rsTours}
	<li> <a href="/index.php/tour/index/{$rsTour->tour_id}/">{$rsTour->tour_name}</a><br/>({$rsTour->date_start|date_format:"%b %Y"}-{$rsTour->date_end|date_format:"%b %Y"})</li>
{/foreach}
</ul>
</div>
{/if}

<div class="span-10 append-1">

{if $rsTourDates}
<h2>{$rsTourDates[0]->tour_name}</h2>

<div id="tour_dates">
<p>
{foreach name=tour_dates item=rsTourDate from=$rsTourDates}
<script type="text/javascript">
$(document).ready(function () {ldelim}
	point = new GLatLng({$rsTourDate->geocode_lat}, {$rsTourDate->geocode_lon});
{if $smarty.foreach.tour_dates.first}
	set_center(point);
{/if}
	create_marker(point, {$rsTourDate->date_id}, $('#point_{$rsTourDate->date_id}')[0]);
{rdelim});
</script>
<strong>{$rsTourDate->date_tour_date|date_format:"%b %d, %Y"}</strong>: <a href="javascript:" id="point_{$rsTourDate->date_id}">{$rsTourDate->geocode_location}</a>, {$rsTourDate->geocode_city}{if $rsTourDate->geocode_state}, {$rsTourDate->geocode_state}{/if}, {$rsTourDate->country_name}<br/>
{/foreach}
</p>
</div>

{/if}

</div>

<div class="span-11 last">
<div id="map_canvas"></div>

<h3>Notes</h3>

<ul>
	<li> In the case of venues no longer available, only the city, state and country are plotted on the map if an address could not be located.</li>
	<li> Tour information provided by the <a href="http://duranduran.wikia.com/wiki/Category:Timeline">Duran Duran Timeline</a>.</li>
</ul>

</div>

