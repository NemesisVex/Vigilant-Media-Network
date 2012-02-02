<h1>Tutorials</h1>

<h2>Using Vigilante database classes</h2>

<p>Vigilante contains a class named <code>obj,</code>
which can simplify database interaction slightly further.</p>

<p><code>obj</code> contains a method
named <code>GetRS()</code>, which aliases the <code>SelectRecord()</code>
function. Instead of specifying a table name with each call to <code>SelectRecord()</code>,
you can instead instantiate a new <code>obj</code>,
set the <code>$table</code> property with the
name of the database table and pass a condition to <code>GetRS()</code>.</p>

<p><code>obj</code> also contains a
method named <code>GetInfo()</code>, which aliases <code>GetRS()</code>.
You can set the <code>$tableIndex</code> property with
the name of the field which serves as the primary index, then pass an index
value to <code>GetInfo()</code>.</p>

{literal}
<blockquote>
Example 2-5-1<br/>
<code><em>//Retrieve all albums with a specific artist ID as a resource.</em><br/>

$result_01 = SelectRecord("Albums", "ArtistID=$ArtistID", "row");<br/>
<br/>
<em>//Retrieve all albums with a specific album ID as an object.</em><br/>

$result_02 = SelectRecord("Albums", "AlbumID=$AlbumID", "rs");<br/>
</code></blockquote>
{/literal}


{literal}
<blockquote>
Example 2-5-2<br/>
<code><em>//Instantiate a new obj</em><br/>
$obj = new obj;<br/>
<br/>
<em>//Specify the table the object accesses.</em><br/>
$obj-&gt;table = "Albums";<br/>
<br/>
<em>//Specify the primary index of the table.</em><br/>
$obj-&gt;tableIndex = "AlbumID";<br/>
<br/>
<em>//Retrieve all albums with a specific artist ID as a resource.</em><br/>
$result_01 = $obj-&gt;GetRS("ArtistID=$ArtistID", "row");<br/>
<br/>
<em>//Retrieve an album with a specific album ID as an object.</em><br/>
$result_02 = $obj-&gt;GetInfo($AlbumID, "rs");<br/>
</code></blockquote>
{/literal}


<p>Example 2-5-2 requires more code than it would need to perform
the same tasks as Example 2-5-1. You can, however, extend the <code>obj</code>
class with your own custom classes, then define the <code>$table</code>
and <code>$tableIndex</code> properties within those classes.</p>

<p>In this example, a developer is tired of specifying the
Albums table in each of his queries. So he extends the <code>obj</code>
class with a new class named albums.</p>

{literal}
<blockquote>
Example 2-5-3<br/>
<code>

class albums extends obj<br/>
{<br/>
     $this-&gt;table = "Albums";<br/>
     $this-&gt;tableIndex = "AlbumID";<br/>
}<br/>
</code></blockquote>
{/literal}


<p>Now, the developer can use this object to query the Albums
table.</p>

{literal}
<blockquote>
Example 2-5-4<br/>
<code><em>// Create an albums object.</em><br/>
$album = new albums;<br/>
<br/>
<em>// Retrieve a record of one album as an object.</em><br/>
$recordset_album = $album-&gt;GetInfo($AlbumID, "rs");<br/>
<br/>
<em>// Print out the album title.</em><br/>
echo "&lt;p&gt;$recordset_album-&gt;AlbumTitle&lt;/p&gt;";<br/>
<br/>
<em>// Retrieve all albums by one artist as a resource.</em><br/>
$result_all_albums = $album-&gt;GetRS("ArtistID=$ArtistID", "row");<br/>
<br/>
<em>// Print out all the albums.</em><br/>
while ($recordset_all_albums = mysql_fetch_object($result_all_albums))<br/>
{<br/>
     [ ...display results... ]<br/>
}<br/>
</code></blockquote>
{/literal}
