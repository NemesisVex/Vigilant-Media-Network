<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>austin stories{if $page_title}: {$page_title}{/if}</title>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="/includes/austinstories.css" type="text/css">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<script type="text/javascript" src="{$config.to_vigilante}/includes/jquery.js"></script>
<script type="text/javascript" src="{$config.to_vigilante}/includes/jquery.vigilante.js"></script>
<script type="text/javascript" src="{$config.to_vigilante}/includes/jquery.validate.pack.js"></script>
{literal}
<script type="text/javascript">
window.focus();
$(document).ready(function ()
{
	$('a[class=popup]').click(function()
	{
		opener.document.location.href = this;
		return false;
	});
});
</script>
{/literal}
</head>
<body>
<table id="Content" cellspacing="0">
<tr>
	<td valign="top" id="SideCell"><img src="/images/austin_stories_v02.gif" width="120" height="49" alt="" border="0"></td>
</tr>
<tr>
	<td valign="top" id="MainCell">
<div>
		<p><span class="header1">help.</span><br>
		<span style="font-size: 7pt; font-style: italic">(<strong>NOTE:</strong> Most links in this window will update in the parent window.)<br></span></p>
{include file=$content_template}
</div>
	</td>
</tr>
<tr>
	<td>
<div align="center">
<p><span style="font-size: 7pt">
[<a href="javascript:window.close();">close window</a>]
</span></p>
</div>
	</td>
</tr>
</table></p>

</body>
</html>
