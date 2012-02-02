<h1>Programming</h1>
<!--intro paragraff start here pleese-->

<p><b>Updated August 22, 2003</b></p>
<p>
Here's the most current listing of panels and sessions. We are waiting for final confirmation 
from a few of the parties involved before we announce <i>all</i> the participants. We'll 
also post the scheduled times for these panels soon. Check back, and keep an eye on the 

<a href="/news.php">News page</a> -- there are a couple more surprises in store in the way 
of programming, and trust us -- you will not want to be the last to know.</p>

<!--intro paragraff end here pleese-->
{if $rsPanels}
{foreach item=rsPanel from=$rsPanels}
<p>
<b>{$rsPanel.PanelTitle}</b><br>
<i>{$rsPanel.PanelLocation}{if $rsPanel.PanelDate}, {$rsPanel.PanelDate|date_format:"%l, %m %d, %h:%M %a"}{/if}</i><br>
{$rsPanel.PanelDescription}<br>
<i><b>Panelists:</b></i><br>
{foreach item=rsPanelist from=$rsPanel.panelists}
<i>{$rsPanelist.BadgeName}{if $rsPanelist.IsModerator==true}, moderator{/if}{if $rsPanelist.SiteName} (<a href="{$rsPanelist.URL}">{$rsPanelist.SiteName}</a>){/if}</i><br>
{/foreach}
</p>
{/foreach}
{/if}