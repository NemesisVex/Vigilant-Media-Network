{include file=obr_global_header.tpl}

<form action="/index.php/admin/song/{if $song_id}update/{$song_id}{else}create{/if}/" method="post">


	<p>
		<input type="submit" value="Save" class="button" />
{if $song_id}
		<a href="/index.php/admin/song/save_lyrics/{$song_id}/" class="button"><img src="{$config.to_vigilante}/images/icons/download-page-blue.gif" alt="[SAVE]" /> Save lyrics as text</a>
{/if}
	</p>

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
		<input type="submit" value="Save" class="button" />
{if $song_id}
		<a href="/index.php/admin/song/save_lyrics/{$song_id}/" class="button"><img src="{$config.to_vigilante}/images/icons/download-page-blue.gif" alt="[SAVE]" /> Save lyrics as text</a>
{/if}
	</p>

</form>
