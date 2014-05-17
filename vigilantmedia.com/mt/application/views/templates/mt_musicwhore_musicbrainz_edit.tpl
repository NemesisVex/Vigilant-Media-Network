<h4 class="admin_head">Musicbrainz information</h4>

<p>The following Musicbrainz IDs are currently associated with <strong><a href="/index.php/musicwhore/release/edit/{$rsMusicBrainz->mb_release_id}/">{$rsMusicBrainz->album_title}</a></strong>:</p>

<ul>
	<li> Release: {if $rsMusicBrainz->mb_album_mb_gid}<a href="http://musicbrainz.org/release/{$rsMusicBrainz->mb_album_mb_gid}.html">{$rsMusicBrainz->mb_album_mb_gid}</a>{else}Not set{/if}</li>
	<li> Release group: {if $rsMusicBrainz->mb_group_mb_gid}<a href="http://musicbrainz.org/release-group/{$rsMusicBrainz->mb_group_mb_gid}.html">{$rsMusicBrainz->mb_group_mb_gid}</a>{else}Not set{/if}</li>
</ul>

{if $release_info}
<p>Musicbrainz provides the following information about this release.</p>

{assign var=release_event_list value='release-event-list'}
{assign var=catalog_number value='catalog-number'}
<table class="Admin_Wide">
<tr>
	<th>ALBUM</th>
	<th>FORMAT</th>
	<th>LABEL</th>
	<th>CATALOG NO.</th>
	<th>RELEASE DATE</th>
	<th>COUNTRY</th>
</tr>
{foreach item=event from=$release_info->$release_event_list->event}
<tr>
	<td><strong>{$release_info->title}</strong></td>
	<td>{$event.format}</td>
	<td>{$event->label->name}</td>
	<td>{$event.$catalog_number}</td>
	<td>{$event.date}</td>
	<td>{$event.country}</td>
</tr>
{/foreach}
</table>
{/if}

<form action="/index.php/musicwhore/musicbrainz/update/{$mb_id}/" method="post">


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
	<td><input type="radio" name="mb_album_id" value="{$rsAlbum->album_id}"{if $rsAlbum->album_id==$rsMusicBrainz->mb_album_id} checked{/if}></td>
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
	$('input[name=mb_album_id]').click(function () {
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
