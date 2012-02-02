<h4 class="admin_head">Track information</h4>

{if $rsTracks}
<form action="/index.php/ep4/tracks/export/{$release_id}/" method="post" name="ep4_tracks">
<p>Select a file format in which to save <strong><em>{$rsRelease->album_title}</em></strong>.<br>

<input type="radio" name="file_format" value="xspf" checked> XSPF<br>
<input type="radio" name="file_format" value="m3u"> M3U<br>
<input type="radio" name="file_format" value="text"> Text<br>
</p>

<input type="submit" value="Continue">
</form>

{else}
<p>You need to <a href="/index.php/ep4/tracks/check/{$release_id}/">add tracks</a> to <strong><em>{$rsRelease->album_title}</em></strong> before you can export the track list.</p>

{/if}

