<h4 class="admin_head">Tour information</h4>

{if $rsTours}
<p>Choose a tour to edit:</p>

<table class="Admin_Wide">
<tr>
	<th>TOUR</th>
</tr>
{foreach item=rsTour from=$rsTours}
<tr>
	<td valign="top"><strong><a href="/index.php/ddn/tour/dates/{$rsTour->tour_id}/">{$rsTour->tour_name}</a></strong></td>
</tr>
{/foreach}
</table>


{else}
<p>No tours are avaialble. Perhaps you would like <a href="/index.php/ddn/tour/add/">to add one</a>?</p>

{/if}
