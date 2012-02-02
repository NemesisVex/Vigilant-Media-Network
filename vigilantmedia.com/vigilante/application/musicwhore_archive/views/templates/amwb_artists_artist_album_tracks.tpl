{include file=amwb_artists_artist_navigation.tpl}

{if $image_uri}<p><img src="{$image_uri}" alt="[{$rsRelease->album_title|escape}]" id="album_img"><img src="/images/1pixel.gif" id="album_mask"></p>{/if}

<p><em><strong>{$rsRelease->album_title|escape}</strong></em> {if $rsRelease->album_alt_title|escape}<em>({$rsRelease->album_alt_title})</em>{/if}<br>
{if $rsRelease->album_soloist_id || $rsRelease->album_conductor_id || $rsRelease->album_ensemble_id}
{if $rsRelease->album_soloist_id}&raquo; {format_artist_name lname=$rsRelease->soloist_artist_last_name fname=$rsRelease->soloist_artist_first_name asian=0}{if $rsRelease->soloist_part}, {$rsRelease->soloist_part}{/if} {/if}
{if $rsRelease->album_conductor_id}&raquo; {format_artist_name lname=$rsRelease->conductor_artist_last_name fname=$rsRelease->conductor_artist_first_name asian=0} {/if}
{if $rsRelease->album_ensemble_id}&raquo; {$rsRelease->ensemble_artist_last_name}{/if}
<br>
{/if}
<span style="font-size: 85%">
{if $rsRelease->release_catalog_num}~ {$rsRelease->release_catalog_num} {/if}
{if $rsRelease->release_label}~ {$rsRelease->release_label} {elseif $rsRelease->album_label}~ {$rsDiscog->album_label} {/if}
{if $rsRelease->format_alias}~ {$rsRelease->format_alias} {/if}
{if $rsRelease->release_country_name}~ {$rsRelease->release_country_name} {/if}
{if $rsRelease->release_release_date}~ {$rsRelease->release_release_date|date_format:"%Y.%m.%d"} {elseif $rsRelease->album_release_date}~ {$rsRelease->album_release_date|date_format:"%Y.%m.%d"} {/if}
{if $rsRelease->release_alt_title}~ <em>{$rsRelease->release_alt_title}</em> {/if}
</span>

{if $amazon_url || $rsLink}
<p>
<strong>Buy</strong><br>
{if $amazon_url}<img src="{$config.to_vigilante}/images/icons/shopping-cart-grey.gif" alt="[BUY]" title="[BUY]" /> <a href="{$amazon_url}">Amazon</a><br>{/if}
{foreach item=rsLink from=$rsLinks}
{if $rsLink.merchant_id != 2}
<img src="{$config.to_vigilante}/images/icons/shopping-cart-grey.gif" alt="[BUY]" title="[BUY]" /> <a href="{$rsLink.ecommerce_url}">{$rsLink.merchant_name}</a><br>
{/if}
{/foreach}
</p>
{/if}

{foreach key=disc_num item=disc from=$track_out}
<table class="tracks">
<tr>
{if $num_discs > 1}<th>DISC #</th>{/if}
<th>TRACK #</th>
<th>SONG TITLE</th>
<th>ROMANIZED TITLE</th>
<th>ALT TITLE</th>
<th>LYRICS</th>
<th>ITUNES</th>
</tr>
{foreach key=track_num item=track from=$disc}
<tr>
{if $num_discs > 1}<td>{$disc_num|string_format:"%02s"}</td>{/if}
<td>{$track_num|string_format:"%02s"}</td>
<td>{$track.track_song_title}</td>
<td>{if $track.track_l10n_furigana}{$track.track_l10n_furigana}{/if}</td>
<td>{$track.track_alt_title}</td>
<td align="center">{if $track.lyric_map_lyric_id}<a href="/index.php/artists/lyrics/lyric/{$track.lyric_map_lyric_id}/"><img src="{$config.to_vigilante}/images/icons/file.gif" alt="[LYRICS]" title="[LYRICS]" /></a>{/if}</td>
<td align="center">{if $track.itunes_url}<a href="{$track.itunes_url}"><img src="{$config.to_vigilante}/images/icons/download-music-grey.gif" alt="[ITUNES]" title="[ITUNES]" /></a>{/if}</td>
</tr>
{/foreach}
</table><br>
{/foreach}

<p><span style="font-size: smaller;"><em>Track listings supplemented by <a href="http://musicbrainz.org/">Musicbrainz</a> and <a href="http://www.amazon.com/webservices/">Amazon Web Services</a>.</em></span></p>

{if $release_image}
<script type="text/javascript">
var file_system = '{$rsArtist->artist_file_system}';
var album_image = '{$release_image}';

{literal}
$(document).ready(function ()
{
	get_album_image(file_system, album_image);
});


{/literal}
</script>
{/if}