<p>The Social Network Discography brings together information from such sources as <a href="http://musicbrainz.org/">Musicbrainz</a>, <a href="http://www.discogs.com/">Discogs.com</a>, <a href="http://www.last.fm/">Last.fm</a> and <a href="http://www.ilike.com/">iLike</a>.</p>

<h3>Formats</h3>

<ul>
{foreach item=rsFormat from=$rsFormats}
{assign var=album_format_mask value=$rsFormat->album_format_mask}
<li> <a href="/index.php/album/browse/{$album_artist_id}/{$album_format_mask}/">{$config.album_format_mask.$album_format_mask|capitalize}s</a></li>
{/foreach}
</ul>

<h3>Projects</h3>

<ul>
{foreach item=rsProject from=$rsProjects}
<li> <a href="/index.php/album/browse/{$rsProject->artist_id}/">{format_artist_name_object obj=$rsProject}</a></li>
{/foreach}
</ul>

<p><strong>NOTE:</strong> Due to the specifications of their APIs, iLike audio samples and Musicbrainz cover images may not match the actual content of the albums.</p>