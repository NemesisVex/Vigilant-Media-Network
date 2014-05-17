<h4 class="admin_head">Personell administration</h4>

<form action="/index.php/musicwhore/personell/update/{$member_artist_id}/" method="post" name="personell">

<table class="Admin">
<tr>
	<th>ORDER</th>
	<th>MEMBER</th>
	<th>ASIAN NAME</th>
	<th>INSTRUMENTS</th>
	<th>DELETE?</th>
</tr>
{foreach key=m item=rsMember from=$rsMembers}
<tr>
	<td valign="top"><input type="text" name="member_in[{$m}][member_order]" value="{if $rsMember->member_order}{$rsMember->member_order}{else}{$m+1}{/if}" size="4"></td>
	<td valign="top"><input type="text" name="member_in[{$m}][member_name]" value="{$rsMember->member_name}" size="20"></td>
	<td valign="top"><input type="text" name="member_in[{$m}][member_asian_name_utf8]" value="{$rsMember->member_asian_name_utf8}" size="20"></td>
	<td valign="top"><input type="text" name="member_in[{$m}][member_instruments]" value="{$rsMember->member_instruments}" size="20"></td>
	<td align="center" valign="bottom">
{if $rsMember->member_id}
<input type="hidden" name="member_in[{$m}][member_id]" value="{$rsMember->member_id}">
<input type="checkbox" name="member_in[{$m}][delete]" value="1">
{/if}
	</td>
</tr>
{/foreach}
</table>

<p><input type="submit" value="Save"></p>

</form>
