<p>Choose an option to add an album.</p>

<ul>
{if $rsArtist->artist_mb_gid}<li> <a href="/index.php/musicwhore/musicbrainz/browse/{$album_artist_id}/">Browse Musicbrainz Web Service</a></li>{/if}
<li> <a href="/index.php/musicwhore/amazon/browse/{$album_artist_id}/">Browse Amazon Web Service</a></li>
<li> <a href="/index.php/musicwhore/album/add/{$album_artist_id}/">Enter manually</a></li>
</ul>
