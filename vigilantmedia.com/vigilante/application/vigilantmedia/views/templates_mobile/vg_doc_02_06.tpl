<h1>Tutorials</h1>

<h2>Parsing XML with Vigilante</h2>

<p>Vigilante parses XML with a class based on the Amazon PHP API by Calin Uioreanu. This class, simply named <code>xml</code>, handles almost every function required to parse XML <em>except</em> parser creation and the end element handler. You must first extend the <code>xml</code> class with your own custom class to include:</p>

<ol>
<li>A constructor which sets the <code>$parser</code> property to create a parser.</li>
<li>An end handler method.</li>
</ol>
<p>As an example, Vigilante includes a class named <code>rss</code>,
which parses RSS feeds. Example 2-6-1 demonstrates how Vigilante that feed.</p>

{literal}
<blockquote>
Example 2-6-1<br/>
<code><em>//Instantiate an RSS object.</em><br/>
$rss = new rss;<br/>
<br/>
<em>//Get a file pointer resource with the following URL, but timeout after 20 seconds.</em><br/>
$rss-&gt;setInputUrl('http:<em>//www.mysite.com/index.xml', 20);</em><br/>
<br/>
<em>//Parse the RSS feed.</em><br/>
$show_feed = $rss-&gt;parse();<br/>
<br/>
<em>//If the parsing is successful, display the results.</em><br/>
if ($show_feed==true)<br/>
{<br/>
     [ ...display RSS feed... ]<br/>
}<br/>
</code></blockquote>
{/literal}


<p>For more information on extending Vigilante's XML class, see
Extending the xml class.</p>
