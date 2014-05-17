
<h4 class="admin_head">Edit post</h4>

<form action="/index.php/austinstories/post/update/{$post_id}/{$site_user_id}/" method="post">

<p><label for="site_id">Site:</label>
<select name="portal_site_id">
{foreach item=rsSite from=$rsSites}
<option value="{$rsSite->site_id}"{if $rsPost->portal_site_id==$rsSite->site_id} selected{/if}> {$rsSite->site_name}
{/foreach}
</select></p>

<p><label for="portal_headline">Headline:</label>
<input type="text" name="portal_headline" value="{$rsPost->portal_headline|escape:"html"}" size="40">
</p>

<p>
<label for="portal_url">URL to entry:</label>
<input type="text" name="portal_url" value="{$rsPost->portal_url|escape:"html"}" size="40">
</p>

<p>
<strong>Portal text:</strong> (max. 50 words)<br>
<textarea name="portal_body_text" rows="7" cols="50">{$rsPost->portal_body_text|escape:"html"}</textarea>
</p>

<p>
<strong>Save this post as:</strong><br>
<input type="radio" name="portal_publish_status" value="0"{if $rsPost->portal_publish_status==0} checked{/if}> <strong>A draft</strong> (text is saved but not posted to the site)<br>
<input type="radio" name="portal_publish_status" value="1"{if $rsPost->portal_publish_status==1} checked{/if}> <strong>A published post</strong> (text is saved and posted to site)<br></p>
</p>

<input type="hidden" name="portal_date_added" value="{$rsPost->portal_date_added}">

<p><input type="submit" value="Save post"></p>

</form>

