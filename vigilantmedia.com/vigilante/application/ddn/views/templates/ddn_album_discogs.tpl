<h2>{$results->title}</h2>

<p>Information provided by <a href="http://www.discogs.com/release/{$discogs_discog_id}">Discogs.com</a>.</p>

{if $results->images->image}<p><img src="{$results->images->image.uri150}" width="150" alt="[{$results->title}]" title="[{$results->title}]"/></p>{/if}

<ul style="list-style: none;">
	<li> Label: <strong>{$results->labels->label.name}</strong></li>
	<li> Catalog no.: <strong>{$results->labels->label.catno}</strong></li>
	<li> Format: <strong>{$results->formats->format.name}</strong></li>
	<li> Released: <strong>{$results->released}</strong></li>
</ul>

<h3>Tracks</h3>

<ul style="list-style: none;">
{foreach item=track from=$results->tracklist->track}
	<li> {$track->position}: <strong>{$track->title}</strong>{if $track->duration!=''} ({$track->duration}){/if}</li>
{/foreach}
</ul>

<script type="text/javascript" src="http://www.ilike.com/api/js"></script>
<script type="text/javascript">
_iLikeDevKey = "{$config.ilike_key}";
</script>


<h3>iLike Audio</h3>

<ol style="list-style: none;">
{foreach item=track from=$results->tracklist->track}
	<li> <div id="track_{$track->position}">{$track->title} <em>(Not available)</em></div>
		<script type="text/javascript">
			iLikeDisplaySong({ldelim}elId: "track_{$track->position}", songName: "{$track->title}", artistName: "{$results->artists->artist->name}"{rdelim});
		</script>
	</li>
{/foreach}
</ol>

<h3>Credits</h3>

<ul style="list-style: none;">
{foreach item=extraartist from=$results->extraartists->artist}
	<li> {$extraartist->role}: <strong>{$extraartist->name}</strong></li>
{/foreach}
</ul>

