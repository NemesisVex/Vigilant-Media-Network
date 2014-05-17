<p>
<strong>Content administration</strong><br>
<a href="/index.php/musicwhore/content/categories/">Map entries to artists</a>
</p>

<p>
<strong>Artist administration</strong><br>
<a href="/index.php/musicwhore/artist/options/">Add a new artist</a><br>
Edit an artist:<br>
</p>

<p>
<span style="font-size: 80%">
Filter:
{foreach item=rsNav from=$rsNav}
<a href="/index.php/mt/musicwhore/{$rsNav->nav|lower}/">{$rsNav->nav}</a>
{/foreach}
</span>
</p>

<ul>
{foreach item=rsArtist from=$rsArtists}
<li> <a href="/index.php/musicwhore/artist/info/{$rsArtist->artist_id}/">{format_artist_name_object obj=$rsArtist}</a></li>
{/foreach}
</ul>

