<form action="/index.php/ecommerce/asin/search/" method="post" name="asin">
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
<input type="radio" name="mode" value="Music"{if ($mode=='Music' || $mode=='')} checked{/if}> Music
<input type="radio" name="mode" value="DigitalMusic"{if $mode=='DigitalMusic'} checked{/if}> Digital Music
<input type="radio" name="mode" value="Classical"{if $mode=='Classical'} checked{/if}> Classical
<input type="radio" name="mode" value="Books"{if $mode=='Books'} checked{/if}> Books
<input type="radio" name="mode" value="DVD"{if $mode=='DVD'} checked{/if}> DVD<br>
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
	<th>ASIN</th>
	<th>UPC</th>
	<th>EAN</th>
	<th>ISBN</th>
</tr>
{foreach item=item from=$items}
<tr>
	<td><strong><a href="http://{$config.amazon_locale.$locale.domain}/exec/obidos/ASIN/{$item->ASIN}/{$config.amazon_locale.$locale.associateID}">{$item->ItemAttributes->Title}</a></strong></td>
	<td>{$item->ASIN}</td>
	<td>{$item->ItemAttributes->UPC}</td>
	<td>{$item->ItemAttributes->EAN}</td>
	<td>{$item->ItemAttributes->ISBN}</td>
</tr>
{/foreach}
</table>

{if $page_links}
<p>
{$page_links}
</p>
{/if}

{/if}
{else}
{if $errors}
<p>Your search returned no results.</p>

<p>The following errors were returned: {$errors->Error->Message}</p>
{/if}
{/if}

{if $auth_request_uri}
<p style="font-size: smaller;"><a href="{$auth_request_uri}">Amazon request URI</a></p>
{/if}

