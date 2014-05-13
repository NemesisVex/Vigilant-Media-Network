{if $rsSite}
<form action="/index.php/members/site/remove/{$site_id}/" method="post" name="site">

<p><span style="color: #F99;"><strong>WARNING:</strong></span> Deleting a site will permanently remove it and all associated portal postings from the database. You cannot undo deletions once they're performed. [<a href="/index.php/help/topic/account_delete/1/" class="help">More info</a>]</p>

<p>Are you sure you want to delete <strong><a href="{$rsSite->site_url}">{$rsSite->site_name}</a></strong> <em>permanently</em> from the database?</p>

<p>
<input type="hidden" name="site_name" value="{$rsSite->site_name}">
<input type="submit" id="confirm" name="confirm" value="Yes">
<input type="submit" name="confirm" value="No">
</p>

<script type="text/javascript">
{literal}
$(document).ready(function ()
{
	$('#confirm').click(function () {return confirm_delete('site');});
});
{/literal}
</script>
</form>
{else}
<p>No record was found for this site.</p>
{/if}