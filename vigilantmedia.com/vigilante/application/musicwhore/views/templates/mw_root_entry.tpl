{if $rsEntry->entry_status==2 || $preview==true}
{if $rsEntry->entry_text}
<div class="indent">

{parse_line_breaks txt=$rsEntry->entry_text}
{if $rsEntry->entry_text_more}{parse_line_breaks txt=$rsEntry->entry_text_more}{/if}
</div>

<div class="attribution">
	<p>
		<em>&#8212; posted by {$rsEntry->author_name} on <strong>{$rsEntry->entry_created_on|date_format:"%Y-%m-%d %H:%M:%S"}</strong>{if $rsEntry->category_id} | File under: <a href="/category/{$rsEntry->category_id}/">{$rsEntry->category_label}</a>{/if}</em>
	</p>

	<div class="indent">
{if $rsTags}
		<p>Tags:
{foreach item=rsTags from=$rsTags name=tags}<a href="http://technorati.com/tag/{$rsTags->tag_name|escape:'url'}" rel="tag">{$rsTags->tag_name}</a>{if $smarty.foreach.tags.last==false}, {/if}{/foreach}
		</p>
{/if}

		<p>
			Share:
			<a href="http://www.facebook.com/sharer.php?u={'http://www.musicwhore.org/index.php/mw/entry/'|cat:$entry_id|cat:'/'|escape:'url'}" title="[Share on Facebook]"><img src="{$config.to_vigilante}/images/icons/facebook.png" alt="[Facebook]" /></a>
			<a href="http://twitter.com/share?url={'http://musicwhore.org/index.php/mw/entry/'|cat:$entry_id|cat:'/'|escape:'url'}&amp;text={'Musicwhore.org: '|escape:'url'}{$rsEntry->entry_title|truncate:'75'|escape:'url'}" title="[Share on Twitter]"><img src="{$config.to_vigilante}/images/icons/twitter.png" alt="[Twitter]" /></a>
			<a href="http://del.icio.us/post" id="delicious_link" title="[Share on Delicious]"><img src="{$config.to_vigilante}/images/icons/delicious.png" alt="[Delicious]" /></a>
		</p>
	</div>
</div>

{if $rsAlbum}
<div class="indent">
	<h3>Album information</h3>

{if $image_uri}
	<p>
		<img src="{$image_uri}" alt="[{format_artist_name_object obj=$rsArtist}: {$rsAlbum->album_title}]" title="[{format_artist_name_object obj=$rsArtist}: {$rsAlbum->album_title}]">
	</p>
{/if}

	<p>
		<strong>{format_artist_name_object obj=$rsArtist}</strong><br>
		<strong><em>{$rsAlbum->album_title}</em></strong><br>
		({$rsAlbum->album_label})<br>
	</p>

{if $amazon_url || $rsLinks}
	<p>
		<strong>Buy</strong><br>
{if $amazon_url}<img src="/images/shopping_cart.gif" width="11" height="9" alt="[BUY]" border="0"> <a href="{$amazon_url}">Amazon</a><br>{/if}
{foreach item=rsLink from=$rsLinks}
{if $rsLink.merchant_id != 2}
		<img src="/images/shopping_cart.gif" width="11" height="9" alt="[BUY]" border="0"> <a href="{$rsLink.ecommerce_url}">{$rsLink.merchant_name}</a><br>
{/if}
{/foreach}
	</p>
{/if}

</div>

{/if}

<a name="comments"></a>

{if $rsComments}
<div class="indent">
	<h3 class="comment_head">Comments</h3>
{foreach item=rsComment from=$rsComments}
	<div class="comment-body">
{parse_line_breaks txt=$rsComment->comment_text}

		<p>&#8212; <em>Posted by <strong>{if $rsComment->comment_url}<a href="{$rsComment->comment_url}">{/if}{$rsComment->comment_author}{if $rsComment->comment_url}</a>{/if}</strong> on {$rsComment->comment_created_on|date_format:"%m/%d/%Y %H:%M:%S"}</em></p>
	</div>
{/foreach}
</div>
{/if}

{if $rsEntry->entry_allow_comments}
<div class="indent">
	<h3 class="comment_head">Post a comment</h3>

	<form action="{$config.to_mt}/cgi-bin/mt/mt-comments.cgi" method="post" name="comments_form" id="comments_form">
		<input type="hidden" name="entry_id" value="{$entry_id}" />

		<p>
			<label for="author">Name:</label>
			<input type="text" id="author" name="author" size="50"{if $smarty.session.is_logged_in} value="{$rsUser->user_login}"{/if} /><br clear="all">
		</p>

		<p>
			<label for="email">Email Address:</label>
			<input type="text" id="email" name="email" size="50"{if $smarty.session.is_logged_in} value="{$rsUser->user_email}"{/if} /><br clear="all">
		</p>

		<p>
			<label for="url">URL:</label>
			<input type="text" id="url" name="url" size="50"{if $smarty.session.is_logged_in} value="{$rsUser->user_url}"{/if} /><br clear="all">
		</p>

		<p>
			<label for="backcookie">Remember personal info?</label>
			<input type="radio" id="bakecookie" name="bakecookie" /> Yes
			<input type="radio" id="forget" name="bakecookie" value="Forget Info"> No<br clear="left" />
		</p>

		<p>
			<label for="text">Comments:</label>
			<textarea tabindex="4" id="text" name="text" rows="10" cols="70"></textarea><br clear="all">
		</p>

		<p>
			<label for="preview">&nbsp;</label>
			<input type="submit" name="preview" value="&nbsp;Preview&nbsp;">
		</p>

		<p class="smaller">
			All comments are moderated, an unfortunate side effect of battling spam.
		</p>

	</form>

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
		$('#delicious_link').click(function ()
		{
			window.open('http://del.icio.us/post?v=4&amp;noui&amp;jump=close&amp;url='+encodeURIComponent(location.href)+'&amp;title='+encodeURIComponent(document.title), 'delicious','toolbar=no,width=700,height=400');
			return false;
		})
	});
	</script>
{/literal}
</div>
{/if}

{/if}
{else}
<p>This entry is not yet published.</p>
{/if}

