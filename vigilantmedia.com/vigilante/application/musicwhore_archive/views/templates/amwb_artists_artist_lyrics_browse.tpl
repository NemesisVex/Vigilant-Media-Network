{include file=amwb_artists_artist_navigation.tpl}

{if $rsTracks}
{foreach item=rsTrack from=$rsTracks}
{assign var=formatMask value=$rsTrack->album_format_mask}
<p><em><strong><a href="/index.php/artists/lyrics/lyric/{$rsTrack->lyric_id}/{$artist_id}/">{$rsTrack->track_song_title}</a></strong>{if $rsTrack->track_alt_title} ({$rsTrack->track_alt_title}){/if}</em><br>
<span style="font-size: 85%;">
~ From the {$config.album_format_mask.$formatMask} <em><a href="/index.php/artists/album/tracks/{$rsTrack->release_id}/{$artist_id}/">{$rsTrack->album_title}</a></em>
~ {$rsTrack->detail_catalog_num}
</span></p>
{/foreach}
{else}
<p>No lyrics are associated with this artist.</p>
{/if}
