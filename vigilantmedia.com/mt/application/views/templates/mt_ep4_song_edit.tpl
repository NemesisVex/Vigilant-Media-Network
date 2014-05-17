<h4 class="admin_head">Song information</h4>

<form action="/index.php/ep4/song/{if $song_id}update/{$song_id}{else}create{/if}/" method="post">
	
{if $song_id}
	<p>
		<a href="/index.php/ep4/song/save_lyrics/{$song_id}/"><img src="{$config.to_vigilante}/images/icons/download-page-blue.gif" alt="[SAVE]" /></a>
		<a href="/index.php/ep4/song/save_lyrics/{$song_id}/">Save lyrics as text</a>
	</p>
{/if}

	<p>
		<label for="">Song title:</label>
		<input type="text" name="song_title" value="{$rsSong->song_title|escape}" size="50">
	</p>

	<p>
		<label for="">Influences:</label>
		<input type="text" name="song_influences" value="{$rsSong->song_influences}" size="50">
	</p>
	
	<p>
		<label for="">Style:</label>
		<input type="text" name="song_style" value="{$rsSong->song_style}" size="50">
	</p>
	
	<p>
		<label for="">Date revised:</label>
		<input type="text" name="song_revised_date" value="{$rsSong->song_revised_date}" size="50" />
	</p>
	
	<p>
		<label for="">Date recorded:</label>
		<input type="text" name="song_recorded_date" value="{$rsSong->song_recorded_date}" size="50" />
	</p>
	
	<p>
		<label for="">Lyrics:</label>
		<textarea name="song_lyrics" rows="10" cols="50">{$rsSong->song_lyrics|escape}</textarea>
	</p>
	
	<p>
		<label for="">Abstract:</label>
		<textarea name="song_abstract" rows="10" cols="50">{$rsSong->song_abstract|escape}</textarea>
	</p>

	<p>
		<input type="submit" value="Save" />
	</p>
</form>
