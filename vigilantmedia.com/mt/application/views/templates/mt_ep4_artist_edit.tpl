<h4 class="admin_head">Artist information</h4>

<form action="/index.php/ep4/artist/{if $artist_id}update/{$artist_id}{else}create{/if}/" method="post" name="ep4_artist" id="ep4_artist">

	<p>
		<label for="artist_last_name">Last name/Band name:</label>
		<input type="text" name="artist_last_name" value="{$rsArtist->artist_last_name|escape:htmlall}" size="45" />
	</p>
	
	<p>
		<label for="artist_last_name">First name:</label>
		<input type="text" name="artist_first_name" value="{$rsArtist->artist_first_name|escape:htmlall}" size="45" />
	</p>
	
	<p>
	{if $artist_id}<input type="hidden" name="artist_id" value="{$artist_id}" />{/if}
	<input type="submit" value="Save" />
	</p>

</form>


{literal}
<script type="text/javascript">
$(document).ready(function ()
{
	$('#ep4_artist').validate(
	{
		rules:
		{
			artist_last_name: {required: true}
		}
	});
});
</script>
{/literal}
