<h4 class="admin_head">Track information</h4>

{if $rsTracks}
<form action="/index.php/ep4/tracks/edit/{$release_id}/" method="post" name="ep4_tracks">
<p><strong>Would you like to add tracks to <em>{$rsRelease->album_title}</em>?</strong><br>

<input type="radio" name="is_add_more" value="0" checked> No, I want to edit only the existing tracks.<br>
<input type="radio" name="is_add_more" value="1"> Yes, I want to add <input type="text" name="more_tracks" size="3"> tracks.</p>

<p>
<input type="submit" value="Continue">
</p>
</form>

<form action="/index.php/ep4/tracks/export/{$release_id}/" method="post" name="ep4_export">
<h4 class="admin_head">Export playlist</h4>

<p>
<label for="url_base">URL base:</label>
<input type="text" name="url_base" value="www.eponymous4.com" size="50">
</p>

<p>
<label for="version">Directory:</label>
<input type="radio" name="version" value="vocals" checked> Vocals
<input type="radio" name="version" value="ex_machina"> Ex Machina
</p>

<p>
<label for="file_format">File type:</label>
<input type="radio" name="file_format" value="xspf" checked> XSPF
<input type="radio" name="file_format" value="m3u"> M3u
<input type="radio" name="file_format" value="text"> Text
</p>

<p>
<input type="submit" value="Export">
</p>
</form>
{else}
<form action="/index.php/ep4/tracks/add/{$release_id}/" method="post" name="ep4_tracks">

<p>There are no tracks yet added to <strong><em>{$rsRelease->album_title}</em></strong>.</p>

<p><strong>How many tracks does this album have?</strong> <input type="text" name="number_of_tracks" size="5"></p>

<p>
<input type="submit" value="View tracks">
</p>
{/if}

