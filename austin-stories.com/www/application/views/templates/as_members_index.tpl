{if $rsPosts}
<div style="border-bottom:1px solid #FFB114; font-size: 11px;"><strong>RECENT POSTS</strong></div>
<p>
{foreach item=rsPost from=$rsPosts}
[<a href="/index.php/members/post/edit/{$rsPost->portal_id}/">Edit</a>] [<a href="/index.php/members/post/delete/{$rsPost->portal_id}/">Delete</a>] <strong><a href="{$rsPost->portal_url}">{$rsPost->portal_headline}</a></strong><br>
{/foreach}
</p>

<p><a href="/index.php/members/post/browse/{$user_id}/">Browse all posts</a> &raquo;</p>
{/if}

<div style="border-bottom:1px solid #FFB114; font-size: 11px;">
<strong>FAVORITE SITES</strong>
</div>

{if $rsFavorites}
<p>
{foreach item=rsFavorite from=$rsFavorites}
<strong><a href="{$rsFavorite->site_url}">{$rsFavorite->site_name}</a></strong> by <a href="/index.php/directory/posts/{$rsFavorite->site_id}/">{get_alias_name_object obj=$rsFavorite}</a>{if $rsFavorite->site_rss_feed} [<a href="/index.php/directory/feed/{$rsFavorite->site_id}/">RSS</a>]{/if}<br>
{/foreach}
</p>
{else}
<p>You have yet to add sites to your favorites list.</p>
{/if}

{if $rsFeedPosts}
<div style="border-bottom:1px solid #FFB114; font-size: 11px;"><strong>LATEST POSTS BY FAVORITE SITES</strong></div>

{foreach item=rsFeedPost from=$rsFeedPosts}
<p style="text-align: justify">
<a href="{$rsFeedPost->site_url}">{$rsFeedPost->site_name}</a> by <a href="/index.php/directory/posts/{$rsFeedPost->site_id}/">{get_alias_name_object obj=$rsFeedPost}</a><br>
<span class="headline"><a href="{$rsFeedPost->portal_url}">{$rsFeedPost->portal_headline}</a></span><br>
{$rsFeedPost->portal_body_text}<br>
<span class="date">-- posted {$rsFeedPost->portal_date_added|date_format:"%m/%d/%Y %I:%M:%S %p"}</span>
</p>
{/foreach}
{else}
<p>There are no posts yet to show. Please add journals to your favorite list, or tell your favorite authors to update.</p>
{/if}

{*if $feed}
<div style="border-bottom:1px solid #FFB114; font-size: 11px;"><strong>LATEST FEED ITEMS BY FAVORITE SITES</strong></div>

{foreach item=feed from=$feed}
{if $feed.dc.creator}{assign var=author value=$feed.dc.creator}
{elseif $feed.author_name}{assign var=author value=$feed.author_name}
{/if}
<p>
<a href="{$feed.channel_link}">{$feed.channel_title}</a> by {$author}<br>
<span class="headline"><a href="{$feed.link}"{if $feed.description} title="{$feed.description}"{/if}>{$feed.title}</a></span><br>
<span style="font-size: smaller;"><em>-- posted {$feed.date_timestamp|date_format:"%m/%d/%Y %H:%M:%S"}</em></span><br></p>
{/foreach}
{/if*}
