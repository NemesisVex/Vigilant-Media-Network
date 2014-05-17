<h4 class="admin_head">Musicbrainz information</h4>

{if $artist_list}
<form action="/index.php/musicwhore/{if $artist_id}artist/update/{$artist_id}{else}musicbrainz/setup{/if}/" method="post">
<p>
The following artists were found in the Musicbrainz database.
</p>

{foreach item=artist from=$artist_list->artist}
<input type="radio" name="artist_mb_gid" value="{$artist.id}"{if $rsArtist->artist_mb_gid==$artist.id} checked{/if}> <a href="http://musicbrainz.org/artist/{$artist.id}.html">{$artist->name}</a><br>
{/foreach}

<p>
<input type="submit" value="Update">
</p>

</form>
{else}
<p>Musicbrainz could not find <strong>{$artist_name}</strong>.</p>
{/if}
