<h3>{$filter|upper}</h3>

<p>
{foreach item=rsArtist from=$rsArtists}
<a href="/index.php/artists/artist/info/{$rsArtist->artist_id}/">{format_artist_name_object obj=$rsArtist}</a>{if $rsArtist->artist_asian_name_utf8} ({$rsArtist->artist_asian_name_utf8}){/if}<br>
{/foreach}
</p>
