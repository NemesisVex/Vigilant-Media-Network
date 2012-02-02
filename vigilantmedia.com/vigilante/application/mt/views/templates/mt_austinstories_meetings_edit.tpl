<h4 class="admin_head">Meeting information</h4>

<form action="/index.php/austinstories/meetings/update/{$meet_id}" method="post" name="meetform">

<table class="Admin">
<tr>
	<th colspan="2">MEETING</th>
</tr>
<tr>
	<td>Date:</td>
 	<td><input type="text" name="meet_date" value="{$rsMeeting->meet_date}" size="50"></td>
</tr>
<tr>
	<td>Location:</td>
	<td><input type="text" name="meet_location" value="{$rsMeeting->meet_location}" size="50"></td>
</tr>
<tr>
	<td>Address:</td>
	<td><input type="text" name="meet_address" value="{$rsMeeting->meet_address}" size="50"></td>
</tr>
</table>

<p><input type="submit" name="do" value="Update"></p>

</form>