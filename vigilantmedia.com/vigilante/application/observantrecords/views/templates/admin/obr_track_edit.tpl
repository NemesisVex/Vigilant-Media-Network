{include file=obr_global_header.tpl}
<div id="admin-column-1">

	<form action="/index.php/admin/track/{if !empty($track_id)}update/{$track_id}{else}create{/if}/" method="post" name="track-form">
		<p>
			<input type="submit" value="Save" class="button" />
		</p>

		{if !empty($track_id)}<input type="hidden" name="track_id" value="{$track_id}" />{/if}
		<input type="hidden" name="track_release_id" value="{$release_id}" />
		<input type="hidden" name="track_album_id" value="{$rsRelease->release_album_id}" />
		<input type="hidden" name="map_id" value="{$rsTrack->map_id}" />

		<p>
			<label for="track_disc_num">Disc:</label>
			<input type="text" name="track_disc_num" value="{if !empty($rsTrack->track_disc_num)}{$rsTrack->track_disc_num}{else}1{/if}" size="4" />
		</p>

		<p>
			<label for="track_track_num">Track:</label>
			<input type="text" name="track_track_num" value="{$rsTrack->track_track_num}" size="4" />
		</p>

		<p>
			<label for="track_song_id">Song:</label>
			<select name="track_song_id">
				<option value="">&nbsp;</option>
			{foreach item=rsSong from=$rsSongs}
				<option value="{$rsSong->song_id}"{if $rsSong->song_id == $rsTrack->track_song_id} selected{/if}>{$rsSong->song_title}</option>
			{/foreach}
			</select>
		</p>

		<p>
			<label for="track_alias">Alias:</label>
			<input type="text" name="track_alias" value="{$rsTrack->track_alias}" size="50" />
		</p>

		<p>
			<label for="track_isrc_num">ISRC No.:</label>
			<input type="text" name="track_isrc_num" value="{$rsTrack->track_isrc_num}" size="20" />
		</p>

		<p>
			<label for="track_is_visible">Visibility:</label>
			<input type="radio" name="track_is_visible" value="1"{if $rsTrack->track_is_visible==true} checked{/if} /> Yes
			<input type="radio" name="track_is_visible" value="0"{if $rsTrack->track_is_visible==false} checked{/if} /> No
		</p>

		<p>
			<label for="track_audio_is_playable">Playable:</label>
			<input type="radio" name="track_audio_is_linked" value="1"{if $rsTrack->track_audio_is_linked==true} checked{/if} /> Yes
			<input type="radio" name="track_audio_is_linked" value="0"{if $rsTrack->track_audio_is_linked==false} checked{/if} /> No
		</p>

		<p>
			<label for="track_audio_is_downloadable">Downloadable:</label>
			<input type="radio" name="track_audio_is_downloadable" value="1"{if $rsTrack->track_audio_is_downloadable==true} checked{/if} /> Yes
			<input type="radio" name="track_audio_is_downloadable" value="0"{if $rsTrack->track_audio_is_downloadable==false} checked{/if} /> No
		</p>

		<p>
			<label for="track_uplaya_score">uPlaya Score:</label>
			<input type="text" name="track_uplaya_score" value="{$rsTrack->track_uplaya_score}" size="4" />
		</p>

		<p>
			<label for="track_audio_id">Audio:</label>
			<select name="track_audio_id">
				<option value="">&nbsp;</option>
				{foreach item=rsFile from=$rsFiles}
					<option value="{$rsFile->audio_id}" title="{$rsFile->audio_mp3_file_path}/{$rsFile->audio_mp3_file_name}"{if $rsTrack->track_audio_id==$rsFile->audio_id} selected{/if}>{$rsFile->audio_mp3_file_name|truncate:'48'}</option>
				{/foreach}
			</select>
		</p>

		<p>
			<input type="submit" value="Save" class="button" />
		</p>
	</form>
</div>
<div id="admin-column-2">
	<p>
		<img src="/images/_covers/_exm_front_200_{if !empty($rsRelease->release_image)}{$rsRelease->release_image}{else}tbd.jpg{/if}" />
	</p>
	
	<ul>
		<li><a href="/index.php/admin/release/view/{$rsRelease->release_id}/">Back to <em>{$rsRelease->album_title}</em></a></li>
		{if !empty($rsTrack)}<li><a href="/index.php/admin/track/view/{$rsTrack->track_id}/">Back to &quot;{$rsTrack->song_title}&quot;</a></li>{/if}
	</ul>
</div>