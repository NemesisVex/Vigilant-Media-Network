<h1>Tutorials</h1>

<h2>Retrieving data from a database</h2>

<p>To create a web page that returns results of a database
query, you would need to create a script that performs the following steps:</p>

<ol>
<li>Connect to a database server.</li>
<li>Select a database.</li>
<li>Query the database.</li>
<li>Retrieve the results of the query.</li>
<li>Print the results of the query.</li>
</ol>
<p>In a web site with a PHP/MySQL backend, that process can
expressed with the following code:</p>

{literal}
<blockquote>
Example 2-2-1<br/>
<code><em>// 1. Connect to a database server.</em><br/>
$Conn = mysql_connect('your-mysql-host.com', 'mysql_login', 'mysql_password');<br/>
<br/>
<em>// 2. Select a database.</em><br/>
mysql_select_db('mymusic', $Conn);<br/>
<br/>
<em>// 3. Query the database.</em><br/>
$result = mysql_query('Select * From Artists', $Conn);<br/>
<br/>
<em>// 4. Retrieve the results of the query.</em><br/>
<br/>

while ($recordset = mysql_fetch_object($result))<br/>
{<br/>
<em>// 5. Print the results of the query.</em><br/>
     echo "&lt;p&gt;$recordset-&gt;Name&lt;/p&gt;";<br/>
}<br/>
</code></blockquote>
{/literal}


<p>For a simple query, that code suffices. But if your pages include
multiple queries, and each query requires complex joins, repeating that code
can get messy.</p>

{literal}
<blockquote>
Example 2-2-2<br/>
<code><em>//Connect to the server and choose the mymusic database</em><br/>

$Conn = mysql_connect('your-mysql-host.com', 'mysql_login', 'mysql_password');<br/>
mysql_select_db('mydatabase', $Conn);<br/>
<br/>
<em>//Retrieve artist information for the band FooBar Fighters</em><br/>

$query = "Select * From Artists Where Name='FooBar Fighters'";<br/>
$result = mysql_query($query, $Conn);<br/>
$recordset_artist = mysql_fetch_object($result);<br/>
echo "&lt;p&gt;$recordset_artist-&gt;Name&lt;/p&gt;";<br/>
<br/>
<em>//Retrieve albums by FooBar Fighters, with track info for each album</em><br/>

$query = '';<br/>
$query .= "Select Al.*, Tr.* ";<br/>
$query .= "From Albums as Al Left Join Tracks as Tr ";<br/>
$query .= "on Tr.AlbumID=Al.AlbumID ";<br/>
$query .= "Where Al.ArtistID=$recordset_artist-&gt;ArtistID ";<br/>
$query .= "Order By Al.AlbumTitle, Tr.TrackNum";<br/>
<br/>

$result = mysql_query($query, $Conn);<br/>
<br/>

echo "&lt;p&gt;";<br/>
while ($recordset_albums = mysql_fetch_object($result))<br/>
{<br/>
      [ ...display results... ]<br/>
}<br/>
echo "&lt;/p&gt;";<br/>
</code></blockquote>
{/literal}


<p>In Vigilante, that code can be reduced by a few lines.</p>

{literal}
<blockquote>
Example 2-2-3<br/>
<code>
include("$DOCUMENT_ROOT/includes/common.php");<br/>
SQL();<br/>
<br/>
<em>//Retrieve artist information for the band FooBar Fighters</em><br/>
<br/>

$recordset_artist = SelectRecord("Artists", "Name='FooBar Fighters'", "rs");<br/>
echo "&lt;p&gt;$recordset_artist-&gt;Name&lt;/p&gt;";<br/>
<br/>
<em>//Retrieve albums by FooBar Fighters, with track info for each album</em><br/>
<br/>

$result = SelectJoinedRecord(<br/>
"Albums as Al Left Join Tracks as Tr on Tr.AlbumID=Al.AlbumID",<br/>
"Al.*, Tr.*",<br/>
"Where Al.ArtistID=$recordset_artist-&gt;ArtistID Order By Al.AlbumTitle, Tr.TrackNum",<br/>
"row");<br/>
<br/>

echo "&lt;p&gt;";<br/>
while ($recordset_albums = mysql_fetch_object($result))<br/>
{<br/>
      [ ...display results... ]<br/>
}<br/>
echo "&lt;/p&gt;";<br/>
</code></blockquote>
{/literal}


<p>In Example 2-2-3, the script first reads in Vigilante's
libraries. A call to the function <code>SQL()</code>
establishes a connection to the database.</p>

<p>In the first query, Vigilante pieces together a <code>Select</code> query
with a specified table ("Artists") and a <code>Where</code> clause
("Name='FooBar Fighters'"), then returns the result as an object. For
<code>Select</code> queries, Vigilante can return results as a resource or as an object.</p>

<p>In the second query, Vigilante pieces together a more
complex Select query and returns the result as a resource, which can then be
used with <code>mysql_fetch_object()</code> to
write the output.</p>

