{if $rsTrack}
				<div id="column-1" class="span-14 prepend-1 append-1">
					<hgroup>
						<h2>Music</h2>
						<h3>{$rsTrack->song_title}</h3>
{if $rsAudio}
{if $rsAudio->track_audio_is_linked==true}
						<h4><a href="/index.php/music/play/{$rsTrack->track_id}/" title="{$rsTrack->song_title}" type="audio/mpeg"></a> Listen</h4>
{/if}
{/if}
					</hgroup>
{if $rsEntry->entry_status==2}
					<header>
						<h4>About this track</h4>
					</header>
					
					<section>
{parse_line_breaks txt=$rsEntry->entry_text}
{parse_line_breaks txt=$rsEntry->entry_text_more}
					</section>
{/if}

{if $rsTrack->song_lyrics}
					<header>
						<h4>Lyrics</h4>
					</header>

{parse_line_breaks txt=$rsTrack->song_lyrics}
{/if}
				</div>
				<div id="column-2" class="span-6 prepend-1 append-1 last">
{if $rsRelease}
					<header>
						<h4>Available on ...</h4>
					</header>
					
					<section>
						<p>
{assign var=wrp_file value=$config.ep4_cover_root_path|cat:"/_exm_front_200_"|cat:$rsRelease->album_image}
{assign var=exm_file value=$config.ep4_cover_root_path|cat:"/_exm_front_342_"|cat:$rsRelease->album_image}
							<a href="/index.php/music/digital/{$rsRelease->album_alias}/"><img src="/images/_covers/_{if file_exists($wrp_file)}exm{else}color{/if}_front_200_{$rsRelease->album_image}" alt="[{$rsRelease->album_title}]" title="[{$rsRelease->album_title}]" class="album-cover" width="200" height="200" /></a><br/>
							<a href="/images/_covers/_{if file_exists($exm_file)}exm{else}color{/if}_front_342_{$rsRelease->album_image}" rel="facebox" class="smaller">View larger image</a>
						</p>
					</section>
					
					
{/if}
{*
					<header>
						<h4>Download</h4>
					</header>

					<section>
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
					</section>
				</div>

				<script type="text/javascript" src="http://webplayer.yahooapis.com/player-beta.js"></script> 
{else}
				<p>No track was found.</p>
{/if}

