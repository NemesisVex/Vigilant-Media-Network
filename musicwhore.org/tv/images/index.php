<?
include("$_SERVER[DOCUMENT_ROOT]/includes/je.php");

if (preg_match("/musicwhore\.org/",$HTTP_REFERER) || preg_match("/^.+\/\/je/",$HTTP_REFERER) || preg_match("/vigilantmedia\.com/",$HTTP_REFERER) || $REMOTE_ADDR=="127.0.0.1")
{
	switch ($type)
	{
		case "artist":
			$path = "/img/artists";
			break;
		case "discog":
			$path = "/img/discog";
			if ($subDir!="") {$path .= "/" . $subDir;}
			break;
		case "custom":
			$path = "/img/" . $subDir;
			break;
		case "global":
			$path = "/img";
			break;
	}
	header("Location: $path/$img");
}
else
{
		header("Location: /images/dont_steal.gif");
}
?>