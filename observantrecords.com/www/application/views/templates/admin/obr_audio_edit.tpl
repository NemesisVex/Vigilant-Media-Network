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
				{if !empty($rsFile->isrc[0]->audio_isrc_code)}
				{$rsFile->isrc[0]->audio_isrc_code}
				{else}
				<input type="text" name="_display_audio_isrc_num" id="_display_audio_isrc_num" value="" size="60" disabled="disabled" />
				<input type="hidden" name="audio_isrc_num" id="audio_isrc_num" value="" />
				<input type="hidden" name="audio_isrc_code" id="audio_isrc_code" value="" />
				<a id="generate_custom_isrc" class="button">Generate</a>
				<a id="clear_custom_isrc" class="button">Clear</a>
				{/if}
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
			var Audio_Edit = {
				build_file_name: function ()
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
				},
				generate_isrc_code: function () {
					$.ajax({
						url: '/index.php/admin/audio/generate_isrc/',
						cache: false
					}).done(function (response) {
						var result = $.parseJSON(response);
						$('#audio_isrc_code').val(result.isrc_code);
						$('#audio_isrc_num').val(result.isrc_code);
						$('#_display_audio_isrc_num').val(result.isrc_code);
					});
				}
			};
			
			$('#audio_song_id').change(function ()
			{
				Audio_Edit.build_file_name();
			});

			$('#audio_artist_id').change(function ()
			{
				Audio_Edit.build_file_name();
			});
				
			$('#generate_custom_isrc').click(function () {
				Audio_Edit.generate_isrc_code();
			});
				
			$('#clear_custom_isrc').click(function () {
				$('#_display_audio_isrc_num').val('');
				$('#audio_isrc_num').val('');
				$('#audio_isrc_code').val('');
			});
				
			$('#_display_audio_isrc_num').blur(function () {
				$('#_display_audio_isrc_num').attr('disabled', 'disabled');
				$('#audio_isrc_num').val($('#_display_audio_isrc_num').val());
			});
		</script>
		{/literal}
