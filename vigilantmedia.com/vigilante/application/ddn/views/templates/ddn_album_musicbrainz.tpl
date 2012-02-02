{assign var=release_event_list value='release-event-list'}
{assign var=track_list value='track-list'}
{assign var=relation_list value='relation-list'}
{assign var=catalog_number value='catalog-number'}
{assign var=target_type value='target-type'}

<h2>{$results->title}</h2>

<p>Information provided by <a href="http://musicbrainz.org/release/{$mb_gid}.html">Musicbrainz</a>.</p>

{if $amazon->Item->ImageSets->ImageSet->LargeImage->URL}
<p><img src="{$amazon->Item->ImageSets->ImageSet->LargeImage->URL}" alt="[{$results->title}]" title="[{$results->title}]"/></p>
{elseif $amazon->Item->ImageSets->ImageSet->MediumImage->URL}
<p><img src="{$amazon->Item->ImageSets->ImageSet->MediumImage->URL}" alt="[{$results->title}]" title="[{$results->title}]"/></p>
{elseif $amazon->Item->ImageSets->ImageSet->SmallImage->URL}
<p><img src="{$amazon->Item->ImageSets->ImageSet->SmallImage->URL}" alt="[{$results->title}]" title="[{$results->title}]"/></p>
{elseif $album_image}
<p><img src="{$album_image[0]}" alt="[{$results->title}]" title="[{$results->title}]"/></p>
{/if}

{if $results->$track_list->track}

<h3>Tracks</h3>

<ol>
{foreach item=track from=$results->$track_list->track}
	<li> <strong>{$track->title}</strong>{if $track->duration!=''} ({math equation="(x % (1000 * 60 * 60)) / (1000 * 60)" x=$track->duration|string_format:"%d" format="%d"}:{math equation="((x % (1000 * 60 * 60)) % (1000 * 60)) / 1000" x=$track->duration|string_format:"%d" format="%02d"}){/if}</li>
{/foreach}
</ol>

<script type="text/javascript" src="http://www.ilike.com/api/js"></script>
<script type="text/javascript">
_iLikeDevKey = "{$config.ilike_key}";
</script>


<h3>iLike Audio</h3>

<ol style="list-style: none;">
{foreach item=track from=$results->$track_list->track}
	<li>
		<div id="track_{$track.id}">{$track->title} <em>(Not available)</em></div>
		<script type="text/javascript">
			iLikeDisplaySong({ldelim}elId: "track_{$track.id}", songName: "{$track->title}", artistName: "{$results->artist->name}"{rdelim});
		</script>
	</li>
{/foreach}
</ol>


{/if}

{if $results->$release_event_list->event}
<h3>Releases</h3>

{foreach item=event from=$results->$release_event_list->event}
<ul style="list-style: none;">
	<li> Label: {if $event->label->name}<strong>{$event->label->name}</strong>{else}<em>Not specified</em>{/if}</li>
	{if $event.$catalog_number}<li> Catalog no.: <strong>{$event.$catalog_number}</strong></li>{/if}
	{if $event.barcode}<li> Barcode: <strong>{$event.barcode}</strong></li>{/if}
	<li> Format: {if $event.format}<strong>{$event.format}</strong>{else}<em>Not specified</em>{/if}</li>
	<li> Released: {if $event.date}<strong>{$event.date}</strong>{else}<em>Not specified</em>{/if}</li>
</ul>
{/foreach}

{if $results->$relation_list->relation}
{foreach item=relation_list from=$results->$relation_list}
{if $relation_list.$target_type=='Artist'}
<h3>Artist relationships</h3>

<ul>
{foreach item=relation from=$relation_list->relation}
<li>{$relation.type}: <strong>{$relation->artist->name}</strong></li>
{/foreach}
</ul>

{elseif $relation_list.$target_type=='Url'}
<h3>Links</h3>

<ul>
{foreach item=relation from=$relation_list->relation}
{if $relation.type=='AmazonAsin'}
<li> <a href="{$relation.target}/musicwhoreorg-20">Amazon</a></li>
{else}
<li> <a href="{$relation.target}">{$relation.type}</a></li>
{/if}
{/foreach}
</ul>

{/if}

{/foreach}

{/if}

{/if}

{if $amazon}
<h3>Buy from Amazon</h3>

<ul>
{foreach item=link from=$amazon->Item->ItemLinks->ItemLink}
<li> <a href="{$link->URL}">{$link->Description}</a></li>
{/foreach}
</ul>

{/if}