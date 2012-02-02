<h1>Tutorials</h1>

<h2>Introduction</h2>

<p>To illustrate Vigilante's capabilities, these tutorials will
use an example database called <code>mymusic</code>
containing data about musical artists, their albums and songs on those albums.
The database contains these tables and fields:</p>

<ol>
<li>Artists</li>
<ul>
<li>ArtistID: primary index for the table</li>
<li>Name: name of the artist or band</li>
</ul>

<li>Albums</li>
<ul>
<li>AlbumID: primary index for the table</li>
<li>ArtistID: cross index with the Artist table</li>
<li>AlbumTitle: title of an album</li>
<li>ReleaseDate: release date of the album</li>
</ul>

<li>Tracks</li>
<ul>
<li>TrackID: primary index for the table</li>
<li>AlbumID: cross index with the Album table</li>
<li>DiscNum: disc number for a multi-disc set; 0 for a single-disc album</li>
<li>TrackNum: track number</li>
<li>SongTitle: title of the song</li>
</ul>

</ol>
