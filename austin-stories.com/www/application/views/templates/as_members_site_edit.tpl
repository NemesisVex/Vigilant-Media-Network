<form action="/index.php/members/site/{if $site_id}update/{$site_id}{else}create{/if}/" method="post" name="site" id="site">

<p>Use this form to add or to edit your site information. [<a href="/index.php/help/topic/account_sites/1/" class="help">Help</a>]</p>

{if $rsAliases}
<p><label for="site_alias_id">Identity</label>
<select name="site_alias_id">
<option value=""{if $rsSite->site_alias_id==""} selected{/if}> {get_alias_name_object obj=$rsUser}
{foreach item=rsAlias from=$rsAliases}
<option value="{$rsAlias->alias_id}"{if $rsSite->site_alias_id==$rsAlias->alias_id} selected{/if}> {$rsAlias->alias_name}
{/foreach}
</select></p>
{/if}

<p><label for="site_name">Site name:</label>
<input type="text" name="site_name" id="site_name" value="{$rsSite->site_name}" size="50"><br clear="left">
</p>

<p>
<label for="site_url">URL:</label>
<input type="text" name="site_url" id="site_url" value="{$rsSite->site_url}" size="50"><br clear="left">
</p>

<p>
<label for="site_rss_feed">URL for XML feed:</label>
<input type="text" name="site_rss_feed" value="{$rsSite->site_rss_feed}" size="50"><br>
</p>

<p>
<strong>Do you want this site listed in the directory?</strong><br>
<input type="radio" name="site_in_directory" value="1"{if $rsSite!='' && $rsSite->site_in_directory==1} checked{elseif $rsSite->site_in_directory==''}checked{/if}> Yes
<input type="radio" name="site_in_directory" value="0"{if $rsSite!='' && $rsSite->site_in_directory==0} checked{/if}> No</p>
</p>

<p><input type="submit" value="Update site"></p>

</form>

<script type="text/javascript">
{literal}
$(document).ready(function ()
{
	$('#site').validate(
	{
		rules:
		{
			site_name: {required: true},
			site_url: {required: true, url: true}
		}
	});
});
{/literal}
</script>