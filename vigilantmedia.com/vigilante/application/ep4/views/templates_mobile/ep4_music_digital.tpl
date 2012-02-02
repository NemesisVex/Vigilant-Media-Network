<h3>{$rsRelease->album_title}</h3>

{if $rsRelease->release_is_visible}
<p>
{assign var=wrp_file value=$config.ep4_cover_root_path|cat:"/_exm_front_200_"|cat:$rsRelease->album_image}
	<img src="/images/_covers/_{if file_exists($wrp_file)}exm{else}color{/if}_front_200_{$rsRelease->album_image}" alt="[{$rsRelease->album_title}]" title="[{$rsRelease->album_title}]" class="album-cover" width="200" height="200">
</p>

{assign var="track_count" value=0}

<table class="track-table">
	<tr>
		<th class="track-column">TRACK</th>
		<th>TITLE</th>
		<th class="play-column"></th>
		{*<th class="download-column"></th>*}
	</tr>
{foreach key=track_id item=rsTrack from=$rsTracks}
	<tr>
		<td class="track-column">{$rsTrack->track_track_num}</td>
		<td>{if $rsTrack->track_is_visible}<a href="/index.php/music/track/{$rsTrack->track_id}/" class="image-link">{$rsTrack->song_title}</a>{else}{$rsTrack->song_title}{/if}</td>
		<td class="play-column" valign="middle" align="center">
{if $rsTrack->track_audio_is_linked==true}
			<a href="/index.php/music/play/{$rsTrack->track_id}/" title="{$rsTrack->song_title}" type="audio/mpeg"><img src="{$config.to_vigilante}/images/icons/speaker-grey.gif" width="14" height="14" alt="[Play]" border="0" /></a>
{/if}
		</td>
		{*<td class="download-column" valign="middle" align="center">
{if $rsTrack->track_audio_is_downloadable==true}
			<a href="/index.php/music/save/{$rsTrack->audio_id}/" class="log_audio_download" title="Download"><img src="{$config.to_vigilante}/images/icons/download-music-grey.gif" width="14" height="14" alt="[Download]" border="0"></a>
{else}
{assign var=track_num value=$rsTrack->track_track_num}
{if $rsITunesLinks.$track_num}
			<a href="{$rsITunesLinks.$track_num|escape:'html'}" class="itunes_download" title="Download from iTunes"><img src="{$config.to_vigilante}/images/icons/download-music-grey.gif" width="14" height="14" alt="[Download from iTunes]" border="0"></a>
{else}
			<img src="/images/icons/download-music-yellow.gif" width="14" height="14" alt="[Download not available]" title="[Download not available]" border="0">
{/if}
{/if}
		</td>*}
	</tr>
{/foreach}
</table>

{*<p>
		Release date: {if $rsRelease->release_release_date}<strong>{$rsRelease->release_release_date|date_format:"%B %d, %Y"}{else}To be determined{/if}</strong><br>
		Label: <strong>{if $rsRelease->release_label}{$rsRelease->release_label}{else}Observant{/if}</strong><br>
{if $rsRelease->album_catalog_num}Catalog no.: <strong>{$rsRelease->album_catalog_num}</strong><br>{/if}
</p>

<h4>Buy</h4>

{if $rsRelease->release_store_description}
<div class="smaller">
{parse_line_breaks txt=$rsRelease->release_store_description}
</div>
{/if}

{if $rsDigitalLinks}
<div class="smaller">
	<p>Downloads{if $rsRelease->release_is_downloadable} also{/if} available from:</p>

	<ul>
{foreach item=rsDigitalLink from=$rsDigitalLinks}
		<li> {if $rsDigitalLink->ecommerce_url}<a href="{$rsDigitalLink->ecommerce_url|escape:'html'}">{$rsDigitalLink->ecommerce_label}</a>{else}{$rsDigitalLink->ecommerce_label}{/if}</li>
{/foreach}
	</ul>
</div>

<h4>Donate</h4>

<div class="smaller">
	<p>Already downloaded the songs for free? If you liked what you heard, please consider leaving a tip.</p>

	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="donate">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="2686659">
		<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" name="submit" alt="PayPal - The safer, easier way to pay online!" title="PayPal - The safer, easier way to pay online!">
		<p>
		<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</p>
	</form>
</div>
{/if}
*}
{if $rsRelease->release_music_description || $rsEntry->entry_text}
<h4>About this album</h4>

{if $rsRelease->release_music_description}
{parse_line_breaks txt=$rsRelease->release_music_description}
{if $rsRelease->release_music_description_more}{parse_line_breaks txt=$rsRelease->release_music_description_more}{/if}
{elseif $rsEntry->entry_text!=''}
{parse_line_breaks txt=$rsEntry->entry_text}
{if $rsEntry->entry_text_more}{parse_line_breaks txt=$rsEntry->entry_text_more}{/if}
{/if}
{/if}


{literal}
<script type="text/javascript">
$(document).ready(function ()
{
	$('.log_audio_download').click(function ()
	{
		var re = /\/([0-9]+)\//;
		if (String(this).match(re) != null)
		{
			var audio_id = String(this).match(re)[1];
			log_audio_click(audio_id, this);
			return false;
		}
	});
});
</script>
{/literal}

{else}
<p>This release is not yet available.</p>
{/if}



