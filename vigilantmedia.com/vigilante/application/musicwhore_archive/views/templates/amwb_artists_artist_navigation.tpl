{if $rsArtist->artist_navigation_mask}
<p>
~ <a href="/index.php/artists/artist/info/{$artist_id}/">Main</a>

{if ($rsArtist->artist_navigation_mask & 2)==2}~ <a href="/index.php/artists/artist/profile/{$artist_id}/">Profile</a>{/if}

{if ($rsArtist->artist_navigation_mask & 4)==4}~ <a href="/index.php/artists/album/browse/{$artist_id}/">Discography</a>{/if}

{if ($rsArtist->artist_navigation_mask & 16)==16 || ($rsArtist->artist_navigation_mask & 32)==32}~ <a href="/index.php/artists/content/browse/{$artist_id}/">Entries</a>{/if}

{if ($rsArtist->artist_navigation_mask & 64)==64}~ <a href="/index.php/artists/lyrics/browse/{$artist_id}/">Lyrics</a>{/if}
</p>
{/if}

