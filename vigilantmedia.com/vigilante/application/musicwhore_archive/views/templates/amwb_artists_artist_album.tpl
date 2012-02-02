{include file=amwb_artists_artist_navigation.tpl}

<p>
{foreach item=rsFormat from=$rsFormats}
{assign var=format_mask value=$rsFormat->album_format_mask}
{if $config.album_format_mask.$format_mask=="ep"}
{assign var=mask_nav value=$config.album_format_mask.$format_mask|upper}
{else}
{assign var=mask_nav value=$config.album_format_mask.$format_mask|capitalize}
{/if}
~ <a href="/index.php/artists/album/browse/{$artist_id}/{$rsFormat->album_format_mask}/" style="font-weight: {if $format_mask==$rsFormat->album_format_mask}bold{else}normal{/if};">{$mask_nav}s</a>
{/foreach}
</p>

{if $rsAlbums}
<p>
{assign var=prev value=''}
{assign var=next value=''}

{foreach item=rsAlbum from=$rsAlbums}
{assign var=prev value=$rsAlbum->album_id}
{if $prev!=$next}
{assign var=formatMask value=$rsAlbum->album_format_mask}
<em><strong>{$rsAlbum->album_title}</strong></em>{if $rsAlbum->album_alt_title!=""} <em>({$rsAlbum->album_alt_title})</em>{/if}<br>
{if $rsAlbum->album_soloist_id || $rsAlbum->album_conductor_id || $rsAlbum->album_ensemble_id}
{if $rsAlbum->album_soloist_id}&raquo; {format_artist_name lname=$rsAlbum->soloist_artist_last_name fname=$rsAlbum->soloist_artist_first_name asian=0}{if $rsAlbum->soloist_part}, {$rsAlbum->soloist_part}{/if} {/if}
{if $rsAlbum->album_conductor_id}&raquo; {format_artist_name lname=$rsAlbum->conductor_artist_last_name fname=$rsAlbum->conductor_artist_first_name asian=0} {/if}
{if $rsAlbum->album_ensemble_id}&raquo; {$rsAlbum->ensemble_artist_last_name}{/if}
<br>
{/if}
{/if}
<span style="font-size: 85%">
{if $rsAlbum->release_catalog_num}~ <a href="/index.php/artists/album/tracks/{$rsAlbum->release_id}/{$artist_id}/">{$rsAlbum->release_catalog_num}</a> {/if}
{if $rsAlbum->release_label}~ {$rsAlbum->release_label} {elseif $rsAlbum->album_label}~ {$rsAlbum->album_label} {/if}
{if $rsAlbum->format_alias}~ {$rsAlbum->format_alias} {/if}
{if $rsAlbum->release_country_name}~ {$rsAlbum->release_country_name} {/if}
{if $rsAlbum->release_release_date}~ {$rsAlbum->release_release_date|date_format:"%Y.%m.%d"} {elseif $rsAlbum->album_release_date}~ {$rsAlbum->album_release_date|date_format:"%Y.%m.%d"} {/if}
{if $rsAlbum->release_alt_title}~ <em>{$rsAlbum->release_alt_title}</em> {/if}
<br>
</span>
{assign var=next value=$prev}
{/foreach}</p>
{/if}

