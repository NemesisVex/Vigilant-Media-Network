<h2>{$config.album_format_mask.$format_mask|capitalize}s</h2>

<ul class="album_list">
{foreach item=rsAlbum from=$rsAlbums}
	<li> <div>{if $rsAlbum->album_image}<a href="/index.php/album/info/{$album_artist_id}/{$rsAlbum->album_id}/"><img src="{$config.to_archive}/images/discog/{$rsArtist->artist_file_system|truncate:1:""}/{$rsArtist->artist_file_system}/{$rsAlbum->album_image}"  border="0" alt="[{$rsAlbum->album_title}]" title="[{$rsAlbum->album_title}]"/></a><br/>{/if}<a href="/index.php/album/info/{$album_artist_id}/{$rsAlbum->album_id}/">{$rsAlbum->album_title}</a></div></li>
{/foreach}
</ul>

