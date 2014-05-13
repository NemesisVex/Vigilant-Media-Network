{if $rsPosts}
{if $page_links}
<p>
More results: {$page_links}
</p>
{/if}

{foreach item=rsPost from=$rsPosts}
<p><span class="headline"><a href="{$rsPost->portal_url}">{$rsPost->portal_headline}</a></span><br>
{$rsPost->portal_body_text}<br>
<font size=1><em>-- posted {$rsPost->portal_date_added|date_format:"%m/%d/%Y %I:%M:%S %p"}</em></font><br></p>
{/foreach}

{if $page_links}
<p>
More results: {$page_links}
</p>
{/if}
{else}
<p>This site has no published posts.</p>
{/if}

