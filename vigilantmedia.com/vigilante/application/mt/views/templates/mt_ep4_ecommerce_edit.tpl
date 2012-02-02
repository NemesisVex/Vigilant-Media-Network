<h4 class="admin_head">Ecommerce information</h4>

<p>You are administering links for <strong><em>{$rsRelease->album_title}{if $rsSong}: {$rsSong->song_title}{/if}</em></strong>.</p>

{if $rsSong}
{elseif $rsTracks}
<table class="Admin">
<tr>
	<th>TRACK #</th>
	<th>TITLE</th>
</tr>
{foreach item=rsTrack from=$rsTracks}
<tr>
	<td>{$rsTrack->track_track_num}</td>
	<td><a href="/index.php/ep4/ecommerce/track/{$rsTrack->track_id}/{$ecommerce_release_id}/{$album_artist_id}/">{$rsTrack->song_title}</a></td>
</tr>
{/foreach}
</table>
{/if}

<h4>Add a link</h4>

<form action="/index.php/ep4/ecommerce/create/{$ecommerce_release_id}/{$album_artist_id}{if $ecommerce_track_id}/{$ecommerce_track_id}{/if}/" method="post">

<table class="Admin">
<tr>
	<td>Vendor:</td>
	<td><input type="text" name="ecommerce_label" size="50"></td>
</tr>
<tr>
	<td>URL:</td>
	<td><input type="text" name="ecommerce_url" size="50"></td>
</tr>
<tr>
	<td>Track (optional):</td>
	<td>
<select name="ecommerce_track_id">
<option value="">&nbsp;</option>
{foreach item=rsTrack from=$rsTracks}
<option value="{$rsTrack->track_id}"{if $ecommerce_track_id==$rsTrack->track_id} selected{/if}>{$rsTrack->song_title}</option>
{/foreach}
</select>
	</td>
<tr>
	<td>Listing order:</td>
	<td><input type="text" name="ecommerce_list_order" size="2"></td>
</tr>
</table>

<p><input type="submit" value="Save"></p>

</form>


{if $rsLinks}
<form action="/index.php/ep4/ecommerce/update/{$ecommerce_release_id}/{$album_artist_id}{if $ecommerce_track_id}/{$ecommerce_track_id}{/if}/" method="post">

<h4>Edit links</h4>


{foreach key=o item=rsLink from=$rsLinks}
<table class="Admin">
<tr>
	<td>Vendor:</td>
	<td><input type="text" name="ecomm_in[{$o}][ecommerce_label]" value="{$rsLink->ecommerce_label}" size="50"></td>
</tr>
<tr>
	<td>URL:</td>
	<td><input type="text" name="ecomm_in[{$o}][ecommerce_url]" value="{$rsLink->ecommerce_url|escape:"html"}" size="50"></td>
</tr>
<tr>
	<td>List order:</td>
	<td><input type="text" name="ecomm_in[{$o}][ecommerce_list_order]" value="{$rsLink->ecommerce_list_order}" size="2"></td>
</tr>
<tr>
	<td>Track:</td>
	<td>
<select name="ecomm_in[{$o}][ecommerce_track_id]">
<option value="">&nbsp;</option>
{foreach item=rsTrack from=$rsTracks}
<option value="{$rsTrack->track_id}"{if $rsLink->ecommerce_track_id==$rsTrack->track_id} selected{/if}>{$rsTrack->song_title}</option>
{/foreach}
</select>
	</td>
</tr>
<tr>
	<td colspan="2">
	<input type="hidden" name="ecomm_in[{$o}][ecommerce_id]" value="{$rsLink->ecommerce_id}">
	<input type="checkbox" name="ecomm_in[{$o}][delete]" value="1"> Delete link
	</td>
</tr>
</table><br>

{/foreach}

<p><input type="submit" value="Save"></p>

</form>
{/if}

