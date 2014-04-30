{if $rsEntry->entry_status==2}
<article>
	<header>
		<div class="last source-label">
			<h3 class="source-title"><a href="/index.php/vexvox/entry/{$rsEntry->entry_id}/">{$rsEntry->entry_title}</a></h3>
		</div>

		<div>
			<time datetime="{$rsEntry->entry_authored_on|date_format:"%Y-%m-%dT%H:%M:%S-06:00"}" pubdate>
{$rsEntry->entry_authored_on|date_format:"%b %d, %Y %H:%M"}<br>
			</time>

			<p>
				<em>By {$rsEntry->author_name}</em><br>
{if $rsEntry->category_id}Filed: <a href="/index.php/vexvox/category/{$rsEntry->category_id}/">{$rsEntry->category_label}</a><br>{/if}
			</p>

		</div>
	</header>

	<section class="prepend-top last">

{if $rsEntry->entry_text}
{parse_line_breaks txt=$rsEntry->entry_text}
{if $rsEntry->entry_text_more}{parse_line_breaks txt=$rsEntry->entry_text_more}{/if}
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

	</section>
	<a id="comments"></a>

{if $rsComments}
	<header class="last source-label">
		<h4 class="source-title">Comments</h4>
	</header>

{foreach item=rsComment from=$rsComments}
	<article>
		<div>
			<p>
{$rsComment->comment_created_on|date_format:"%m/%d/%Y %H:%M:%S"}<br>
				<em>By <strong>{if $rsComment->comment_url}<a href="{$rsComment->comment_url}">{$rsComment->comment_author}</a>{else}{$rsComment->comment_author}{/if}</strong></em>
			</p>

		</div>

		<div class="prepend-top last">
{parse_line_breaks txt=$rsComment->comment_text}
		</div>
	</article>
{/foreach}
{/if}

{if $rsEntry->entry_allow_comments}

	<header class="last source-label">
		<h4 class="source-title">Post a comment</h4>
	</header>

	<section class="prepend-top last">
		<form action="{$config.to_mt}/cgi-bin/mt/mt-comments.cgi" method="post" name="comments_form" id="comments_form" onsubmit="if (this.bakecookie[0].checked) rememberMe(this)">
			<input type="hidden" name="entry_id" value="{$entry_id}" />

			<p>
				<strong>Members:</strong> {if $smarty.session.is_logged_in}[<a href="/index.php/members/logout/">Logout</a>]{else}<a href="/index.php/members/">Log in</a> to your account to pre-populate your personal information.{/if}<br>
				<strong>Non-members:</strong> Remember personal info?
				<input type="radio" id="bakecookie" name="bakecookie" /> Yes
				<input type="radio" id="forget" name="bakecookie" value="Forget Info" /> No
			</p>

			<p><label for="author">Name:</label>
				<input type="text" id="author" name="author" {if $smarty.session.is_logged_in} value="{$rsUser->user_login}"{/if} />
			</p>

			<p><label for="email">Email Address:</label>
				<input type="email" id="email" name="email" {if $smarty.session.is_logged_in} value="{$rsUser->user_email}"{/if} />
			</p>

			<p><label for="url">URL:</label>
				<input type="url" id="url" name="url" {if $smarty.session.is_logged_in} value="{$rsUser->user_url}"{/if} />
			</p>

			<p>
				<label for="text">Comments:</label>
				<textarea tabindex="4" id="text" name="text" rows="10"></textarea>
			</p>

			<p>
				<label for="preview">&nbsp;</label>
				<input type="submit" id="preview" name="preview" value="&nbsp;Preview&nbsp;" />
			</p>

		</form>
	</section>
</article>

{literal}
<script type="text/javascript">
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
</script>
{/literal}

{/if}

<hr class="bottom-rule">
<footer>
	<nav class="entry-nav">
{if $rsNext}
		<a href="/index.php/vexvox/entry/{$rsNext->entry_id}/" title="{$rsNext->entry_excerpt}">NEXT</a>{else}NEXT
{/if} &#8226;
{if $rsPrevious}
		<a href="/index.php/vexvox/entry/{$rsPrevious->entry_id}/" title="{$rsPrevious->entry_excerpt}">PREVIOUS</a>{else}PREVIOUS{/if} &#8226;
		<a href="/index.php/vexvox/entry/random/">RANDOM</a><br>
	</nav>
</footer>

{else}
<p>This entry is not published.</p>
{/if}