{if $rsEntry->entry_status==2}
<header>
	<code><time datetime="{$rsEntry->entry_created_on|date_format:"%Y-%m-%dT%H:%M:%S-06:00"}" pubdate="pubdate">{$rsEntry->entry_created_on|date_format:"%A.%Y.%m.%d.%H:%M"}</time></code>
	<hr />
</header>

{if $rsEntry->entry_text}
{eval_entry txt=$rsEntry->entry_text}
{else}
<p>No journal entry yet written.</p>
{/if}

<p class="tags">
{if $rsTags}
	<strong>Tags:</strong>
{foreach item=rsTags from=$rsTags name=tags}<a href="http://technorati.com/tag/{$rsTags->tag_name|escape:"url"}" rel="tag">{$rsTags->tag_name}</a>{if $smarty.foreach.tags.last==false}, {/if}{/foreach}
	<br>
{/if}
</p>

<a id="comments"></a>
{if $rsComments}
<h3 class="comment-head">COMMENTS</h3>
{foreach item=rsComment from=$rsComments}
<div class="comment-body">
{parse_line_breaks txt=$rsComment->comment_text}
</div>

<p>&#8212; <em>Posted by <strong>{if $rsComment->comment_url}<a href="{$rsComment->comment_url}">{$rsComment->comment_author}</a>{else}{$rsComment->comment_author}{/if}</strong> on {$rsComment->comment_created_on|date_format:"%m/%d/%Y %H:%M:%S"}</em></p>
{/foreach}
{/if}

{if $rsEntry->entry_allow_comments}

<h3 class="comment-head">POST A COMMENT</h3>

<form action="{$config.to_mt}/cgi-bin/mt/mt-comments.cgi" method="post" name="comments_form" id="comments_form" onsubmit="if (this.bakecookie[0].checked) rememberMe(this)">
	<input type="hidden" name="entry_id" value="{$entry_id}">

	<p>
		<strong>Members:</strong> {if $smarty.session.is_logged_in}[<a href="/index.php/members/logout/">Logout</a>]{else}<a href="/index.php/members/">Log in</a> to your account to pre-populate your personal information.{/if}<br>
		<strong>Non-members:</strong> Remember personal info?
		<input type="radio" id="bakecookie" name="bakecookie"> Yes
		<input type="radio" id="forget" name="bakecookie" value="Forget Info"> No
	</p>

	<p>
		<label for="author">Name:</label>
		<input type="text" id="author" name="author" size="50"{if $smarty.session.is_logged_in} value="{$rsUser->user_login}"{/if}>
	</p>

	<p><label for="email">Email Address:</label>
		<input type="text" id="email" name="email" size="50"{if $smarty.session.is_logged_in} value="{$rsUser->user_email}"{/if}>
	</p>

	<p><label for="url">URL:</label>
		<input type="text" id="url" name="url" size="50"{if $smarty.session.is_logged_in} value="{$rsUser->user_url}"{/if}>
	</p>

	<p><label for="text">Comments:</label>
		<textarea tabindex="4" id="text" name="text" rows="10" cols="70"></textarea>
	</p>

	<p>
		<label>&nbsp;</label>
		<input type="submit" name="preview" value="&nbsp;Preview&nbsp;">
	</p>

</form>

<script type="text/javascript" src="{$config.to_vigilante}/js/jquery.cookie.js"></script>
<script type="text/javascript">
{literal}
function fix_date (date)
{
    var base = new Date(0);
    var skew = base.getTime();
    if (skew > 0)
        date.setTime(date.getTime() - skew);
}

$(document).ready(function ()
{
	if ($('#author').val() == '') {$('#author').val($.cookie('mtcmtauth'));}
	if ($('#email').val() == '') {$('#email').val($.cookie('mtcmtmail'));}
	if ($('#url').val() == '') {$('#url').val($.cookie('mtcmthome'));}
	if ($.cookie('mtcmtauth')) {$('#bakecookie').attr('checked', true)}
	$('#forget').click(function ()
	{
		$.cookie('mtcmtauth', null, {path: '/'});
		$.cookie('mtcmtmail', null, {path: '/'});
		$.cookie('mtcmthome', null, {path: '/'});
		$('#author').val('');
		$('#email').val('');
		$('#url').val('');
	});
	$('#comments_form').submit(function ()
	{
		if ($('#bakecookie').attr('checked')==true)
		{
		    var now = new Date();
		    fix_date(now);
		now.setTime(now.getTime() + 365 * 24 * 60 * 60 * 1000);
			$.cookie('mtcmtauth', $('#author').val(), {expires: now, path: '/'});
			$.cookie('mtcmtmail', $('#email').val(), {expires: now, path: '/'});
			$.cookie('mtcmthome', $('#url').val(), {expires: now, path: '/'});
		}
	});
});
{/literal}
</script>

{/if}

<hr class="bottom-rule">
<span class="entry-nav">
{if $rsNext}<a href="/index.php/journal/entry/{$rsNext->entry_id}/" title="{$rsNext->entry_excerpt|escape:"html"}">NEXT</a>{else}NEXT{/if} &#8226;
{if $rsPrevious}<a href="/index.php/journal/entry/{$rsPrevious->entry_id}/" title="{$rsPrevious->entry_excerpt|escape:"html"}">PREVIOUS</a>{else}PREVIOUS{/if} &#8226;
	<a href="/index.php/journal/entry/random/">RANDOM</a><br>
{if $rsPastEntries}
	ON THIS DAY IN:
{foreach item=rsPastEntry from=$rsPastEntries name="past"}
	<a href="/index.php/journal/entry/{$rsPastEntry->entry_id}/">{$rsPastEntry->entry_created_on|date_format:"%Y"}</a>
{if $smarty.foreach.past.last == false} &#8226; {/if}
{/foreach}
{/if}
</span>

{else}
<p>This entry is not published.</p>
{/if}