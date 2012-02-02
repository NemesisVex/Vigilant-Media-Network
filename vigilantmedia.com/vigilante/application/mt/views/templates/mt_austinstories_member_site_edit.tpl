<h4 class="admin_head">Site information</h4>

{if $rsSite}
<form action="/index.php/austinstories/site/update/{$site_id}/{$site_user_id}/" method="post" name="site">

{if $rsAlias}
<p><label for="site_alias_id">Identity</label>
<select name="site_alias_id">
<option value=""{if $rsSite->site_alias_id==""} selected{/if}> {get_alias_name_object obj=$rsUser}
{foreach item=rsAlias from=$rsAlias}
<option value="{$rsAlias->site_alias_id}"{if $rsSite->site_alias_id==$rsAlias->alias_id} selected{/if}> {$rsAlias->alias_name}
{/foreach}
</select></p>
{/if}

<p><label for="site_name">Site name:</label>
<input type="text" name="site_name" value="{$rsSite->site_name}" size="50"></p>

<p>
<label for="site_url">URL:</label>
<input type="text" name="site_url" value="{$rsSite->site_url}" size="50"><br>
</p>

<p>
<label for="site_rss_feed">URL for XML feed:</label>
<input type="text" name="site_rss_feed" value="{$rsSite->site_rss_feed}" size="50"><br>
</p>

<p>
<strong>Do you want this site listed in the directory?</strong><br>
<input type="radio" name="site_in_directory" value="1"{if $rsSite->site_in_directory==1} checked{/if}> Yes
<input type="radio" name="site_in_directory" value="0"{if $rsSite->site_in_directory==0} checked{/if}> No</p>
</p>

<p><input type="submit" value="Update site"></p>

</form>
{else}
<p>No record found for this index number.</p>
{/if}
