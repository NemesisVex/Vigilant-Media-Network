<h3>Links</h3>

<nav class="span-3 append-1">
	<h4>Projects</h4>

	<h5 class="link-subhead">music</h5>

	<p>
		<a href="{$config.to_eponymous4}" title="My home studio project">eponymous 4</a><br />
		<a href="{$config.to_observant}" title="My home studio label">observant records</a><br />
{if $smarty.const.ENVIRONMENT!='production'}
		<a href="{$config.to_emptyensemble}" title="My other home studio label">empty ensemble</a><br />
		<a href="{$config.to_shinkyokuadvocacy}" title="My music publishing company">shinkyoku advocacy</a><br />
{/if}
	</p>

	<h5 class="link-subhead">personal</h5>

	<p>
		<a href="/index.php/sakufu/" title="A neglected blog">作譜</a><br />
		<a href="/index.php/meisakuki/" title="A creative scrapbook">名作記</a><br />
{if $smarty.const.ENVIRONMENT!='production'}<a href="/index.php/journal/" title="A defunct online journal">日々の本</a><br />
		<a href="/index.php/work/" title="Stories and lies">work in progress</a><br />{/if}
		<a href="/index.php/vexvox/" title="An online journal">vexvox</a><br />
{if $smarty.const.ENVIRONMENT!='production'}<a href="{$config.to_austinstories}" title="An online journal portal">austin stories</a><br />{/if}
	</p>

	<h5 class="link-subhead">media</h5>

	<p>
		<a href="{$config.to_ddn}" title="duran duran on the web 2.0">duran-duran.net</a><br />
		<a href="{$config.to_filmwhore}" title="movie reviews from someone who doesn't watch many movies">filmwhore.org</a><br />
		<a href="{$config.to_archive}" title="the original music blog">archive</a>.<a href="{$config.to_musicwhore}" title="a music blog covering j-indie, modern classical and music by gay artists">musicwhore.org</a><br />
		<a href="{$config.to_tvwhore}" title="tv is my drug of choice">tvwhore.org</a><br />
	</p>

	<h5 class="link-subhead">professional</h5>

	<p>
		<a href="{$config.to_vigilantmedia}" title="an online portfolio">vigilant media</a><br />
	</p>

	<p><a href="/index.xml"><img src="/images/rss_button.gif" alt="[RSS]" width="36" height="14" title="[RSS]" /></a></p>

</nav>

<nav class="span-3 append-1 last">
	<h4>Social</h4>

	<p>
		<a href="http://blip.fm/NemesisVex">blip.fm</a><br />
		<a href="http://delicious.com/NemesisVex">delicious</a><br />
		<a href="http://www.facebook.com/greg.bueno">facebook</a><br />
		<a href="http://www.last.fm/user/NemesisVex/">last.fm</a><br />
		<a href="http://www.myspace.com/eponymous4">myspace</a><br />
		<a href="http://www.physicsdiet.com/Public.aspx?u=NemesisVex">physicsdiet</a><br />
		<a href="http://rateyourmusic.com/~NemesisVex">rate your music</a><br />
		<a href="http://twitter.com/NemesisVex">twitter</a><br />

	</p>

	<p><a href="/index.php/gb/distractions/">more ...</a></p>
</nav>

{if $smarty.const.ENVIRONMENT!="production"}
<hr />

<nav>
	<h5 class="link-subhead">development</h5>

	<p>
		<a href="{$config.to_mt}">central administration</a><br>
		<a href="http://mysql.vigilantmedia.com/">production mysql server</a><br>
		<a href="{$config.to_vigilantdev}">vigilant media dev</a><br>
	</p>
</nav>

<nav class="smaller">
	<p>
		<a href="http://gbueno{$smarty.server.REQUEST_URI}">DEV</a> &#8226;
		<a href="http://test.gregbueno.com{$smarty.server.REQUEST_URI}">TEST</a> &#8226;
		<a href="http://www.gregbueno.com{$smarty.server.REQUEST_URI}">PROD</a>
	</p>
</nav>
{/if}

