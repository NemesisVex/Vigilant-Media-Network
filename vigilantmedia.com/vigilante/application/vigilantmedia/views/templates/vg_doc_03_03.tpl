<h1>Scripting with Vigilante</h1>

<h2>Setting up forms to use Vigilante</h2>

<p>The key to using Vigilante's database handling functions is
to map the name of your HTML form fields with the fields in your database. You
must use the exact syntax of your database field names on your forms.</p>

<p>In the tutorial database <code>mymusic</code>,
the database field names use initial capital letters, such as ArtistID,
SongTitle and LastName. In a MySQL installation of the content management
system Movable Type (version 2.6.4), database fields use lowercase and
underscores, such as mt_entry, mt_trackback, and mt_blog.</p>

<p>Example 3-3-1 shows an HTML form that collects various types
of data, not all of it related to database maintenance.</p>

{literal}
<blockquote>
Example 3-3-1<br/>
<code><em>/*<br/>
These input fields collect data for the tutorial database, mymusic<br/>
*/</em><br/>

&lt;input type="text" name="AlbumTitle"&gt;<br/>
&lt;input type="hidden" name="AlbumID" value="&lt;?=$albumID;?&gt;"&gt;<br/>
<br/>
<em>/*<br/>
These input fields collect data for the Movable Type table, mt_entry<br/>
*/</em><br/>

&lt;input type="text" name="entry_title"&gt;<br/>
&lt;input type="hidden" name="entry_id" value="&lt;?=$entry_id;?&gt;"&gt;<br/>
<br/>
<em>//This hidden field is used for scripting purposes only.</em><br/>
&lt;input type="hidden" name="do " value="update_database"&gt;<br/>
<br/>

&lt;input type="submit" value="Submit"&gt;<br/>
</code></blockquote>
{/literal}


<p>Example 3-3-2 shows a script that processes the form in
Example 3-3-1.</p>

{literal}
<blockquote>
Example 3-3-2<br/>
<code><em>// Make sure $do is set to "update_database".</em><br/>

if ($do=="update_database")<br/>
{<br/>
<em>//Convert the form input into an associative array.</em><br/>
     $formData = AssignFormInputToArray();<br/>
<br/>
<em>//Retrieve the record from Albums to update ...</em><br/>
     $result_albums = SelectRecord("Albums", "AlbumID=$AlbumID", "row");<br/>
<br/>
<em>//... and update it.</em><br/>
     UpdateRecord($result_albums, 0, $formData, "Albums", "AlbumID=$AlbumID");<br/>
<br/>
<em>//Retrieve the record from mt_entry ...</em><br/>
     $result_mt = SelectRecord("mt_entry", "entry_id=$entry_id", "row");<br/>
<br/>
<em>//... and update it.</em><br/>
     UpdateRecord($result_mt, 0, $formData, "mt_entry", "entry_id=$entry_id);<br/>
}<br/>
</code></blockquote>
{/literal}


<p>In each of the <code>UpdateRecord()</code>
functions, Vigilante take only the portion of the form input relevant to the
table passed to the function. In the case of the update query to Albums, only
AlbumTitle and AlbumID are recognized. In the case of the update query to
mt_entry, only entry_title and entry_id are recognized.</p>

<p>In both queries, the hidden input field named "do"
is ignored.</p>

<p>Vigilante's database handling allows you to build your HTML
forms with as many or as few fields needed.</p>

<p>CAUTION: If your form includes names and values necessary
only for scripting, make sure the syntax of those fields do not conflict with
your database field names.</p>
