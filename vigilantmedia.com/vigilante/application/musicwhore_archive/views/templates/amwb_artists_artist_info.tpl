{include file=amwb_artists_artist_navigation.tpl}

{if $rsArtist->artist_biography}
<h3>Profile</h3>

{if $rsArtist->artist_biography}
{if $artist_image}
<div style="float: right; padding-left: 10px;">
<img src="/images/1pixel.gif" alt="[{format_artist_name_object obj=$rsArtist}]" id="artist_img"><img src="/images/1pixel.gif" id="artist_mask">

{if $rsMembers}
<p>
{foreach item=rsMember from=$rsMembers}
<strong>{if $rsMember->member_asian_name_utf8}{$rsMember->member_asian_name_utf8} ({$rsMember->member_name}){else}{$rsMember->member_name}{/if}</strong>: {$rsMember->member_instruments}<br>
{/foreach}
</p>
{/if}

{if $rsRelations}
<p>
<strong>Related artists</strong><br>
{foreach item=rsRelation from=$rsRelations}
~ <a href="/index.php/artists/artist/info/{$rsRelation->related_relation_id}/">{format_artist_name_object obj=$rsRelation}</a><br>
{/foreach}
</p>
{/if}

{if $rsSimilars}
<p>
<strong>Similar artists</strong><br>
{foreach item=rsSimilar from=$rsSimilars}
~ <a href="/index.php/artists/artist/info/{$rsSimilar->related_relation_id}/">{format_artist_name_object obj=$rsSimilar}</a><br>
{/foreach}
</p>
{/if}
</div>
{/if}

{parse_line_breaks txt=$rsArtist->artist_biography}

{if $rsArtist->artist_biography_more}<p><strong><a href="/index.php/artists/artist/profile/{$artist_id}/" style="font-variant: small-caps">More</a> &raquo;</strong></p>{/if}
{/if}


{/if}

{if $rsEntries}
<h3>Entries</h3>

<p>
{foreach item=rsEntry from=$rsEntries}
<strong><a href="{if $rsEntry->entry_blog_id==8}{$config.to_musicwhore}/index.php/mw/entry/{$rsEntry->entry_id}{else}/index.php/content/entry/{$rsEntry->entry_id}{/if}/">{$rsEntry->entry_title}</a></strong><br>
<span class="attribution"><em>-- Posted: {$rsEntry->entry_created_on|date_format:"%Y-%m-%d"}{if $rsEntry->category_id} | File under: <a href="{if $rsEntry->entry_blog_id==8}{$config.to_musicwhore}/index.php/mw/category/{$rsEntry->category_id}{else}/index.php/content/category/{$rsEntry->category_id}{/if}/">{$rsEntry->category_label}</a>{/if}</em></span><br>
{/foreach}
</p>

{if $entry_count > 5}<p><strong><a href="/index.php/artists/content/browse/{$artist_id}/" style="font-variant: small-caps">More</a> &raquo;</strong></p>{/if}
{/if}

<h3>Shop</h3>

<p>Visit these merchants for more products by <strong>{format_artist_name_object obj=$rsArtist}</strong>.</p>

{assign var=locale value=$rsArtist->artist_default_amazon_locale}
<ul>
{if $locale}<li> <a href="http://{$config.amazon_locale.$locale.domain}/exec/obidos/redirect?link_code=ur2&amp;tag={$config.amazon_locale.$locale.associateID}&amp;camp=1789&amp;creative=9325&amp;path=external-search%3Fsearch-type=ss%26index=blended%26keyword={$artistName|escape:"url"}">Amazon</a></li>{/if}
{if $itunes_url}<li> <a href="{$itunes_url}">iTunes</a></li>{/if}
{if $yesasia_url}<li> <a href="{$yesasia_url}">YesAsia</a></li>{/if}
</ul>

<script type="text/javascript">
var file_system = '{$rsArtist->artist_file_system}';

{literal}
$(document).ready(function ()
{
	get_artist_image(file_system);
});


{/literal}
</script>