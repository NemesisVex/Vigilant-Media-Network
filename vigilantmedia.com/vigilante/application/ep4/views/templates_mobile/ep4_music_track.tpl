{if $rsTrack}
<h3>{$rsTrack->song_title}</h3>

{if $rsRelease}<p>Available on <em><a href="/index.php/music/digital/{$rsRelease->album_alias}/">{$rsRelease->album_title}</a></em></p>{/if}

{if $rsAudio}
{if $rsAudio->track_audio_is_linked==true}
<h4><a href="/index.php/music/play/{$rsTrack->track_id}/" title="{$rsTrack->song_title}" type="audio/mpeg"><img src="{$config.to_vigilante}/images/icons/speaker-grey.gif" width="14" height="14" alt="[Play]" border="0" /></a> Listen</h4>
{/if}
{/if}

{*
<h4>Download</h4>

{if $rsLinks}

<p>This song can be purchased from:</p>

<ul>
{foreach item=rsLink from=$rsLinks}
<li> {if $rsLink->ecommerce_url}<a href="{$rsLink->ecommerce_url|escape}">{$rsLink->ecommerce_label}</a>{else}{$rsLink->ecommerce_label}{/if}</li>
{/foreach}
</ul>
{/if}

{if $rsTrack->track_audio_is_downloadable==true}
<p>You can download the track for free, but if you like what you hear, consider <a href="javascript:" id="leave_a_tip" title="Donate via Paypal">leaving a tip</a>.</p>

<p>
<a href="/index.php/music/save/{$rsAudio->track_id}/" class="log_audio_download" title="Download"><img src="/images/icons/download-music-grey.gif" width="14" height="14" alt="[Download]" border="0"> Download</a>
</p>

<p>
<a href="javascript:" id="send_donation" title="Donate via Paypal"><img src="/images/icons/checkout2-grey.gif" width="14" height="14" alt="[Donate]" border="0"> Donate via Paypal</a>
</p>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="donate">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="2686659">
</form>

{literal}
<script type="text/javascript">
$(document).ready(function () {
	$('#send_donation').click(function()
		{
			$('#donate').submit();
		});
	$('#leave_a_tip').click(function()
		{
			$('#donate').submit();
		});
	$('.log_audio_download').click(function ()
	{
		var audio_id = String(this).match(/\/([0-9]+)\//)[1];
		log_audio_click(audio_id, this);
		return false;
	});
});
</script>
{/literal}

{else}
{if $rsLinks==''}
<p>This song is not yet available for download.</p>
{/if}
{/if}
*}

{if $rsEntry->entry_status==2}
<h4>About this track</h4>

{parse_line_breaks txt=$rsEntry->entry_text}
{parse_line_breaks txt=$rsEntry->entry_text_more}
{/if}

{if $rsTrack->song_lyrics}
<h4>Lyrics</h4>

{parse_line_breaks txt=$rsTrack->song_lyrics}
{/if}

{else}
<p>No track was found.</p>
{/if}

