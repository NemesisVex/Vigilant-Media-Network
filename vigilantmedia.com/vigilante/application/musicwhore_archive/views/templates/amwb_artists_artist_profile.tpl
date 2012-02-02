{include file=amwb_artists_artist_navigation.tpl}

<h3>Profile</h3>

{if $rsArtist->artist_biography}
<div style="float: right; padding-left: 10px;">
{if $artist_image}<p><img src="/images/1pixel.gif" alt="[{$artist_name}]" id="artist_img"><img src="/images/1pixel.gif" id="artist_mask"></p>{/if}

{if $rsMembers}
<p>
{foreach item=rsMember from=$rsMembers}
<strong>{if $rsMember->member_asian_name_utf8}{$rsMember->member_asian_name_utf8} ({$rsMember->member_name}){else}{$rsMember->member_name}{/if}</strong>: {$rsMember->member_instruments}<br>
{/foreach}
</p>
{/if}
</div>

{parse_line_breaks txt=$rsArtist->artist_biography}
{parse_line_breaks txt=$rsArtist->artist_biography_more}

<script type="text/javascript">
var file_system = '{$rsArtist->artist_file_system}';

{literal}
$(document).ready(function ()
{
	get_artist_image(file_system);
});


{/literal}
</script>

{else}
<p>No bio written yet.</p>
{/if}

	
