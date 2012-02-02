{foreach key=e item=rsProject from=$rsProjects}
<div class="album-container">
<div class="album-left">
<p>
<img src="/images/_covers/_color_front_200_{$rsProject.album_image}" alt="[{$rsProject.album_title}]" title="[{$rsProject.album_title}]" width="200" height="200" class="album-cover">
</p>

{if $rsProject.format_name=='cd album'}
{if ($smarty.now >= strtotime($rsProject.release_release_date|date_format)) || ($smarty.now >= strtotime($rsProject.release_preorder_date_start|date_format))}
<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_cart_SM.gif" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
<input type="hidden" name="add" value="1">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="business" value="observantrecords@eponymous4.com">
<input type="hidden" name="item_name" value="{$rsProject.album_title}">
<input type="hidden" name="item_number" value="{$rsProject.release_catalog_num}">
<input type="hidden" name="amount" value="{if ($smarty.now >= strtotime($rsProject.release_sale_date_start)) && ($smarty.now < strtotime($rsProject.release_sale_date_end))}{$rsProject.release_sale_price|string_format:"%.2f"}{else}{$rsProject.release_store_price|string_format:"%.2f"}{/if}">
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
Price: {if $rsProject.release_store_price}{if ($smarty.now >= strtotime($rsProject.release_sale_date_start)) && ($smarty.now < strtotime($rsProject.release_sale_date_end))}<strong>USD <strike>${$rsProject.release_store_price|string_format:"%.2f"}</strike> ${$rsProject.release_sale_price|string_format:"%.2f"}</strong> (until {$rsProject.release_sale_date_end|date_format:"%m/%d/%Y"}){else}<strong>USD ${$rsProject.release_store_price|string_format:"%.2f"}</strong>{/if}{else}To be determined{/if}<br>
Shipping: <strong>Free</strong><br>
Sales tax: <strong>8.25% for Texas residents</strong><br>
{*Shipping: <a href="#shipping">See below</a>.*}
</p>

{if ($smarty.now >= strtotime($rsProject.release_preorder_date_start|date_format)) && ($smarty.now < strtotime($rsProject.release_release_date|date_format))}
<div class="indent-20px">
<p>
<em>Now available for pre-order! Order today, and your copy will be shipped a week before the release date!</em>
</p>
</div>
{/if}
{/if}


{if $rsProject.release_store_description}
<div class="smaller">
{parse_line_breaks txt=$rsProject.release_store_description}
</div>
{/if}

</div>

<div class="album-right">
<h3>{$rsProject.album_title}</h3>

<ol>
{foreach key=track_id item=rsTrack from=$rsProject.album_tracks}
<li> {$rsTrack.song_title} {if $rsTrack.track_audio_is_linked}<span class="smaller">[<a href="/audio/{$rsTrack.map_audio_id}/play/vocals/">listen</a>] [<a href="/audio/{$rsTrack.map_audio_id}/save/vocals/">save</a>]</span>{/if}</li>
{/foreach}
</ol>

<p>
Release date: {if $rsProject.release_release_date}<strong>{$rsProject.release_release_date|date_format:"%B %d, %Y"}{else}To be determined{/if}</strong><br>
Label: <strong>{if $rsProject.release_label}{$rsProject.release_label}{else}Observant{/if}</strong><br>
{if $rsProject.album_catalog_num}Catalog no.: <strong>{$rsProject.album_catalog_num}</strong><br>{/if}
</p>

{if $rsProject.album_music_description}
{parse_line_breaks txt=$rsProject.album_music_description}
{/if}

</div>
</div>

<br clear="all">

{/foreach}

