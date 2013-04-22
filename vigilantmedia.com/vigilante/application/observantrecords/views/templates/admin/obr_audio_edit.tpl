{include file=obr_global_header.tpl}

		<form action="/index.php/admin/audio/{if $audio_id}update/{$audio_id}{else}create/{$audio_artist_id}{/if}/" method="post">
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
					<option value="{$rsSong->song_id}"{if $rsFile->audio_song_id==$rsSong->song_id} selected{/if}>{$rsSong->song_title}</option>
				{/foreach}
				</select>
			</p>
			
			<p>
				<label for="audio_display_label">Display Label:</label>
				<input type="text" name="audio_display_label" id="audio_display_label" value="{$rsFile->audio_display_label}" size="60" />
			</p>
			
			<p>
				<label for="audio_mp3_file_name">File Name:</label>
				<input type="text" name="audio_mp3_file_name" id="audio_mp3_file_name" value="{$rsFile->audio_mp3_file_name}" size="60" />
			</p>
			
			<p>
				<label for="audio_mp3_file_path">File Path:</label>
				<input type="text" name="audio_mp3_file_path" id="audio_mp3_file_name" value="{if $rsFile->audio_mp3_file_path}{$rsFile->audio_mp3_file_path}{else}/music/audio/_mp3/_ex_machina{/if}" size="60" />
			</p>
			
			<p>
				<label for="audio_isrc_num">ISRC No.:</label>
				<input type="text" name="audio_isrc_num" id="audio_isrc_num" value="{$rsFile->audio_isrc_num}" size="60" />
			</p>
			
			<p>
				<input type="submit" value="Save" />
			</p>
			
		{if $rsFile}
			<p><a href="http://eponymous4.com{$rsFile->audio_mp3_file_path}/{$rsFile->audio_mp3_file_name}"></a> Listen</p>

			<script type="text/javascript" src="http://webplayer.yahooapis.com/player-beta.js"></script>
		{/if}
		</form>

		{literal}
		<script type="text/javascript">
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
