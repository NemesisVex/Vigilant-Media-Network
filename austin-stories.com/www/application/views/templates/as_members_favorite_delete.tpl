<div class="AdminHead">Delete favorite site</div>

{if $rsFavorite}
<form action="/index.php/members/favorite/remove/{$favorite_id}/" method="post" name="post">

<p><span style="color: #F99;"><strong>WARNING:</strong></span> Deleting a site will permanently remove it from your favorites list. [<a href="/index.php/help/topic/account_delete/1/" class="help">More info</a>]</p>

<p>Are you sure you want to delete <strong><a href="{$rsFavorite->site_url}">{$rsFavorite->site_name}</a></strong> <em>permanently</em> from your favorites list?<br>

<p>
<input type="hidden" name="site_name" value="{$rsFavorite->site_name}">
<input type="submit" id="confirm" name="confirm" value="Yes">
<input type="submit" name="confirm" value="No">
</p>

<script type="text/javascript">
{literal}
$(document).ready(function ()
{
	$('#confirm').click(function () {return confirm_delete('favorite site');});
});
{/literal}
</script>
</form>
{else}
<p>No record was found for this favorite site.</p>
{/if}