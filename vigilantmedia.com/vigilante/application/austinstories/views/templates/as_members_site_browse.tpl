{if $rsSites}
<p>The following sites are available for you to edit:</p>

{foreach item=rsSites from=$rsSites}
[<a href="/index.php/members/site/edit/{$rsSites->site_id}/">Edit</a>]
[<a href="/index.php/members/site/delete/{$rsSites->site_id}/">Delete</a>] <strong><a href="{$rsSites->site_url}">{$rsSites->site_name}</a></strong><br>
{/foreach}
{else}
<p>You don't have any sites.</p>
{/if}
