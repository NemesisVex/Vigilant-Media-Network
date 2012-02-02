<h4 class="admin_head">Content administration</h4>

{if $rsRelease}
<form action="/index.php/musicwhore/content/{if $content_id}update/{$content_id}{else}create/{$entry_id}{/if}/{$artist_id}/{$release_id}/" method="post" name="ep4_tracks">

{if $content_id}<input type="hidden" name="content_entry_id" value="{$entry_id}">{/if}

<input type="hidden" name="content_album_id" value="{$rsRelease->release_album_id}">

{if $rsEntry}
<input type="hidden" name="content_entry_title" value="{$rsEntry->entry_title}">
<input type="hidden" name="content_publish_date" value="{$rsEntry->entry_created_on}">
{/if}

<p>You are about to map the entry <strong>&quot;{$rsEntry->entry_title}&quot;</strong> to the release <em>{$rsRelease->album_title}</em></p>

{*if $rsTracks}
<p>Choose a track, if applicable:
<select name="content_track_id">
<option value="0">&nbsp;
{foreach key=o item=rsTrack from=$rsTracks}
<option value="{$rsTrack->track_id}"{if $rsTrack->track_id==$rsContent->content_track_id} selected{/if}> {if $rsTrack->track_track_num<10}0{/if}{$rsTrack->track_track_num}. {$rsTrack->song_title}
{/foreach}
</select>
</p>
{/if*}

<p>
<input type="submit" value="Update">
</p>

</form>
{/if}
