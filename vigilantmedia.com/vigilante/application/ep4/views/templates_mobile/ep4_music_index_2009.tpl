<h2>cd</h2>

{if $rsCDs}
<ul class="album-list">
{foreach key=e item=rsCD from=$rsCDs}
<li> <a href="/index.php/music/cd/{$rsCD->album_alias}/" class="no-fx"><img src="/images/_covers/_color_front_120_{$rsCD->album_image}" alt="[{$rsCD->album_title}]" title="[{$rsCD->album_title}]" width="120" height="120" class="album-cover"></a></li>
{/foreach}
</ul>
{else}
<p>No CD albums are available</p>
{/if}

<h2>work release program</h2>

<p>The Work Release Program is a series of releases featuring the demo recordings of Eponymous 4. These home recordings approximate how a final album would sound, but they are not considered definitive. Some performances may be rough, and the recordings are not totally polished.</p>

{if $rsDigitals}
<ul class="album-list">
{foreach key=e item=rsDigital from=$rsDigitals name=digital}
{assign var=wrp_file value=$config.ep4_cover_root_path|cat:"/_wrp_front_120_"|cat:$rsDigital->album_image}
<li> <a href="/index.php/music/digital/{$rsDigital->album_alias}/" class="no-fx"><img src="/images/_covers/_{if file_exists($wrp_file)}wrp{else}color{/if}_front_120_{$rsDigital->album_image}" alt="[{$rsDigital->album_title}]" title="[{$rsDigital->album_title}]" width="120" height="120" class="album-cover"></a></li>
{/foreach}
</ul>
{else}
<p>No albums from the Work Release Program are yet available.</p>
{/if}
