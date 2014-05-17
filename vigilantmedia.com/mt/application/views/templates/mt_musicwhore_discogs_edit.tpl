<h4 class="admin_head">Musicbrainz information</h4>

<p>The following Discogs ID is currently associated with <strong><a href="/index.php/musicwhore/{if $rsDiscogs->discogs_release_id}release/edit/{$rsDiscogs->discogs_release_id}{else}album/edit/{$rsDiscogs->discogs_album_id}{/if}/">{$rsDiscogs->album_title}</a></strong>:</p>

<ul>
	<li> Release: {if $rsDiscogs->discogs_discog_id}<a href="http://discogs.com/release/{$rsDiscogs->discogs_discog_id}">{$rsDiscogs->discogs_discog_id}</a>{else}Not set{/if}</li>
</ul>

{if $release_info}
<p>Discogs provides the following information about this release.</p>

<table class="Admin_Wide">
<tr>
	<th>ALBUM</th>
	<th>FORMAT</th>
	<th>LABEL</th>
	<th>CATALOG NO.</th>
	<th>RELEASE DATE</th>
	<th>COUNTRY</th>
</tr>
{foreach item=release from=$release_info}
<tr>
	<td><strong>{$release->title}</strong></td>
	<td>{$release->formats->format.name} {$release->formats->format->descriptions->description}</td>
	<td>{$release->labels->label.name}</td>
	<td>{$release->labels->label.catno}</td>
	<td>{$release->released}</td>
	<td>{$release->country}</td>
</tr>
{/foreach}
</table>
{/if}

<form action="/index.php/musicwhore/discogs/update/{$discogs_id}/" method="post">


<h4>Albums</h4>

<div class="scroll-box" id="mb_albums">
<table class="Admin_Wide">
<tr>
	<th></th>
	<th>TITLE</th>
	<th>RELEASE DATE</th>
</tr>
{foreach item=rsAlbum from=$rsAlbums}
<tr>
	<td><input type="radio" name="discogs_album_id" value="{$rsAlbum->album_id}"{if $rsAlbum->album_id==$rsDiscogs->discogs_album_id} checked{/if}></td>
	<td>{$rsAlbum->album_title}</td>
	<td>{$rsAlbum->album_release_date|date_format:"%Y-%m-%d"}</td>
</tr>
{/foreach}
</table>
</div>

<h4>Releases</h4>

<div class="scroll-box" id="mb_releases">
{if $rsReleases}
{include file=mt_musicwhore_musicbrainz_album_releases.tpl rsReleases=$rsReleases}
{else}
<p>Please select an album to view a list of releases.</p>
{/if}
</div>

<p><input type="submit" value="Update"></p>

</form>

{literal}
<script type="text/javascript">

$(document).ready(function () {
	$('input[name=discogs_album_id]').click(function () {
		var url = '/index.php/musicwhore/musicbrainz/album_releases/' + this.value + '/';

		$.ajax({
			type: "POST",
			url: url,
			error: function (XMLHttpRequest, textStatus, errorThrown)
			{
				alert(errorThrown);
			},
			success: function (msg)
			{
				$('#mb_releases').html(msg);
			}
		});
	});
});

</script>
{/literal}
