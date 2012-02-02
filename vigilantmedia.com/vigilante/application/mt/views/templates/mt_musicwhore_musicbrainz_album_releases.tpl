<table class="Admin_Wide">
<tr>
	<th></th>
	<th>TITLE</th>
	<th>CATALOG NO.</th>
	<th>RELEASE DATE</th>
</tr>
{foreach item=rsRelease from=$rsReleases}
<tr>
	<td><input type="radio" name="mb_release_id" value="{$rsRelease->release_id}"{if $rsRelease->release_id==$release_id} checked{/if}></td>
	<td>{$rsRelease->album_title}</td>
	<td>{$rsRelease->release_catalog_num}</td>
	<td>{$rsRelease->release_release_date|date_format:"%Y-%m-%d"}</td>
</tr>
{/foreach}
</table>
