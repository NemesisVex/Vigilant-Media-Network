<?
include("$_SERVER[DOCUMENT_ROOT]/includes/common.php");
SQL();
RegisterGlobals();
Smarty();
header("Cache-Content: private");

$forecast_file = "$_SERVER[DOCUMENT_ROOT]/includes/fgs_forecast.xml";
if (false !== ($fp = fopen($forecast_file, "r")))
{
	$fgsXML = fread($fp, filesize($forecast_file));
	fclose($fp);
}

if (!empty($fgsXML))
{
	$fgs = new XMLParser($fgsXML);
	$fgs->Parse();
	
	$today_start = strtotime(date("Y-m-d") . " 00:00:00");
	$today_end = strtotime(date("Y-m-d") . " 23:59:59");
	$e=0;
	for ($i=0; $i<count($fgs->document->transit); $i++)
	{
		$showTransit=false;
		$transitHead = $fgs->document->transit[$i]->transithead[0]->tagData;
		$transitDate = $fgs->document->transit[$i]->transitdate[0]->tagData;
		$transitInfo = $fgs->document->transit[$i]->transitinfo[0]->tagData;
		if ($exactDate = $fgs->document->transit[$i]->transitdateexact[0]->tagData)
		{
			//DebugTrace("TransitDateExact: $exactDate");
			$exactDate_time = strtotime($exactDate);
			if ($exactDate_time >= $today_start && $exactDate_time <=$today_end)
			{
				$exactStyle=" style=\"color: #9FC\"";
			}
		}
		if (($startDate = $fgs->document->transit[$i]->transitdatestart[0]->tagData) && ($endDate = $fgs->document->transit[$i]->transitdateend[0]->tagData))
		{
			$startDate_time = strtotime($startDate);
			$endDate_time = strtotime($endDate) + 86399;
			if ($startDate_time<=$today_start && $endDate_time>=$today_end)
			{
				$showTransit=true;
			}
		}
		if (isset($exactDate) && (!isset($fgs->document->transit[$i]->transitdatestart[0]->tagData) && !isset($fgs->document->transit[$i]->transitdateend[0]->tagData)))
		{
			$exactDate_time = strtotime($exactDate);
			if ($today_start==$exactDate_time)
			{
				$showTransit=true;
			}
		}
		
		if ($showTransit==true)
		{
			$transit[$e]["exact_style"] = $exactStyle;
			$transit[$e]["transit_head"] = $transitHead;
			$transit[$e]["transit_date"] = $transitDate;
			$transit[$e]["transit_info"] = $transitInfo;
			$e++;
		}
		unset($exactStyle);
	}
}

//===SMARTY OUTPUT===
//general data
$smarty->assign("transit", $transit);

//page properties

//template properties
$smarty->assign("content_template", "gb_root_fgs.tpl");

//display
$smarty->display("gb_global_page.tpl");
?>
