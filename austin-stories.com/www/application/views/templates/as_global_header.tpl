<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>austin stories{if $page_title!=""}: {$page_title}{/if}</title>
{if $geourl_template}{include file=$geourl_template}{/if}
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="alternate" type="application/rss+xml" title="Austin Stories RSS" href="http://www.austin-stories.com/rss.xml">
<link rel="alternate" type="application/rss+xml" title="Austin Stories Site News RSS" href="http://www.austin-stories.com/index.xml">
<link rel="stylesheet" href="/includes/austinstories.css" type="text/css">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<script type="text/javascript" src="{$config.to_vigilante}/includes/jquery.js"></script>
<script type="text/javascript" src="{$config.to_vigilante}/includes/jquery.vigilante.js"></script>
<script type="text/javascript" src="{$config.to_vigilante}/includes/jquery.validate.pack.js"></script>
{literal}
<script type="text/javascript">
$(document).ready(function ()
{
	$('a[class="help"]').click(function ()
	{
		window.open(this, 'help', 'height=350, width=250, location=false, menubar=false, scrollbars=yes, status=no, toolbar=no');
		return false;
	});
});
</script>
{/literal}
</head>
<body>
<!-- ukey="7EB125F6" -->
<table id="Content" cellspacing="0" border="0">
<tr>
	<td class="nav-cell" align="right" valign="top">
<a href="/">home</a> &#8226;
<a href="/index.php/directory/">directory</a> &#8226;
<a href="/index.php/members/">my austin stories</a> &#8226;
<a href="/index.php/help/">help</a> &#8226;
<a href="/index.php/aus/about/">about</a> &#8226;
<a href="/index.php/aus/contact/">contact</a>
	</td>
	<td bgcolor="#000000" class="buffer-cell"></td>
	<td id="SideCell" valign="top" rowspan="2">
<a href="/"><img src="/images/austin_stories_v02.gif" width="120" height="49" alt="" border="0"></a>
	</td>
</tr>
<tr>
	<td id="MainCell" valign="top">
{if $breadcrumbs}
<div class="header3">
<p>
{$breadcrumbs}
</p>
</div>
{/if}

{if $section_head}<h1 class="header1">{$section_head}{if $section_label}: {$section_label}{/if}</h1>{/if}

{if $section_sublabel}<h2 class="header2">{$section_sublabel}</h2>{/if}

