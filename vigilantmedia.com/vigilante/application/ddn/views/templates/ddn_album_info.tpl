{assign var=track_list value='track-list'}

<h2>{$rsAlbum->album_title}</h2>

{if $album_image}
<p><img src="{$album_image[0]}" alt="[{$rsAlbum->album_title}]" title="[{$rsAlbum->album_title}]"/></p>
{/if}

{if $lastfm_album}
<h3>Last.fm information</h3>

<p>
No. of listeners: <strong>{$lastfm_album->listeners}</strong><br/>
No. of plays: <strong>{$lastfm_album->playcount}</strong><br/>
Last.fm URL: <tt><a href="{$lastfm_album->url}">{$lastfm_album->url}</a></tt><br/>
</p>

{if $lastfm_album->wiki}
<div id="lastfm_wiki_summary" style="display: block;">
{parse_line_breaks txt=$lastfm_album->wiki->summary[0]|string_format:"%s"}

<p><a href="javascript:" id="more_lastfm_wiki">Expand</a> ...</p>
</div>

<div id="lastfm_wiki_full" style="display: none;">
{parse_line_breaks txt=$lastfm_album->wiki->content[0]|string_format:"%s"}

<p><a href="javascript:" id="less_lastfm_wiki">Collapse</a> ...</p>
</div>
{/if}

{/if}

{if $mb_release_list}
<h3>Musicbrainz releases</h3>

<ul>
{foreach item=release from=$mb_release_list->release}
<li> <a href="/index.php/album/musicbrainz/{$album_artist_id}/{$release.id}/">{$release->title}</a> (No. of tracks: {$release->$track_list.offset+1})</li>
{/foreach}
</ul>

{/if}

{if $rsDiscogs}
<h3>Discogs.com releases</h3>

<ul>
{foreach item=rsDiscog from=$rsDiscogs}
<li> <a href="/index.php/album/discogs/{$album_artist_id}/{$rsDiscog->xpath_results[0].id}/">{$rsDiscog->xpath_results[0]->title}</a>: {$rsDiscog->xpath_results[0]->label}, {$rsDiscog->xpath_results[0]->format}</li>
{/foreach}
</ul>
{/if}

{literal}
<script type="text/javascript">

$(document).ready(function () {
	$('#more_lastfm_wiki').click(function () {
		$('#lastfm_wiki_summary').css('display', 'none');
		$('#lastfm_wiki_full').css('display', 'block')
	})
	$('#less_lastfm_wiki').click(function () {
		$('#lastfm_wiki_summary').css('display', 'block');
		$('#lastfm_wiki_full').css('display', 'none')
	})
});

</script>
{/literal}
