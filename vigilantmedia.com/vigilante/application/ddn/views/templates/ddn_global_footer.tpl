{if $content_side_template}
</div>

<div id="frame-2" class="prepend-1 span-6 last">
{include file=$content_side_template}
</div>
{/if}

{if $smarty.const.ENVIRONMENT!='prod'}
<div class="span-22 last smaller">
<a href="http://ddn{$smarty.server.REQUEST_URI}">DEV</a> &#8226;
<a href="http://test.duran-duran.net{$smarty.server.REQUEST_URI}">TEST</a> &#8226;
<a href="http://www.duran-duran.net{$smarty.server.REQUEST_URI}">PROD</a>
</div>
{/if}

</div>
</div>

{literal}
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-7828220-5");
pageTracker._trackPageview();
} catch(err) {}
</script>
{/literal}

</body>
</html>
