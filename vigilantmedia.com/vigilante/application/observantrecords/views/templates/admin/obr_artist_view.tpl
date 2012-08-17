{include file=obr_global_header.tpl}

{if !empty($rsArtist)}
<h3>Artist Info</h3>

<p>
	<a href="/index.php/admin/artist/edit/{$rsArtist->artist_id}/"><img src="{$config.to_vigilante}/images/icons/edit-page-blue.gif" /></a>
	<a href="/index.php/admin/artist/edit/{$rsArtist->artist_id}/">Edit</a>
</p>

<p>
	<label>Last name:</label> {$rsArtist->artist_last_name}
</p>

{if !empty($rsArtist->artist_first_name)}
<p>
	<label>First name:</label> {$rsArtist->artist_first_name}
</p>
{/if}

{if !empty($rsArtist->artist_display_name)}
<p>
	<label>Display name:</label> {$rsArtist->artist_display_name}
</p>
{/if}

{if !empty($rsArtist->artist_url)}
<p>
	<label>URL:</label> <a href="{$rsArtist->artist_url}">{$rsArtist->artist_url}</a>
</p>
{/if}

<h3>Albums</h3>

<h3>Song Catalog</h3>

{else}
	<p>Artist information is not available.</p>
{/if}
