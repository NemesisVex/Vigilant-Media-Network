<? xml version="1.0" encoding="UTF-8" ?>
<playlist version="0" xmlns = "http://xspf.org/ns/0/">
	<creator>Eponymous 4</creator>
{if !$project}	<title>Eponymous 4 - Complete playlist</title>{/if}
	<trackList>
{foreach item=rsTrack from=$rsTracks}
{assign var=version_exists value=$config.ep4_mp3_file_root|cat:"/_"|cat:$version|cat:"/"|cat:$rsTrack->audio_mp3_file_name}
{if file_exists($version_exists)}
		<track>
			<location>http://{$url_base}/audio/_mp3/_vocals/{$rsTrack->audio_mp3_file_name}</location>
			<title>Eponymous 4 - {$rsTrack->album_title} - {$rsTrack->song_title} </title>
			<annotation>Eponymous 4 - {$rsTrack->album_title} - {$rsTrack->song_title} </annotation>
{if $rsTrack->album_image}			<image>http://{$url_base}/images/_covers/_color_front_200_{$rsTrack->album_image}</image>{/if}
			<trackNum>{$rsTrack->track_track_num}</trackNum>
		</track>
{/if}
{/foreach}
	</trackList>
</playlist>
