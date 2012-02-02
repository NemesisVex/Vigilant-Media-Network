<?php
include("$_SERVER[DOCUMENT_ROOT]/includes/common.php");
SQL();
RegisterGlobals();

switch ($do)
{
	case "GetArtistPageImages":
		$artistImage = "$fileSystem.jpg";
		$artistPath = "$config[img_artist_root]/$artistImage";
		$artistUri = "/images/artists/$artistImage";
		list ($artistWidth, $artistHeight) = getimagesize($artistPath);
		
		$sortDir = substr($fileSystem, 0, 1);
		$albumPath = "$config[img_discog_root]/$sortDir/$fileSystem/$albumImage";
		$albumUri = "/images/discog/$sortDir/$fileSystem/$albumImage";
		list ($albumWidth, $albumHeight) = getimagesize($albumPath);
		echo "artist_img=$artistUri&artist_width=$artistWidth&artist_height=$artistHeight&album_img=$albumUri&album_width=$albumWidth&album_height=$albumHeight";
		die();
		break;
	case "GetArtistImage":
		$imgPath = "$config[img_artist_root]/$sortDir/$fileSystem.jpg";
		$imgUri = "/images/artists/$fileSystem.jpg";
		list ($width, $height) = getimagesize($imgPath);
		echo "artist_img=$imgUri&width=$width&height=$height";
		die();
		break;
	case "GetAlbumImage":
		$sortDir = substr($fileSystem, 0, 1);
		$imgPath = "$config[img_discog_root]/$sortDir/$fileSystem/$albumImage";
		$imgUri = "/images/discog/$sortDir/$fileSystem/$albumImage";
		list ($width, $height) = getimagesize($imgPath);
		echo "album_img=$imgUri&width=$width&height=$height";
		die();
		break;
	default:
		header("Location: /images/dont_steal.gif");
}

?>