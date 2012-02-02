{include file=amwb_artists_artist_navigation.tpl}

<h3>Entries</h3>

{if $rsEntries}
{foreach item=rsEntry from=$rsEntries}
<p><strong><a href="{if $rsEntry->entry_blog_id==8}{$config.to_musicwhore}/index.php/mw/entry/{$rsEntry->entry_id}{else}/index.php/content/entry/{$rsEntry->entry_id}{/if}/">{$rsEntry->entry_title}</a></strong><br>
{$rsEntry->entry_excerpt}<br>
<span class="attribution"><em>-- Posted: {$rsEntry->entry_created_on|date_format:"%Y.%m.%d"}{if $rsEntry->category_id} | File under: <a href="{if $rsEntry->entry_blog_id==8}{$config.to_musicwhore}/index.php/mw/category/{$rsEntry->category_id}/{else}/index.php/content/category/{$rsEntry->category_id}/{/if}">{$rsEntry->category_label}</a>{/if}{if $rsEntry->entry_blog_id==8} | Redirect to: <a href="{$config.to_musicwhore}">Musicwhore.org</a>{/if}</em></span>
</p>
{/foreach}
{else}
<p>No entries are associated with this artist.</p>
{/if}
