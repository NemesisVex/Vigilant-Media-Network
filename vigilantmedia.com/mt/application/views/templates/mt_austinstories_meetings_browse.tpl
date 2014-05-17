<form action="/index.php/austinstories/meetings/remove/" method="post">

<h4 class="admin_head">Meeting dates</h4>

<table class="Admin_Wide">
<tr>
	<th>DATE</th>
	<th>LOCATION</th>
	<th>ADDRESS</th>
	<th>OPTIONS</th>
	<th></th>
</tr>
{foreach item=rsMeet from=$rsMeetings}
<tr>
	<td style="width: 100px;">{$rsMeet->meet_date|date_format:"%m/%d/%Y"}</td>
	<td style="width: 200px;">{$rsMeet->meet_location}</td>
	<td style="width: 250px;">{$rsMeet->meet_address}</td>
	<td>[<a href="/index.php/austinstories/meetings/edit/{$rsMeet->meet_id}/">Edit</a>]&nbsp;[<a href="/index.php/austinstories/meetings/delete/{$rsMeet->meet_id}/">Delete</a>]</td>
	<td style="width: 50px;"><input type="checkbox" class="meet_id" name="meeting_id[]" value="{$rsMeet->meet_id}"></td>
</tr>
{/foreach}
</table>

<p>
<input type="checkbox" id="meet_ids"> Select all dates
</p>

<p><input type="submit" value="Delete selected dates"></p>

{if $page_links}
<p>
{$page_links}
</p>
{/if}

</form>

{literal}
<script type="text/javascript">
$(document).ready(function()
{
	$("#meet_ids").click(function()				
	{
		var checked_status = this.checked;
		$(".meet_id").each( function()
		{
			this.checked = checked_status;
		});
	});
});
</script>
{/literal}

