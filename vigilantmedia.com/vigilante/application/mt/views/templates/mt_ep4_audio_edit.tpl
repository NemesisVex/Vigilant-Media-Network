<div id="tabs">
	<ul>
		<li><a href="#audio-tab">Audio Info</a></li>
		<li><a href="#id3v1">ID3v1</a></li>
		<li><a href="#id3v24">ID3v2.4</a></li>
	</ul>
	
	<div id="audio-tab">
		<form action="/index.php/ep4/audio/{if $audio_id}update/{$audio_id}{else}create/{$audio_artist_id}{/if}/" method="post">
			<p>
				<label for="audio_file_type">File Type:</label>
				<select name="audio_file_type" id="audio_file_type">
					<option value="audio/mpeg">mp3</option>
					<option value="application/ogg">ogg</option>
				</select>
			</p>
			
			<p>
				<label for="audio_artist_id">Artist:</label>
				<select name="audio_artist_id" id="audio_artist_id">
					<option value="0"> &nbsp;
				{foreach item=rsArtist from=$rsArtists}
					<option value="{$rsArtist->artist_id}"{if $rsArtist->artist_id==$audio_artist_id} selected{/if}>{format_artist_name_object obj=$rsArtist}</option>
				{/foreach}
				</select>
			</p>
			
			<p>
				<label for="audio_song_id">Song:</label>
				<select name="audio_song_id" id="audio_song_id">
					<option value="0"> &nbsp;
				{foreach item=rsSong from=$rsSongs}
					<option value="{$rsSong->song_id}"{if $rsAudio->audio_song_id==$rsSong->song_id} selected{/if}>{$rsSong->song_title}</option>
				{/foreach}
				</select>
			</p>
			
			<p>
				<label for="audio_display_label">Display Label:</label>
				<input type="text" name="audio_display_label" id="audio_display_label" value="{$rsAudio->audio_display_label}" size="60" />
			</p>
			
			<p>
				<label for="audio_mp3_file_name">File Name:</label>
				<input type="text" name="audio_mp3_file_name" id="audio_mp3_file_name" value="{$rsAudio->audio_mp3_file_name}" size="60" />
			</p>
			
			<p>
				<label for="audio_mp3_file_path">File Path:</label>
				<input type="text" name="audio_mp3_file_path" id="audio_mp3_file_name" value="{if $rsAudio->audio_mp3_file_path}{$rsAudio->audio_mp3_file_path}{else}/music/audio/_mp3/_ex_machina{/if}" size="60" />
			</p>
			
			<p>
				<input type="submit" value="Save" />
			</p>
			
		{if $rsAudio}
			<p><a href="http://eponymous4.com{$rsAudio->audio_mp3_file_path}/{$rsAudio->audio_mp3_file_name}"></a> Listen</p>

			<script type="text/javascript" src="http://webplayer.yahooapis.com/player-beta.js"></script>
		{/if}
		</form>
	</div>
	
	<div id="id3v1">
	{if $audio_tags}
		<form action="/index.php/ep4/audio/retag/{$audio_id}/" method="post">
			<input type="hidden" name="audio_artist_id" value="{$audio_artist_id}" />
			<input type="hidden" name="version" value="id3v1" />
			
			<p>
				<label for="tag[artist]">Artist:</label>
				<input type="text" name="tag[artist]" value="{$audio_tags.tags.id3v1.artist.0}" size="50" />
			</p>

			<p>
				<label for="tag[title]">Title:</label>
				<input type="text" name="tag[title]" value="{$audio_tags.tags.id3v1.title.0}" size="50" />
			</p>

			<p>
				<label for="tag[album]">Album:</label>
				<input type="text" name="tag[album]" value="{$audio_tags.tags.id3v1.album.0}" size="50" />
			</p>

			<p>
				<label for="tag[year]">Year:</label>
				<input type="text" name="tag[year]" value="{$audio_tags.tags.id3v1.year.0}" size="10" />
			</p>

			<p>
				<label for="tag[track]">Track:</label>
				<input type="text" name="tag[track]" value="{$audio_tags.tags.id3v1.track.0}" size="4" />
			</p>

			<p>
				<input type="submit" value="Save" />
			</p>
		</form>
	{else}
		<p>An audio file must be uploaded before you can edit ID3 tags.</p>
	{/if}
	</div>
			
	<div id="id3v24">
	{if $audio_tags}
		<form action="/index.php/ep4/audio/retag/{$audio_id}/" method="post">
			<input type="hidden" name="audio_artist_id" value="{$audio_artist_id}" />
			<input type="hidden" name="version" value="id3v2" />
			
			<p>
				<label for="tag[artist]">Artist:</label>
				<input type="text" name="tag[artist]" value="{$audio_tags.tags.id3v2.artist.0}" size="50" />
			</p>

			<p>
				<label for="tag[title]">Title:</label>
				<input type="text" name="tag[title]" value="{$audio_tags.tags.id3v2.title.0}" size="50" />
			</p>

			<p>
				<label for="tag[album]">Album:</label>
				<input type="text" name="tag[album]" value="{$audio_tags.tags.id3v2.album.0}" size="50" />
			</p>

			<p>
				<label for="tag[year]">Year:</label>
				<input type="text" name="tag[year]" value="{$audio_tags.tags.id3v2.year.0}" size="10" />
			</p>

			<p>
				<label for="tag[track_number]">Track:</label>
				<input type="text" name="tag[track_number]" value="{$audio_tags.tags.id3v2.track_number.0}" size="4" />
			</p>

			<p>
				<label for="tag[band]">Band:</label>
				<input type="text" name="tag[band]" value="{$audio_tags.tags.id3v2.band.0}" size="50" />
			</p>

			<p>
				<label for="tag[band]">Artist URL:</label>
				<input type="text" name="tag[url_artist]" value="{$audio_tags.tags.id3v2.url_artist.0}" size="50" />
			</p>

			<p>
				<label for="tag[copyright_message]">Copyright:</label>
				<textarea class="slim_textarea" name="tag[copyright_message]">{$audio_tags.tags.id3v2.copyright_message.0}</textarea>
			</p>

			<p>
				<input type="submit" value="Save" />
			</p>
		</form>
	{else}
		<p>An audio file must be uploaded before you can edit ID3 tags.</p>
	{/if}
	</div>
</div>

{literal}
<script type="text/javascript">
	$('#tabs').tabs({
		cookie: {expires: 30}
	});
	
	$('#id3-tabs').tabs({
		cookie: {expires: 30}
	});
		
	var build_file_name = function ()
	{
		if ($('#audio_artist_id').val() > 0 && $('#audio_song_id').val() > 0) {
			var artist_name = $('#audio_artist_id option:selected').text();
			var song_title = $('#audio_song_id option:selected').text();
			var file_ext = $('#audio_file_type option:selected').text();
			var file_name = artist_name + ' - ' + song_title + '.' + file_ext;
			file_name = file_name.replace(/ /g, '_');

			$('#audio_mp3_file_name').val(file_name);
			$('#audio_display_label').val(song_title);
		}
		else {
			$('#audio_mp3_file_name').val('');
			$('#audio_display_label').val('');
		}
	}
	
	$('#audio_song_id').change(function ()
	{
		build_file_name();
	});
		
	$('#audio_artist_id').change(function ()
	{
		build_file_name();
	});
</script>
{/literal}

