{literal}
<script type="text/javascript">
function ToggleRelationButtons (id, related, similar)
{
	if (id.checked == true)
	{
		related.disabled = false;
		similar.disabled = false;
	} 
	else
	{
		related.disabled = true;
		similar.disabled = true;
	}
}
</script>
{/literal}

<h4 class="admin_head">Artist associations</h4>


<p><strong>Direct associations</strong></p>

{if $rsRelations}
<form action="/index.php/musicwhore/related/update/{$related_artist_id}/{if $filter}{$filter}/{/if}" method="post" name="link">

<table class="Admin">
{foreach key=i item=rsRelated from=$rsRelations}
<tr>
	<td><strong><a href="/artist/{$rsRelated->artist_id}/">{format_artist_name_object obj=$rsRelated}</a></strong></td>
	<td>
<input type="radio" id="related_in_{$i}_related" name="related_in[{$i}][related_relation]" value="related"{ if $rsRelated->related_relation=="related"} checked{/if}> related
<input type="radio" id="related_in_{$i}_similar" name="related_in[{$i}][related_relation]" value="similar"{ if $rsRelated->related_relation=="similar"} checked{/if}> similar
<input type="hidden" name="related_in[{$i}][related_relation_id]" value="{$rsRelated->related_relation_id}">
<input type="hidden" name="related_in[{$i}][artist_name]" value="{format_artist_name_object obj=$rsRelated}">
	</td>
	<td>
<input type="checkbox" name="related_in[{$i}][delete]" value="1"> Delete
<input type="hidden" name="related_in[{$i}][related_id]" value="{$rsRelated->related_id}">
	</td>
</tr>
{/foreach}
<tr>
	<td colspan="3">
	<input type="submit" value="Update" style="font-size: 90%;">
	</td>
</tr>
</table>

</form>
{else}
<p>No direct associations exist.</p>
{/if}

<p><strong>Reciprocal associations</strong></p>

{if $rsReciprocals}
<form action="/index.php/musicwhore/related/update/{$related_artist_id}/{if $filter}{$filter}/{/if}" method="post" name="link">
<input type="hidden" name="related_relation_id" value="{$related_artist_id}">

<table class="Admin">
{foreach key=i item=rsRelated from=$rsReciprocals}
<tr>
	<td><strong><a href="/artist/{$rsRelated->artist_id}/">{format_artist_name_object obj=$rsRelated}</a></strong></td>
	<td>
<input type="radio" id="related_in_{$i}_related" name="related_in[{$i}][related_relation]" value="related"{ if $rsRelated->related_relation=="related"} checked{/if}> related
<input type="radio" id="related_in_{$i}_similar" name="related_in[{$i}][related_relation]" value="similar"{ if $rsRelated->related_relation=="similar"} checked{/if}> similar
<input type="hidden" name="related_in[{$i}][related_artist_id]" value="{$rsRelated->related_artist_id}">
<input type="hidden" name="related_in[{$i}][artist_name]" value="{format_artist_name_object obj=$rsRelated}">
	</td>
	<td>
<input type="checkbox" name="related_in[{$i}][delete]" value="1"> Delete
<input type="hidden" name="related_in[{$i}][related_id]" value="{$rsRelated->related_id}">
	</td>
</tr>
{/foreach}
<tr>
	<td colspan="3">
	<input type="submit" value="Update" style="font-size: 90%;">
	</td>
</tr>
</table>

</form>
{else}
<p>No reciprocal associations exist.</p>
{/if}

<p><strong>Create an association</strong></p>

<form action="/index.php/musicwhore/related/create/{$related_artist_id}/{if $filter}{$filter}/{/if}" method="post" name="link">
<p>Artist to associate with <strong>{format_artist_name_object obj=$rsArtist}</strong>:</p>

<p>
<span style="font-size: 80%">
Filter:
{foreach item=rsNav from=$rsNav}
<a href="/index.php/musicwhore/related/browse/{$related_artist_id}/{$rsNav->nav|lower}/">{$rsNav->nav}</a>
{/foreach}
</span>
</p>

<select name="relation_id" size="7" style="background-color: #000; color: #FFF;">
{foreach item="rsArtist" from=$rsArtists}
<option value="{$rsArtist->artist_id}"> {format_artist_name_object obj=$rsArtist}
{/foreach}
</select></p>

<p>Type of relationship:<br>
<input type="radio" name="related_relation" value="related" checked> Related <em>(artist has members in another group)</em><br>
<input type="radio" name="related_relation" value="similar"> Similar <em>(artist sounds like another group)</em><br></p>

<p>Direction of relationship:<br>
<input type="radio" name="relation_direction" value="direct" checked> Direct<br>
<input type="radio" name="relation_direction" value="reciprocal"> Reciprocal</p>

<input type="submit" value="Update">

</form>

