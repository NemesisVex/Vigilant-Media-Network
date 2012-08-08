<div class="columns">
<div class="column-left-short">
{*if $rsMeet}
<div class="box-head">NEXT MEETINGS</div>
<div class="box-body">
{foreach item=rsMeet from=$rsMeet}
<p><em>{$rsMeet->meet_date|date_format:"%A, %B %d, %Y %R"}</em><br>
<strong>{$rsMeet->meet_location}</strong>{if $rsMeet->meet_address}<br>
{$rsMeet->meet_address}<br>
<a href="http://maps.google.com/maps?q={$rsMeet->meet_address|escape:"url"},+Austin,+TX">View a map</a>{/if}</p>
{/foreach}

<p>
<strong>-- <a href="/meetings.php">More dates</a> &gt;&gt;</strong><br>
<strong>-- <a href="http://groups.yahoo.com/groups/austexjournal/">Join our list</a> &gt;&gt;</strong><br>
</p>
</div><br>
{/if*}

{if $rsNewSites}
<div class="box-head">NEW SITES</div>
<div class="box-body">
{foreach item=rsNewSite from=$rsNewSites}
<strong><a href="{$rsNewSite->site_url}">{$rsNewSite->site_name}</a></strong> by {get_alias_name_object obj=$rsNewSite} <em>(Added: {$rsNewSite->site_date_added|date_format:"%m/%d/%Y"})</em><br>
{/foreach}
<p><strong><a href="/index.php/directory/">All sites</a></strong> &raquo;</p>
</div><br>
{/if}

{if $rsEntries}
<div class="box-head">SITE NEWS</div>
<div class="box-body">
{foreach item=rsEntry from=$rsEntries}
<em>{$rsEntry->entry_created_on|date_format:"%m/%d/%Y"}</em> <strong><a href="/index.php/news/entry/{$rsEntry->entry_id}/">{$rsEntry->entry_title}</a></strong><br>
{/foreach}<br>

<p><strong><a href="/index.php/news/">Read more</a></strong> &raquo;</p>

</div><br>
{/if}

{*
<div class="box-head">LINK TO US</div>
<div class="box-body">
<img src="/images/bug_austinstories_01.gif" width="88" height="31" alt="[austin stories]" border="0"><br><br>
<img src="/images/bug_austinstories_02.gif" width="88" height="31" alt="[austin stories]" border="0">
</div><br>
*}

{if $feed}
<div class="box-head">AUSTIN BLOGGERS</div>
<div class="box-body">
{foreach key=key item=feed from=$feed}
<strong><a href="{$feed.link|escape:"html"}">{$feed.title}</a></strong><br>
{$feed.description|regex_replace:"/(\(via.+\))/":"<em>\\1</em>"}<br>
{/foreach}

<p><strong><a href="/index.php/aus/bloggers/">Read more</a> &raquo;</strong></p>
</div>
{/if}

<p><a href="/rss.xml"><img src="/images/rss_button.gif" width="36" height="14" alt="[RSS]" border="0"></a></p>

<p><a href="{$config.to_journalcon}/"><img src="{$config.to_journalcon}/images/jconbutton2.gif" alt="[JournalCon 2003]" width="144" height="45" border="1"></a></p>

</div>
<div class="column-right-long">

{foreach item=rsPost from=$rsPosts}
{assign var=pubDate value=$rsPost->portal_date_added|date_format:"%A, %B %d, %Y"}
{assign var=prevDate value=$pubDate}
{if $nextDate!=$prevDate}
<h3 class="pubdate">{$pubDate}</h3>

{/if}
<p>
<a href="{$rsPost->site_url}">{$rsPost->site_name}</a> by <a href="/index.php/directory/posts/{$rsPost->site_id}/">{get_alias_name_object obj=$rsPost}</a><br>
<span class="headline"><a href="{$rsPost->portal_url}">{$rsPost->portal_headline|escape}</a></span><br>
{$rsPost->portal_body_text|escape}<br>
<span class="date">-- posted {$rsPost->portal_date_added|date_format:"%m/%d/%Y %I:%M:%S %p"}</span>
{assign var=nextDate value=$prevDate}
</p>

{/foreach}

{*<a href="/index.php/aus/robots/"><img src="/images/1pixel.gif" width="1" height="1" alt="[robots]" border="0"></a>*}
</div>
</div>

