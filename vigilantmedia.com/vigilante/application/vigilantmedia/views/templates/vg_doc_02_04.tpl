<h1>Tutorials</h1>

<h2>Deleting from a database</h2>

<p>A script to delete a single record from a database can be
expressed in the following code:</p>

{literal}
<blockquote>
Example 2-4-1<br/>
<code>

$result = mysql_query("Delete From Tracks Where TrackID=$TrackID");<br/>
</code></blockquote>
{/literal}


<p>Vigilante reduces this code as well.</p>

{literal}
<blockquote>
Example 2-4-2<br/>
<code>

DeleteRecord("Tracks","TrackID=$TrackID");<br/>
</code></blockquote>
{/literal}
