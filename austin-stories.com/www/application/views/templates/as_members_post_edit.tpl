<form action="/index.php/members/post/{if $post_id}update/{$post_id}{else}create{/if}/" method="post" name="post" id="post">

<p>Use this form to post or change an entry to the portal. [<a href="/index.php/help/topic/portal_post/1/" class="help">Help</a>]</p>

<div class="box-body">
<p><em>Here is a live preview of your post. Make sure JavaScript is enabled.</em></p>

<p>
<strong><a href="{$input.site_url}" id="preview_site_name">{$input.site_name}</a></strong> by <span id="preview_user_name">{get_alias_name_object obj=$rsPost}</span><br>
<span class="headline"><a href="{$input.portal_url}" id="preview_headline">{$input.portal_headline}</a></span><br>
</p>
<p id="preview_body_text">{$input.portal_body_text|regex_replace:"/<(|\/)a([^>]*)>/":""|escape:"html"}</p>
</div>

{if $input.portal_date_added}
<p>
<label>Date posted:</label> {$input.portal_date_added|date_format:"%h %d, %Y %H:%M:%S"}<br>
</p>
{/if}

<p><label for="portal_site_id">Site:</label>
<select name="portal_site_id" id="portal_site_id">
{foreach item=rsSite from=$rsSites}
<option value="{$rsSite->site_id}"{if $input.portal_site_id==$rsSite->site_id} selected{/if}> {$rsSite->site_name}</option>
{/foreach}
</select></p>

<p><label for="portal_headline">Headline:</label>
<input type="text" name="portal_headline" id="portal_headline" value="{$input.portal_headline|escape:"html"}" size="40"><br clear="left">
</p>

<p>
<label for="portal_url">URL to entry:</label>
<input type="text" name="portal_url" id="portal_url" value="{$input.portal_url|escape:"html"}" size="40"><br clear="left">
</p>

<p>
<strong>Portal text:</strong> (max. 50 words)<br>
<textarea name="portal_body_text" id="portal_body_text" rows="7" cols="50">{$input.portal_body_text|regex_replace:"/<(|\/)a([^>]*)>/":""|escape:"html"}</textarea><br clear="left">
</p>

<p>
<strong>Save this post as:</strong><br>
<input type="radio" name="portal_publish_status" value="0"{if $input.portal_publish_status==0} checked{/if}> <strong>A draft</strong> (text is saved but not posted to the site)<br>
<input type="radio" name="portal_publish_status" value="1"{if $input.portal_publish_status==1} checked{/if}> <strong>A published post</strong> (text is saved and posted to site)<br>
</p>

<input type="hidden" name="portal_date_added" value="{if $input.portal_date_added}{$input.portal_date_added}{else}{$smarty.now|date_format:"%Y-%m-%d %H:%M:%S"}{/if}">

<p><input type="submit" value="Save post"></p>

</form>

<script type="text/javascript">
var aliases = new Array();
var site_urls = new Array();

{foreach item=rsSite from=$rsSites}
aliases[{$rsSite->site_id}] = '{get_alias_name_object obj=$rsSite}';
site_urls[{$rsSite->site_id}] = "{$rsSite->site_url}";
{/foreach}

{literal}
function preview_text(source, destination)
{
	destination.html(source.value);
}

$(document).ready(function ()
{
	$('#preview_headline').html($('#portal_headline').val());
	$('#preview_url').html($('#portal_url').val());
	$('#preview_body_text').html($('#portal_body_text').val());
	$('#preview_site_name').html($('#portal_site_id option:selected').text());
	$('#preview_site_name').attr('href', site_urls[$('#portal_site_id option:selected').val()]);
	$('#preview_user_name').html(aliases[$('#portal_site_id option:selected').val()]);
	
	$('#portal_headline').keyup(function () {preview_text(this, $('#preview_headline'));});
	$('#portal_url').blur(function () {preview_text(this, $('#preview_url'));});
	$('#portal_body_text').keyup(function () {preview_text(this, $('#preview_body_text'));});
	$('#portal_site_id').change(function ()
	{
		var site_id = $('#portal_site_id option:selected').val();
		var site_name = $('#portal_site_id option:selected').text();
		
		$('#preview_site_name').html(site_name);
		$('#preview_site_name').attr('href', site_urls[site_id]);
		$('#preview_user_name').html(aliases[site_id]);
	});
	
	$('#post').validate(
	{
		rules:
		{
			portal_headline: {required: true},
			portal_url: {required: true, url: true},
			portal_body_text: {required: true}
		}
	});
});
{/literal}
</script>
