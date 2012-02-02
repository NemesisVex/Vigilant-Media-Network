<h1>Tutorials</h1>

<h2>Updating a database through forms</h2>

<h3>Inserting a new record</h3>

<p>If a user wants to update the <code>mymusic</code>
database through a web form, the form itself must use field names exactly as
they are in the database. In the following example, a user wants to add a
missing track to a FooBar Fighters album.</p>

{literal}
<blockquote>
Example 2-3-1<br/>
<code>
&lt;input type="text" name="SongTitle" value="Tom's Diner"&gt;<br/>
&lt;input type="text" name="TrackNum" value="15"&gt;<br/>
&lt;input type="hidden" name="AlbumID" value="1"&gt;<br/>
&lt;input type="submit" value="Submit"&gt;<br/>
</code></blockquote>
{/literal}


<p>A script to perform this addition would need to perform the
following steps:</p>

<ol>
<li>Clean up any strings before they're written to the database. For instance, the apostrophe in "Tom's Diner" would need be changed to "Tom''s Diner".</li>
<li>Build an Insert query.</li>
<li>Execute the query.</li>
<li>Retrieve the newly created index number if further processing is needed.</li>
</ol>
<p>That process can be expressed in the following code:</p>

{literal}
<blockquote>
Example 2-3-2<br/>
<code><em>// 1. Clean up any strings.</em><br/>

$SongTitle = preg_replace("/\'/", "''", $SongTitle);<br/>
$SongTitle = "'" . $SongTitle . "'";<br/>
<br/>
<em>// 2. Build an Insert query.</em><br/>

$database_fields = "AlbumID, TrackNum, SongTitle";<br/>
$database_values = "$AlbumID, $TrackNum, $SongTitle";<br/>
$insert_query = "Insert Into Tracks ($database_fields) Values ($database_values)";<br/>
<br/>
<em>// 3. Execute the query.</em><br/>

$result = mysql_query($insert_query, $Conn);<br/>
<br/>
<em>// 4. Retrieve the index.</em><br/>

$TrackID = mysql_insert_id();<br/>

echo "The index of the new track is $TrackID.";<br/>
</code></blockquote>
{/literal}


<p>Vigilante simplifies the process and even processes the
strings.</p>

{literal}
<blockquote>
Example 2-3-3<br/>
<code>

$form_data = AssignFormInputToArray();<br/>
$TrackID = AddRecord("Tracks", $form_data, '', '');<br/>
echo "The index of the new track is $TrackID.";<br/>
</code></blockquote>
{/literal}


<p>In Example 2-3-3, the data from the form is converted into an
associative array with field names serving as array keys. The <code>AddRecord()</code>
function performs a number tasks:</p>

<ol>
<li>It determines which fields are being written to the table by comparing database field names with array keys.</li>
<li>It makes note of which database fields contain string data and processes any strings to conform to SQL syntax.</li>
<li>It executes the query.</li>
<li>It returns the primary index of the new record.</li>
</ol>
<h3>Updating an existing record</h3>

<p>The process by which Vigilante updates a database record is
admittedly more involved than what a basic script would take to perform the
same task. In the following example, a user wants to correct the spelling of a
FooBar Fighters album.</p>

{literal}
<blockquote>
Example 2-3-4<br/>
<code>
&lt;input type="text" name="AlbumTitle" value="One By One"&gt;<br/>
&lt;input type="text" name="ReleaseDate" value="1997-04-25 00:00:00"&gt;<br/>
&lt;input type="hidden" name="AlbumID" value="15"&gt;<br/>
&lt;input type="submit" value="Submit"&gt;<br/>
</code></blockquote>
{/literal}


<p>A script to perform this addition would need to perform the
following steps:</p>

<ol>
<li>Clean up any strings before they're written to the database.</li>
<li>Build an <code>Update</code> query.</li>
<li>Execute the query.</li>
</ol>
<p>That process can be expressed in the following code:</p>

{literal}
<blockquote>
Example 2-3-5<br/>
<code><em>//1. Clean up any strings.</em><br/>

$AlbumTitle = preg_replace("/\'/", "''", $AlbumTitle);<br/>
$AlbumTitle = "'" . $Album Title . "'";<br/>
<br/>
<em>//2. Build an Update query.</em><br/>

$update_query = "Update Albums Set AlbumTitle=$AlbumTitle Where AlbumID=$AlbumID";<br/>
<br/>
<em>//3. Execute the query.</em><br/>

$result = mysql_query($update_query, $Conn);<br/>
</code></blockquote>
{/literal}


<p>If the user instead decides to update the release
information as well, the script would need to accommodate that field and any
others in the form.</p>

{literal}
<blockquote>
Example 2-3-6<br/>
<code>

$AlbumTitle = preg_replace("/\'/", "''", $AlbumTitle);<br/>
$AlbumTitle = "'" . $Album Title . "'";<br/>
$ReleaseDate = "'" . $ReleaseDate . "'";<br/>
<br/>

$update_query = '';<br/>
$update_query .= "Update Albums Set AlbumTitle=$AlbumTitle, ";<br/>
$update_query .= "ReleaseDate=$ReleaseDate ";<br/>
$update_query .= "Where AlbumID=$AlbumID";<br/>
$result = mysql_query($update_query, $Conn);<br/>
</code></blockquote>
{/literal}


<p>Vigilante takes a different approach by first comparing the
existing database record with the form input, then building a query based only
on changed values. (It will not even execute a query if the form values are not
changed.) With this method, fields can be added or deleted from the web form
with no effect on the scripting.</p>

{literal}
<blockquote>
Example 2-3-7<br/>
<code><em>//1. Convert the form data into an associative array.</em><br/>

$form_data = AssignFormInputToArray();<br/>
<br/>
<em>//2. Retrieve the database record to be updated.</em><br/>

$current_record = SelectRecord("Albums", "AlbumID=$AlbumID", "row");<br/>
<br/>
<em>//3. Update the record.</em><br/>

UpdateRecord($current_record, 0, $form_data, "Albums", "AlbumID=$AlbumID");<br/>
</code></blockquote>
{/literal}


<p>NOTE: The second argument of the <code>UpdateRecord()</code>
function is the row number of the database result, which is required for some
of PHP's MySQL functions. This value is usually set to 0 since only one record
is ever retrieved from the database.</p>

<p>CAUTION: <code>UpdateRecord</code> is a single-record function. At the moment, <strong>Vigilante</strong> does not have a specific function to handle multiple-record updates, but another function, <code>RunSelectQuery</code>, can be used to perform any kind of database query, including updates and deletions.</p>