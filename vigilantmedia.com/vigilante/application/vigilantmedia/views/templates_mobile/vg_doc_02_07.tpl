<h1>Tutorials</h1>

<h2>Using the Smarty template engine</h2>

<p>Smarty is a fully featured template engine developed
separately from Vigilante. To learn more about how to use Smarty, visit <a href="http://smarty.php.net/">http://smarty.php.net/</a>.</p>

<p>To create a Smarty object, call the <code>Smarty()</code>
function at the top of your page. The object is assigned to the reserved
variable <code>$smarty</code>.</p>

<p>Vigilante does not use Smarty's default file paths to store
its libraries, so it is recommended to initialize a Smarty object with the <code>Smarty()</code>
function. If you want to assign a Smarty object to another variable, create a
new object named <code>Smarty_Extended</code>. You can
also simply assign a variable of your own choosing to the <code>$smarty</code>
variable.</p>

{literal}
<blockquote>
Example 2-7-1<br/>
<code><em>// Reassign the reserved variable $smarty to one of your choosing.</em><br/>
<br/>

Smarty();<br/>
$page = $smarty;<br/>
<br/>
<em>// Assign your variable to Vigilante's extended Smarty class.</em><br/>
<br/>

$page = new Smarty_Extended;<br/>
<br/>
<em>// Calling the default Smarty class will cause errors in Vigilante.</em><br/>
<br/>

$page = new Smarty;<br/>
</code></blockquote>
{/literal}


<p>Vigilante includes the following set of default template
files:</p>

<ul>
<li><code>global_header.tpl</code><br/>
Use this template to store the top portion of your HTML source code.</li>
<li><code>global_footer.tpl</code><br/>
Use this template to store the bottom portion of your HTML source code.</li>
<li><code>global_page.tpl</code><br/>
This template concatenates global_header.tpl, global_footer.tpl and a content template passed to Smarty from your PHP scripts.</li>
<li><code>root_index.tpl</code><br/>
Use this template to store the default page of your site.</li>
</ul>
<p>To simplify template maintenance, create separate templates
to store your content, independent of any header or footer layout. When your
script is ready to pass its data to Smarty, assign the name of a template to
the variable <code>$content_template</code> and
display <code>global_page.tpl</code>.</p>

{literal}
<blockquote>
Example 2-7-2<br/>
<code>
include("$DOCUMENT_ROOT/includes/common.php");<br/>
<em>//Initialize the Smarty object</em><br/>
Smarty();<br/>
<br/>

[. . . multple Smarty assignments . . .]<br/>
<br/>

$smarty-&gt;assign("content_template", "template_file.tpl");<br/>
$smarty-&gt;display("global_page.tpl");<br/>
</code></blockquote>
{/literal}

