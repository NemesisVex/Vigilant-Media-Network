<h4 class="admin_head">Content administration</h4>

{if $rsRelease}
<form action="/index.php/ep4/content/{if $content_id}update/{$content_id}{else}create/{$entry_id}{/if}/{$release_id}/{$artist_id}/" method="post" name="ep4_tracks">

{if $content_id}<input type="hidden" name="content_entry_id" value="{$entry_id}">{/if}

<p>You are about to map the entry <strong>&quot;{$rsEntry->entry_title}&quot;</strong> to the release <em>{$rsRelease->album_title}</em></p>

{if $rsTracks}
<p>Choose a track, if applicable:
<select name="content_track_id">
<option value="0">&nbsp;
{foreach key=o item=rsTrack from=$rsTracks}
<option value="{$rsTrack->track_id}"{if $rsTrack->track_id==$rsContent->content_track_id} selected{/if}> {if $rsTrack->track_track_num<10}0{/if}{$rsTrack->track_track_num}. {$rsTrack->song_title}
{/foreach}
</select>
</p>
{/if}

<p>
<input type="submit" value="Update">
</p>

</form>
{/if}
