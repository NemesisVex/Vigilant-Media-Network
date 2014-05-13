{if $rsFavorites}
<p>The following sites are currently on your favorites list:</p>

{foreach item=rsFavorites from=$rsFavorites}
[<a href="/index.php/members/favorite/delete/{$rsFavorites->favorite_id}/">Delete</a>] <strong><a href="{$rsFavorites->site_url}">{$rsFavorites->site_name}</a></strong><br>
{/foreach}
{else}
<p>You have no sites on your favorite list.</p>
{/if}
