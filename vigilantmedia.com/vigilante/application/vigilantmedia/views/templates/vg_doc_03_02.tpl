<h1>Scripting with Vigilante</h1>

<h2>Setting up a page to use Vigilante</h2>

<p>To access the Vigilante libraries, the first line in your
PHP script must include the <code>common.php</code>
file from the <code>/includes/</code> directory.
Depending upon your server configuration, you may need to use a full file
system path.</p>

{literal}
<blockquote>
Example 3-2-1<br/>
<code>
include("/includes/common.php");<br/>
</code></blockquote>
{/literal}


{literal}
<blockquote>
Example 3-2-2<br/>
<code>
include("$DOCUMENT_ROOT/includes/common.php");<br/>
</code></blockquote>
{/literal}


{literal}
<blockquote>
Example 3-2-3<br/>
<code>
include("/file/path/to/includes/common.php");<br/>
</code></blockquote>
{/literal}


{literal}
<blockquote>
Example 3-2-4<br/>
<code>
include("C:/file/path/to/includes/common.php");<br/>
</code></blockquote>
{/literal}


<p>The next lines in your script should initialize your
database connection and Smarty object. Use the <code>SQL()</code>
and <code>Smarty()</code> functions.</p>

{literal}
<blockquote>
Example 3-2-5<br/>
<code>
include("$DOCUMENT_ROOT/includes/common.php");<br/>
SQL();<br/>
Smarty();<br/>
</code></blockquote>
{/literal}


<p>In Example 3-2-5, the database connection is assigned to the
reserved variable <code>$Conn</code>, and the Smarty
object is assigned to the reserved variable <code>$smarty</code>.</p>
