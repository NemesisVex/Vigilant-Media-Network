<h4>{$rsDate->tour_name}</h4>

<p>
<strong>{$rsDate->date_tour_date|date_format:"%b %d, %Y"}</strong><br/>
{$rsDate->geocode_location}<br/>
{$rsDate->geocode_city}{if $rsDate->geocode_state}, {$rsDate->geocode_state}{/if}, {$rsDate->country_name}
</p>
