{if $rsArtist}
<h4>Artist information</h4>

<p>
<a href="/index.php/musicwhore/artist/edit/{$artist_id}/">Edit artist info</a><br>
<a href="/index.php/musicwhore/artist/delete/{$artist_id}/">Delete artist info</a><br>
</p>

<p>
<a href="/index.php/musicwhore/related/browse/{$artist_id}/">Link artists</a><br>
<a href="/index.php/musicwhore/personell/browse/{$artist_id}/">Add/edit personell</a><br>
</p>

<h4>Musicbrainz</h4>

<p>
{if $rsArtist->artist_mb_gid}
<a href="/index.php/musicwhore/musicbrainz/albums/{$artist_id}/">Browse Musicbrainz discography</a><br>
<a href="/index.php/musicwhore/musicbrainz/browse/{$artist_id}/">Browse Musicbrainz associations</a><br>
{else}
<a href="/index.php/musicwhore/musicbrainz/artist/{$artist_id}/">Find Musicbrainz artist ID</a><br>
{/if}
</p>

<h4>Amazon</h4>

<p>
<a href="/index.php/musicwhore/amazon/browse/{$artist_id}/">Browse Amazon catalog</a><br>
</p>

<h4>Discogs</h4>

<p>
<a href="/index.php/musicwhore/discogs/albums/{$artist_id}/">Browse Discogs discography</a><br>
<a href="/index.php/musicwhore/discogs/browse/{$artist_id}/">Browse Discogs associations</a><br>
</p>

<h4>Discography</h4>

<p>
<a href="/index.php/musicwhore/album/options/{$artist_id}/">Add a new album</a><br>
<a href="/index.php/musicwhore/album/browse/{$artist_id}/edit/">Edit album info</a><br>
<a href="/index.php/musicwhore/album/browse/{$artist_id}/delete/">Delete album info</a><br>
</p>

<p>
<a href="/index.php/musicwhore/release/albums/{$artist_id}/">Add an album release</a><br>
<a href="/index.php/musicwhore/release/browse/{$artist_id}/edit/">Edit an album release</a><br>
<a href="/index.php/musicwhore/release/browse/{$artist_id}/delete/">Delete an album release</a><br>
</p>

<p>
<a href="/index.php/musicwhore/tracks/browse/{$artist_id}/">Administer tracks</a><br>
</p>

<h4>Content</h4>

<p>
<a href="/index.php/musicwhore/content/categories/{$artist_id}/">Map content to artist</a><br>
</p>

<h4>Lyrics</h4>

<p>
<a href="/index.php/musicwhore/lyrics/add/{$artist_id}/">Add lyrics file</a><br>
<a href="/index.php/musicwhore/lyrics/browse/{$artist_id}/">Edit lyrics file</a><br>
<a href="/index.php/musicwhore/lyrics/browse/{$artist_id}/delete/">Delete lyrics file</a><br>
</p>

<p>
<a href="/index.php/musicwhore/lyrics/releases/{$artist_id}/">Map file to track</a><br>
</p>

{else}
<p>No artist exists for this record.</p>
{/if}