<form action="/index.php/filmwhore/amazon/browse/{$film_id}/" method="post" name="asin">

<p>
Keywords: <input type="text" name="keywords" size="50" value="{$keywords}"><br>
Locale:
<input type="radio" name="locale" value="us"{if ($locale=='us' || $locale=='')} checked{/if}> US
<input type="radio" name="locale" value="jp"{if $locale=='jp'} checked{/if}> Japan
<input type="radio" name="locale" value="uk"{if $locale=='uk'} checked{/if}> UK
<input type="radio" name="locale" value="de"{if $locale=='de'} checked{/if}> Germany
<input type="radio" name="locale" value="ca"{if $locale=='ca'} checked{/if}> Canada
<input type="radio" name="locale" value="fr"{if $locale=='fr'} checked{/if}> France<br>
Channel:
<input type="radio" name="mode" value="Music"{if ($mode=='Music')} checked{/if}> Music
<input type="radio" name="mode" value="DigitalMusic"{if $mode=='DigitalMusic'} checked{/if}> Digital Music
<input type="radio" name="mode" value="Classical"{if $mode=='Classical'} checked{/if}> Classical
<input type="radio" name="mode" value="Books"{if $mode=='Books'} checked{/if}> Books
<input type="radio" name="mode" value="DVD"{if $mode=='DVD' || $mode==''} checked{/if}> DVD<br>
</p>

<p>
{if $pg}<input type="hidden" name="pg" value="{$pg}">{/if}
<input type="submit" name="do" value="Search">
</p>

</form>


{if $display}
{if $items}
<table class="Admin_Wide">
<tr>
	<th>TITLE</th>
	<th>OPTIONS</th>
</tr>
{foreach item=item from=$items}
<tr>
	<td valign="top">
<strong>{$item->ItemAttributes->Title}</strong><br>
&#8212; ASIN: <a href="http://{$config.amazon_locale.$locale.domain}/exec/obidos/ASIN/{$item->ASIN}/{$config.amazon_locale.$locale.associateID}/">{$item->ASIN}</a>
{if $item->ItemAttributes->UPC}&#8212; UPC: {$item->ItemAttributes->UPC}{/if}
{if $item->ItemAttributes->EAN}&#8212; EAN: {$item->ItemAttributes->EAN}{/if}
{if $item->ItemAttributes->ISBN}&#8212; ISBN: {$item->ItemAttributes->ISBN}{/if}
	</td>
	<td valign="top">
{if $film_id}
<a href="/index.php/filmwhore/amazon/film/{$film_id}/{$item->ASIN}/{$locale}/{$item->ItemAttributes->Title|escape:"url"|escape:"url"}/">Update</a><br>
{else}
<a href="/index.php/filmwhore/amazon/import/{$item->ASIN}/{$locale}/">Import</a><br>
{/if}
	</td>
</tr>
{/foreach}
</table>

{if $page_links}
<p>
{$page_links}
</p>
{/if}

{else}
<p>Your search returned no results.</p>
{/if}

{else}

<p>Amazon Web Services returned the following error: <strong>{$error_message}</strong></p>

{/if}

