{if $rsDigitals}
<ul class="album-list">
{foreach key=e item=rsDigital from=$rsDigitals name=digital}
{assign var=wrp_file value=$config.ep4_cover_root_path|cat:"/_exm_front_120_"|cat:$rsDigital->album_image}
<li> <a href="/index.php/music/digital/{$rsDigital->album_alias}/" class="no-fx"><img src="/images/_covers/_{if file_exists($wrp_file)}exm{else}color{/if}_front_120_{$rsDigital->album_image}" alt="[{$rsDigital->album_title}]" title="[{$rsDigital->album_title}]" width="120" height="120" class="album-cover"></a></li>
{/foreach}
</ul>
{else}
<p>No digital albums are available.</p>
{/if}
