<h1>Function Reference</h1>

<h2>objects.php</h2>


<h3>obj::GetInfo</h3>

<h4>Usage:</h4>

<p><code>string object-&gt;GetInfo(integer <em>primary
index</em>, string <em>result return</em>);</code></p>

<h4>Description:</h4>

<p><code>obj::GetInfo()</code> retrieves
database records by the <em>primary index</em> either as an object or resource,
as specified by <em>result return</em>. <em>result return</em> is a quoted string
of one of these possible values:</p>

<p><code>"row"</code></p>

<p>Return the results as a resource.</p>

<p><code>"rs"</code></p>

<p>Return the results as an object.</p>

<p>The properties <code>$table</code>
and <code>$tableIndex</code> must be defined before using <code>obj::GetInfo()</code>.</p>

{literal}
<blockquote>
Example 4-3-1<br/>
<code>

$obj = new obj;<br/>
$obj-&gt;table = "table_name";<br/>
$obj-&gt;tableIndex = "table_primary_id";<br/>
$table_id = 1;<br/>
<br/>
<em>//Return query results as a resource.</em><br/>
$resource = $obj-&gt;GetInfo($table_id, "row");<br/>
<br/>
<em>//Return query results as an object.</em><br/>
$recordset = $obj-&gt;GetInfo($table_id, "rs");<br/>
<br/>
</code></blockquote>
{/literal}


<h3>obj::GetRS</h3>

<h4>Usage:</h4>

<p><code>string object-&gt;GetRS(string <em>condition</em>,
string <em>result return</em>);</code></p>

<h4>Description:</h4>

<p><code>obj::GetRS()</code> retrieves
database records with the specified <em>condition</em> serving as the Where
clause to a Select query and returns either an object or a resource, as
specified by <em>result return</em>. <em>result return</em> is a quoted string of
one of these possible values:</p>

<p><code>"row"</code></p>

<p>Return the results as a resource.</p>

<p><code>"rs"</code></p>

<p>Return the results as an object.</p>

<p>The property <code>$table</code> must
be defined before using <code>obj::GetRS()</code>.</p>

{literal}
<blockquote>
Example 4-3-2<br/>
<code>

$obj = new obj;<br/>
$obj-&gt;table = "table_name";<br/>
<br/>
<em>//Return query results as a resource.</em><br/>
$resource = $obj-&gt;GetRS("table_id=1", "row");<br/>
<br/>
<em>//Return query results as an object.</em><br/>
$recordset = $obj-&gt;GetInfo($table_id, "rs");<br/>
<br/>
</code></blockquote>
{/literal}


<h3>Smarty_Extended::Smarty_Extended</h3>

