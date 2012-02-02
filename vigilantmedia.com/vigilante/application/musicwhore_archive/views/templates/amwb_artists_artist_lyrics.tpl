{include file=amwb_artists_artist_navigation.tpl}

<div class="SectionHead3">
<p><em><strong>{$rsLyric->track_song_title}</strong>{if $rsLyric->AltTitle} ({$rsLyric->AltTitle}){/if}</em><br>
<span style="font-size: 85%">
{assign var=formatMask value=$rsLyric->album_format_mask}
~ From the {$config.album_format_mask.$formatMask} <em><a href="/index.php/artists/album/tracks/{$rsLyric->album_id}/">{$rsLyric->album_title}</a></em>
~ {$rsLyric->detail_catalog_num}
</span></p>
</div>

{if $romaji || $eigo || $kanji}
<div style="font-size: 85%; border-bottom: 1px solid #CC9;">
<p>
VIEW:
{if $romaji}<a id="romaji_toggle" style="cursor: pointer;">ROMAJI</a>{/if}
{if $kanji}&#8226; <a id="kanji_toggle" style="cursor: pointer;">KANJI</a>{/if}
{if $eigo}&#8226; <a id="eigo_toggle" style="cursor: pointer;">ENGLISH</a>{/if}
</p>
</div>

<div id="lyrics" style="display: block;"></div>


<div id="romaji" style="display: none;">{if $romaji}
<p><span style="font-size: 85%;" id="romajisource">SOURCE: <strong>{if $lyrics->romajii->translator->translationlink}<a href="{$lyrics->romaji->translator->translationlink}">{$lyrics->romajii->translator->translatorname}</a>{else}{$lyrics->romajii->translator->translatorname}{/if}</strong></span></p>
{$romaji}
{/if}</div>

<div id="eigo" style="display: none;">{if $eigo}
<p><span style="font-size: 85%;">SOURCE: <strong>{if $lyrics->eigo->translator->translationlink}<a href="{$lyrics->eigo->translator->translationlink}">{/if}{$lyrics->eigo->translator->translatorname}{if $lyrics->eigo->translator->translationlink}</a>{/if}</strong></span></p>
{$eigo}
{/if}</div>

<div id="kanji" style="display: none;">{if $kanji}
<p><span style="font-size: 85%;">SOURCE: <strong>{if $lyrics->kanji->translator->translationlink}<a href="{$lyrics->kanji->translator->translationlink}">{/if}{$lyrics->kanji->translator->translatorname}{if $lyrics->kanji->translator->translationlink}</a>{/if}</strong></span></p>
{$kanji}
{/if}</div>

<script type="text/javascript">
<!--
{literal}
$('document').ready(function ()
{
	$('#lyrics').html(init_lyrics());
	$('#romaji_toggle').click(function () {load_lyrics('#romaji');});
	$('#kanji_toggle').click(function () {load_lyrics('#kanji');});
	$('#eigo_toggle').click(function () {load_lyrcs('#eigo');});
});

function init_lyrics()
{
	var romaji = $('#romaji').html();
	var eigo = $('#eigo').html();
	var kanji = $('#kanji').html();
	
	var lyrics = (romaji!='') ? romaji : ((eigo!='') ? eigo : kanji);
	$('#lyrics').html(lyrics);
}

function load_lyrics(div_id)
{
	$('#lyrics').html($(div_id).html());
}
{/literal}
//-->
</script>
{/if}
