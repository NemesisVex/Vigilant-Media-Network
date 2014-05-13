<div class="columns">
<div class="column-right-short">
<p align="center"><a href="http://www.austinbloggers.org/"><img src="/images/bug_austinbloggers.png" width="88" height="33" alt="" border="0"></a></p>
<div class="box-body">
<p>In their own words: "The <strong>Austin Meta-Blog</strong> aggregates articles about Austin, blogged by our members."</p>

<p>The <strong><a href="http://www.austinbloggers.org/">Austin Bloggers</a></strong> also provide their own <a href="http://www.austinbloggers.org/blog/metablog.xml">RSS feed</a>, which <strong><a href="/">Austin Stories</a></strong> offers here.</p>
</div>
</div>

<div class="column-left-long">
{if $feed}

{foreach item=feed from=$feed}
{if $feed.title!="(this entry has been removed)"}
<p><strong><a href="{$feed.link}">{$feed.title}</a></strong><br>
{$feed.description|regex_replace:"/(\(via.+\))/":"<em>\\1</em>"}<br></p>
{/if}
{/foreach}
{else}
<p>RSS feed unavailable at this time.</p>
{/if}

</div>

</div>

