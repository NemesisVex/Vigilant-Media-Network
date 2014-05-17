<h4 class="admin_head">User Log</h4>

<table class="Admin_Wide">
<tr>
	<th>DATE</td>
	<th>LOG MESSAGE</td>
	<th>IP</td>
</tr>
{foreach key=e item=rsLog from=$rsLogs}
<tr>
	<td>{$rsLog->log_date_added|date_format:"%m/%d/%Y %H:%M:%S"}</td>
	<td>{$rsLog->log_message}</td>
	<td>{$rsLog->log_ip}</td>
</tr>
{/foreach}
</table>

{if $page_links}
<p>
{$page_links}
</p>
{/if}