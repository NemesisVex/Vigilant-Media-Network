<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>&#26085;&#12293;&#12398;&#26412;{if $page_title}: {$page_title}{/if}</title>
<meta name="description" content="Yet another stroke of genius, stolen from a good friend.">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
{literal}
<style type="text/css">
<!--
p {text-indent: 50px;}
p.normal {text-indent: 0px;}
-->
</style>
{/literal}
</head>

<body style="color: #000; a.active: #000; background: #FFF url('/images/extras/sand.gif');">

<p class="normal"><span style="font: 24pt courier new,courier"><strong>&#26085;&#12293;&#12398;&#26412;</strong></span></p>

<p class="normal"><strong><tt><a href="/">home</a>: <a href="/index.php/journal/">&#26085;&#12293;&#12398;&#26412;</a>: {if $rsEntry}{$rsEntry->entry_created_on|date_format:"%y-%b-%d"}{else}{$section_label}{/if}</tt></strong></p><br>

<div style="margin: auto 10% auto 10%;">
{if $section_label}<span style="font: 18pt courier new,courier"><strong>{$section_label}</strong></span></p>{/if}

{if $content_template}{include file=$content_template}{/if}

<p><br/></p>

<hr size="1" width="50%">

<p><br/></p>

<div style="text-align: center">
<span style="font-size: smaller;">
<p class="normal">
<a href="/index.php/journal/archives/">archives</a> | <a href="/index.php/journal/about/">history</a> | <a href="/index.php/journal/cast/">cast</a> | <a href="/index.php/journal/links/">links</a> | <a href="/index.php/members/">members</a><br>
<a href="/">delve</a> <a href="/index.php/journal/contact/">further</a>
</p>
</span>
</div>

</body>
</html>
