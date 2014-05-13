</div>

<div id="Menu">
<a href="/">Main</a><br />
<a href="/index.php/jcon/faq/">FAQ</a><br />
<a href="/index.php/jcon/registration/">Registration</a><br />
<a href="/index.php/jcon/hotel/">Hotel</a><br />
<a href="/index.php/jcon/programming/">Programming</a><br />
<a href="/index.php/jcon/transportation/">Transportation</a><br />
<a href="/index.php/jcon/austin/">About Austin</a><br />
<a href="/index.php/jcon/local/">Texans, click here!</a><br />
<a href="/index.php/jcon/attendees/">Attendees</a><br />
<a href="/index.php/jcon/committee/">The Committee</a><br /> 	
<a href="/index.php/jcon/sponsors/">Sponsors</a><br />
<a href="/index.php/jcon/thanks/">Thanks</a><br />
<a href="/index.php/jcon/links/">Link To Us</a><br />
{if $smarty.const.ENVIRONMENT!="production"}
<hr size=1 width=50%>
<a href="http://journalcon{$smarty.server.REQUEST_URI}">DEV</a><br>
<a href="http://test.journalcon.austin-stories.com{$smarty.server.REQUEST_URI}">TEST</a><br>
<a href="http://journalcon.austin-stories.com{$smarty.server.REQUEST_URI}">PROD</a><br>
{/if}
</div>
<!-- BlueRobot was here. -->
</body>
</html>
