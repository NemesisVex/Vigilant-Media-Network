<h4 class="admin_head">Track information</h4>

{if $rsTracks}
<form action="/index.php/musicwhore/tracks/edit/{$release_id}/" method="post" name="ep4_tracks">
<p><strong>Would you like to add tracks to <em>{$rsRelease->album_title}</em>?</strong><br>

<input type="radio" name="is_add_more" value="0" checked> No, I want to edit only the existing tracks.<br>
<input type="radio" name="is_add_more" value="1"> Yes, I want to add <input type="text" name="more_tracks" size="3"> tracks.</p>

<p>
<input type="submit" value="Continue">
</p>
</form>
{else}
<form action="/index.php/musicwhore/tracks/add/{$release_id}/" method="post" name="ep4_tracks">

<p>There are no tracks yet added to <strong><em>{$rsRelease->album_title}</em></strong>.</p>

<p><strong>How many tracks does this album have?</strong> <input type="text" name="number_of_tracks" size="5"></p>

<p>
<input type="submit" value="View tracks">
</p>
{/if}

