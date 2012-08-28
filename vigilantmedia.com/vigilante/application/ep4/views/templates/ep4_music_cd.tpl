				<div id="column-1">
					<hgroup>
						<h2>Music</h2>
						<h3>{$rsRelease->album_title}</h3>
					</hgroup>

					<table class="track-table">
						<tr>
							<th class="track-column">TRACK</th>
							<th>TITLE</th>
							<th class="play-column"></th>
						</tr>
{foreach key=track_id item=rsTrack from=$rsTracks}
							<tr>
								<td class="track-column">{$rsTrack->track_track_num}</td>
								<td>{$rsTrack->song_title}</td>
								<td  class="play-column" valign="middle" align="center">
									<a href="/index.php/music/play/{$rsTrack->track_id}/" title="{$rsTrack->song_title}" type="audio/mpeg"></a>
								</td>
							</tr>
{/foreach}
					</table>

					<p>
						Release date: {if $rsRelease->release_release_date}<strong>{$rsRelease->release_release_date|date_format:"%B %d, %Y"}{else}To be determined{/if}</strong><br>
						Label: <strong>{if $rsRelease->release_label}{$rsRelease->release_label}{else}Observant{/if}</strong><br>
					{if $rsRelease->album_catalog_num}Catalog no.: <strong>{$rsRelease->album_catalog_num}</strong><br>{/if}
				</p>

				{if $rsRelease->release_music_description}
					{parse_line_breaks txt=$rsRelease->release_music_description}
				{/if}

				</div>

				<div id="column-2">
					<p>
						<img src="/images/_covers/_color_front_200_{$rsRelease->album_image}" alt="[{$rsRelease->album_title}]" title="[{$rsRelease->album_title}]" class="album-cover" width="200" height="200">
					</p>

					{if ($smarty.now >= strtotime($rsRelease->release_release_date|date_format)) || ($smarty.now >= strtotime($rsRelease->release_preorder_date_start|date_format))}
						<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
							<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_cart_SM.gif" name="submit" alt="PayPal - The safer, easier way to pay online!">
							<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
							<input type="hidden" name="add" value="1">
							<input type="hidden" name="cmd" value="_cart">
							<input type="hidden" name="business" value="observantrecords@eponymous4.com">
							<input type="hidden" name="item_name" value="{$rsRelease->album_title}">
							<input type="hidden" name="item_number" value="{$rsRelease->release_catalog_num}">
							<input type="hidden" name="amount" value="{if ($smarty.now >= strtotime($rsRelease->release_sale_date_start)) && ($smarty.now < strtotime($rsRelease->release_sale_date_end))}{$rsRelease->release_sale_price|string_format:"%.2f"}{else}{$rsRelease->release_store_price|string_format:"%.2f"}{/if}">
							<input type="hidden" name="no_shipping" value="2">
							<input type="hidden" name="no_note" value="1">
							<input type="hidden" name="currency_code" value="USD">
							<input type="hidden" name="lc" value="US">
							<input type="hidden" name="bn" value="PP-ShopCartBF">
						</form>
					{else}
						<p class="smaller">This disc hasn't been released yet, but when it is, you can purchase it here directly using Paypal or from other fine music outlets.</p>
					{/if}

					<p>
						Price: {if $rsRelease->release_store_price}{if ($smarty.now >= strtotime($rsRelease->release_sale_date_start)) && ($smarty.now < strtotime($rsRelease->release_sale_date_end))}<strong>USD <strike>${$rsRelease->release_store_price|string_format:"%.2f"}</strike> ${$rsRelease->release_sale_price|string_format:"%.2f"}</strong> (until {$rsRelease->release_sale_date_end|date_format:"%m/%d/%Y"}){else}<strong>USD ${$rsRelease->release_store_price|string_format:"%.2f"}</strong>{/if}{else}To be determined{/if}<br>
						Shipping: <strong>Free</strong><br>
						Sales tax: <strong>8.25% for Texas residents</strong><br>
					</p>

					{if ($smarty.now >= strtotime($rsRelease->release_preorder_date_start|date_format)) && ($smarty.now < strtotime($rsRelease->release_release_date|date_format))}
						<div class="indent-20px">
							<p>
								<em>Now available for pre-order! Order today, and your copy will be shipped a week before the release date!</em>
							</p>
						</div>
					{/if}

					{if $rsCDLinks}
						<div class="smaller">
							<p>CD also available from:</p>

							<ul>
								{foreach item=rsCDLink from=$rsCDLinks}
									<li> {if $rsCDLink->ecommerce_url}<a href="{$rsCDLink->ecommerce_url|escape:"html"}">{$rsCDLink->ecommerce_label}</a>{else}{$rsCDLink->ecommerce_label}{/if}</li>
								{/foreach}
							</ul>
						</div>
					{/if}

					{if $rsOtherLinks}
						<div class="smaller">
							<p>Downloads and other formats available from:</p>

							<ul>
								{foreach item=rsOtherLink from=$rsOtherLinks}
									<li> {if $rsOtherLink->ecommerce_url}<a href="{$rsOtherLink->ecommerce_url|escape:"html"}">{$rsOtherLink->ecommerce_label}</a>{else}{$rsOtherLink->ecommerce_label}{/if}</li>
								{/foreach}
							</ul>
						</div>
					{/if}
				</div>

				<script type="text/javascript" src="http://webplayer.yahooapis.com/player-beta.js"></script> 