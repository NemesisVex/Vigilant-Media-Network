<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Archive.Musicwhore.org{if $page_title}: {$page_title}{/if}</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="{$config.to_musicwhore}/includes/global.css">
<link rel="stylesheet" type="text/css" href="/includes/musicwhore.css">
<script type="text/javascript" src="{$config.to_vigilante}/includes/jquery.js"></script>
<script type="text/javascript" src="{$config.to_vigilante}/includes/jquery.swfobject.js"></script>
<script type="text/javascript" src="{$config.to_vigilante}/includes/jquery.swfobject.ext.js"></script>
<script type="text/javascript" src="{$config.to_vigilante}/includes/jquery.query.js"></script>
<script type="text/javascript" src="{$config.to_musicwhore}/includes/swfobject_musicwhore.js"></script>
<script type="text/javascript" src="/includes/musicwhore.js"></script>
</head>
<body>

<div id="Masthead">
<div id="Masthead-Left"><span style="font-size: 284%"><a href="/" style="text-decoration: none;">Archive.Musicwhore.org</a></span><br>
<span style="font-size: 90%;">the original. somewhat.</span>
</div>
<div id="Masthead-Right">
<form method="get" action="{$config.to_mt}/cgi-bin/mt/mt-search.cgi">
<strong>Search:</strong>
<input type="hidden" name="IncludeBlogs" value="{$config.blog_id}">
<input type="hidden" name="Template" value="archivesearch">
<input id="search" name="search" size="20">
<input type="submit" value="Go">
</form>
</div>
</div>

<div id="Content">
{if $section_head}<h2>{$section_head}</h2>{/if}

{if $section_label}<h3>{$section_label}</h3>{/if}

{if $section_sublabel}<h4>{$section_sublabel}</h4>{/if}
