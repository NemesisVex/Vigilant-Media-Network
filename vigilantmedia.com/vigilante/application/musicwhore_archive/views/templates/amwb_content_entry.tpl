{if $rsEntry->entry_status==2}
{if $rsEntry->entry_text}
<div class="indent">

{parse_line_breaks txt=$rsEntry->entry_text}
{if $rsEntry->entry_text_more}{parse_line_breaks txt=$rsEntry->entry_text_more}{/if}
</div>

<div class="attribution">
<p>
<em>&#8212; posted by {$rsEntry->author_name} on <strong>{$rsEntry->entry_created_on|date_format:"%Y-%m-%d %H:%M:%S"}</strong>{if $rsEntry->category_id} | File under: <a href="/category/{$rsEntry->category_id}/">{$rsEntry->category_label}</a>{/if}</em>
</p>

<div class="indent">
{if $rsTags}
<p>Tags:
{foreach item=rsTags from=$rsTags name=tags}<a href="http://technorati.com/tag/{$rsTags->tag_name|escape:"url"}" rel="tag">{$rsTags->tag_name}</a>{if $smarty.foreach.tags.last==false}, {/if}{/foreach}
</p>
{/if}

<p>
<a href="http://digg.com/submit?phase=2&amp;url={"http://archive.musicwhore.org/index.php/content/entry/"|cat:$rsEntry->entry_id|cat:"/"|escape:"url"}&amp;title={$rsEntry->entry_title|escape:"url"}&amp;topic=music">Please to digg</a>?
<a href="http://del.icio.us/post" onclick="window.open('http://del.icio.us/post?v=4&amp;noui&amp;jump=close&amp;url='+encodeURIComponent(location.href)+'&amp;title='+encodeURIComponent(document.title), 'delicious','toolbar=no,width=700,height=400'); return false;">Is del.icio.us, yes</a>?
</p>
</div>
</div>

{if $rsAlbum}
<div class="indent">
<h3>Album information</h3>

{if $image_uri}
<p>
<img src="{$image_uri}" alt="[{format_artist_name_object obj=$rsArtist}: {$rsAlbum->album_title}]" title="[{format_artist_name_object obj=$rsArtist}: {$rsAlbum->album_title}]">
</p>
{/if}

<p>
<strong>{format_artist_name_object obj=$rsArtist}</strong><br>
<strong><em>{$rsAlbum->album_title}</em></strong><br>
({$rsAlbum->album_label})<br>
</p>

{if $amazon_url || $rsLinks}
<p>
<strong>Buy</strong><br>
{if $amazon_url}<img src="{$config.to_vigilante}/images/icons/shopping-cart-grey.gif" alt="[BUY]" title="[BUY]" /> <a href="{$amazon_url}">Amazon</a><br>{/if}
{foreach item=rsLink from=$rsLinks}
{if $rsLink.merchant_id != 2}
<img src="{$config.to_vigilante}/images/icons/shopping-cart-grey.gif" alt="[BUY]" title="[BUY]" /> <a href="{$rsLink.ecommerce_url}">{$rsLink.merchant_name}</a><br>
{/if}
{/foreach}
</p>
{/if}

{if $track_out}
<p>[<a href="javascript:" id="track_info_button">Show tracks</a>]</p>

<div id="track_info" style="display: none;">
{foreach key=disc_num item=disc from=$track_out name=discs}
<p>
{foreach key=track_number item=track from=$disc name=tracks}
{if $smarty.foreach.discs.total > 1}{$disc.Number|string_format:"%02s"}: {/if}
{$smarty.foreach.tracks.iteration|string_format:"%02s"} ~
{$track}<br>
{/foreach}
</p>
{/foreach}

<p><span style="font-size: smaller;"><em>Track listings provided by <a href="http://musicbrainz.org/">Musicbrainz</a> and <a href="http://www.amazon.com/webservices/">Amazon Web Services</a>.</em></span></p>
</div>

<script type="text/javascript">
{literal}
$(document).ready(function ()
{
	$('#track_info_button').click(function ()
	{
		if ($('#track_info').css('display')=='none')
		{
			$('#track_info').css('display', 'block');
			$('#track_info_button').html('Hide tracks');
		}
		else if ($('#track_info').css('display')=='block')
		{
			$('#track_info').css('display', 'none');
			$('#track_info_button').html('Show tracks');
		}
	});
});
{/literal}
</script>
{/if}

</div>

{/if}

{/if}
{else}
<p>This entry is not yet published.</p>
{/if}

