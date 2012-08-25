	</td>
	<td class="buffer-cell"></td>
</tr>
<tr>
	<td class="nav-cell" colspan="3">
	all posts &copy; respective authors. site design and code &copy; 2003-{"now"|date_format:"%Y"} <a href="http://www.gregbueno.com/">greg bueno</a>. <a href="/index.php/aus/terms/">terms and conditions of services</a>.
{if $smarty.const.ENVIRONMENT!="production"}
<a href="http://austinstories{$smarty.env.REQUEST_URI|escape:"html"}">dev</a>.
<a href="http://test.austin-stories.com{$smarty.env.REQUEST_URI|escape:"html"}">test</a>.
<a href="http://www.austin-stories.com{$smarty.env.REQUEST_URI|escape:"html"}">prod</a>.
{/if}
	</td>
</tr>
</table>

{literal}
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-7828220-4");
pageTracker._trackPageview();
} catch(err) {}
</script>
{/literal}

</body>
</html>
