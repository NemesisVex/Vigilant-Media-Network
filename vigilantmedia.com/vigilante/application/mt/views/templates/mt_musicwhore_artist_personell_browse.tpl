<h4 class="admin_head">Personell administration</h4>

{if $rsMembers}
<form action="/index.php/musicwhore/personell/edit/{$member_artist_id}/" method="post" name="personell">

<p><strong>Members:</strong><br>
{foreach item=rsMember from=$rsMembers}
&#8211; {$rsMember->member_name}{if $rsMember->member_asian_name_utf8} ({$rsMember->member_asian_name_utf8}){/if}: <em>{$rsMember->member_instruments}</em><br>
{/foreach}
</p>

<p><strong>Choose an option:</strong><br>
<input type="hidden" name="do" value="Edit">
<input type="radio" name="is_add_more" value="0" checked> Edit/delete current members<br>
<input type="radio" name="is_add_more" value="1"> Add <input type="text" name="more_members" size=3> more members<br></p>

<input type="submit" value="Continue">

</form>
{else}

<form action="/index.php/musicwhore/personell/add/{$member_artist_id}/" method="post" name="personell">

<p>How many members are in this group? <input type="text" name="number_of_members" size="3"> <input type="submit" value="Continue"></p>

</form>

{/if}