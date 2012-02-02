<h1>Getting Started</h1>


<h2>Introduction</h2>

<p>Vigilante is an API that allows developers to create web
	sites with dynamic content. Vigilante is intended to simplify the interaction
	of web forms with databases, allowing developers to build custom-designed
	administrative interfaces. Vigilante also supports the parsing of XML files and
	provides the Smarty template engine to render HTML output.</p>


<h2>Features</h2>

<ul>
	<li><strong>Form-to-database mapping</strong><br/>
		Developers can match fields of a web form to the fields of a database, and Vigilante writes only those values on the form that has changed.</li>
	<li><strong>Object-oriented database interface</strong><br/>
		Vigilante provides a rudimentary class to handle database queries for individual records. Programmers can extend this class to suit the needs of their own database design.</li>
	<li><strong>XML parsing</strong><br/>
		If part of a web site uses XML to generate content, Vigilante's XML library can read and parse XML data, then save it into an associative array for formatting. Remote URLs and local files are supported.</li>
	<li><strong>Smarty template engine</strong><br/>
		Vigilante employs the Smarty template engine to render HTML output.</li>
</ul>

<h2>History</h2>

<p>Vigilante started out as a custom-built content management
	system for the webzine Musicwhore.org. Parts of that CMS source code were
	reused to power other custom-made sites, including the online journal portal
	Austin Stories and the online registration for JournalCon 2003.</p>

<p>Despite sharing some common functions, each site was built
	with its own database design, creating redundant code that was difficult to
	maintain. An improvement made to one site could not easily be made on another.</p>

<p>So Vigilante was started as a way to extract all that common
	code into a foundation by which other sites may be built, while remaining
	highly customizable.</p>


<h2>Requirements</h2>

<p>PHP 4.2.x or greater.</p>

<p>MySQL 2.3.1 or greater.</p>

<p>Apache 1.3.x or greater.</p>


<h2>Installation</h2>

<p>Vigilante is not an application itself but the skeleton of
	one. You should install Vigilante only in development environments.</p>

<p>Make sure your development environment is fully operational
	before extracting Vigilante. For best results, create a separate environment
	for Vigilante, with its own document root and local hostname.</p>

<p>To install Vigilante:</p>

<ol>
	<li>Extract the Vigilante archive file in the root directory of your development web site.</li>
	<li>Create a directory called <code>templates_c</code> in the <code>/includes/smarty/</code> directory. Smarty documentation states your web server must be able to read and write to this directory. Consult with your web hosting service to determine how to change ownership and permissions. Windows environments do not require ownership or permission changes.</li>
</ol>

<h2>Configuration</h2>

<p>Open the <code>config.php</code>
	file in the <code>/includes/</code> directory and
	set the following minimum configuration values.</p>

<ul>
	<li><code>$config['webmaster_email']</code><br/>
		Set this to your e-mail address or the e-mail address you wish to appear on auto-generated e-mail.</li>
	<li><code>$config['webmaster_name']</code><br/>
		Name of webmaster. This name is placed on auto-generated e-mail, so it's best to keep it fairly anonymous.</li>
	<li><code>$config['site_name']</code><br/>
		The name or title of your site.</li>
	<li><code>$config['site_base_url']</code><br/>
		The base URL of your site.</li>
	<li><code>$config['local_site_path']</code><br/>
		The file path to the root directory of your web documents.</li>
</ul>
<p>At a point where you wish to employ your Vigilante-based
	code in a production environment, you can set configuration values based on
	different environments by setting them within the <code>switch
		(ENVIRONMENT)</code> statement. Three environment values are currently
	available with the statement:</p>

<ul>
	<li><code>dev</code><br/>
		For a development environment.</li>
	<li><code>test</code><br/>
		For a test environment.</li>
	<li><code>prod</code><br/>
		For a production environment</li>
</ul>
<p>To set an environment, open the <code>env.php</code>
	file in the <code>/includes/</code> directory and
	change the second argument of the <code>define('ENVIRONMENT')</code>
	statement to one of the environment values listed above. In your own code, you
	can then create conditional statements depending upon those environment values.</p>

<p>The <code>switch (ENVIRONMENT)</code>
	statement is most effective when dealing with separate database servers. The
	following configuration values are specified under each <code>case</code>
	statement within the <code>switch (ENVIRONMENT)</code>
	statement:</p>

<ul>
	<li><code>$config['mysql_host']</code><br/>
		Name of your MySQL host</li>
	<li><code>$config['mysql_db']</code><br/>
		Name of your MySQL database</li>
	<li><code>$config['mysql_login']</code><br/>
		Your MySQL database login</li>
	<li><code>$config['mysql_password']</code><br/>
		Your MySQL database password</li>
	<li><code>$config['send_mail']</code><br/>
		A flag to determine whether to allow auto-generated e-mail to be sent. If you do not have mail server software installed on your development environment, kept his value set this to false.</li>
</ul>
<p>You can also set these optional configuration values.</p>

<ul>
	<li><code>$config['debug_trace_color']</code><br/>
		Color of debug messages printed by the <code>DebugTrace()</code> function.</li>
	<li><code>$config['catch_error_color']</code><br/>
		Color of error messages printed by the <code>CatchError()</code> function.</li>
	<li><code>$config['catch_message_color']</code><br/>
		Color of generic messages printed by the <code>CatchMessage()</code> function.</li>
	<li><code>$config['sql_debug_query']</code><br/>
		Flag to print out SQL queries performed by functions in <code>sql.php</code>.</li>
	<li><code>$config['sql_catch_error']</code><br/>
		Flag to print out MySQL errors performed by functions in the <code>sql.php</code>.</li>
	<li>$config['sql_enable_add']<br/>
		Flag to enable functions in <code>sql.php</code> to write new records to the database.</li>
	<li><code>$config['sql_enable_update']</code><br/>
		Flag to enable functions in <code>sql.php</code> to update existing records in the database.</li>
	<li><code>$config['sql_enable_delete']</code><br/>
		Flag to enable functions in <code>sql.php</code> to delete records from the database.</li>
</ul>
<h1>Tutorials</h1>


<h2>Introduction</h2>

<p>To illustrate Vigilante's capabilities, these tutorials will
	use an example database called <code>mymusic</code>
	containing data about musical artists, their albums and songs on those albums.
	The database contains these tables and fields:</p>

<ol>
	<li>Artists</li>
	<ul>
		<li>ArtistID: primary index for the table</li>
		<li>Name: name of the artist or band</li>
	</ul>
	<li>Albums</li>
	<ul>
		<li>AlbumID: primary index for the table</li>
		<li>ArtistID: cross index with the Artist table</li>
		<li>AlbumTitle: title of an album</li>
		<li>ReleaseDate: release date of the album</li>
	</ul>
	<li>Tracks</li>
	<ul>
		<li>TrackID: primary index for the table</li>
		<li>AlbumID: cross index with the Album table</li>
		<li>DiscNum: disc number for a multi-disc set; 0 for a single-disc album</li>
		<li>TrackNum: track number</li>
		<li>SongTitle: title of the song</li>
	</ul>
</ol>

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
		�����echo "&lt;p&gt;$recordset-&gt;Name&lt;/p&gt;";<br/>
		}<br/>
	</code></blockquote>
{/literal}


<p>For a simple query, that code suffices. But if your pages include
	multiple queries, and each query requires complex joins, repeating that code
	can get messy.</p>

{literal}
<blockquote>
	Example 2-2-2<br/>
	<code><em>/*<br/>
			Connect to the server and choose the mymusic database<br/>
			*/</em><br/>

		$Conn = mysql_connect('your-mysql-host.com', 'mysql_login', 'mysql_password');<br/>
		mysql_select_db('mydatabase', $Conn);<br/>
		<br/>
		<em>/*<br/>
			Retrieve artist information for the band FooBar Fighters<br/>
			*/</em><br/>

		$query = "Select * From Artists Where Name='FooBar Fighters'";<br/>
		$result = mysql_query($query, $Conn);<br/>
		$recordset_artist = mysql_fetch_object($result);<br/>
		echo "&lt;p&gt;$recordset_artist-&gt;Name&lt;/p&gt;";<br/>
		<br/>
		<em>/*<br/>
			Retrieve albums by FooBar Fighters, with track info for each album<br/>
			*/</em><br/>

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
		����� [ ...display results... ]<br/>
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
		<em>/*<br/>
			Retrieve artist information for the band FooBar Fighters<br/>
			*/</em><br/>
		<br/>

		$recordset_artist = SelectRecord("Artists", "Name='FooBar Fighters'", "rs");<br/>
		echo "&lt;p&gt;$recordset_artist-&gt;Name&lt;/p&gt;";<br/>
		<br/>
		<em>/*<br/>
			Retrieve albums by FooBar Fighters, with track info for each album<br/>
			*/</em><br/>
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
		����� [ ...display results... ]<br/>
		}<br/>
		echo "&lt;/p&gt;";<br/>
	</code></blockquote>
{/literal}


<p>In Example x-x, the script first reads in Vigilante's
	libraries. A call to the function <code>SQL()</code>
	establishes a connection to the database.</p>

<p>In the first query, Vigilante pieces together a Select query
	with a specified table ("Artists") and a Where clause
	("Name='FooBar Fighters'"), then returns the result as an object. For
	Select queries, Vigilante can return results as a resource or as an object.</p>

<p>In the second query, Vigilante pieces together a more
	complex Select query and returns the result as a resource, which can then be
	used with <code>mysql_fetch_object()</code> to
	write the output.</p>


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


<p>In Example x-x, the data from the form is converted into an
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
	<li>Build an Update query.</li>
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


<p>Example x-x requires more code than it would need to perform
	the same tasks as Example x-x. You can, however, extend the <code>obj</code>
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
		�����$this-&gt;table = "Albums";<br/>
		�����$this-&gt;tableIndex = "AlbumID";<br/>
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
		�����[ ...display results... ]<br/>
		}<br/>
	</code></blockquote>
{/literal}



<h2>Parsing XML with Vigilante</h2>

<p>Vigilante parses XML with a class based on [whatever Amazon
	thing I used]. This class, simply named <code>xml</code>,
	handles almost every function required to parse XML <em>except</em> parser
	creation and the end element handler. You must first extend the <code>xml</code>
	class with your own custom class to include:</p>

<ol>
	<li>A constructor which sets the <code>$parser</code> property to create a parser.</li>
	<li>An end handler method.</li>
</ol>
<p>As an example, Vigilante includes a class named <code>rss</code>,
	which parses RSS feeds. Example x-x demonstrates how Vigilante that feed.</p>

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
		�����[ ...display RSS feed... ]<br/>
		}<br/>
	</code></blockquote>
{/literal}


<p>For more information on extending Vigilante's XML class, see
	Extending the xml class.</p>


<h2>Using the Smarty template engine</h2>

<p>Smarty is a fully featured template engine developed
	separately from Vigilante. To learn more about how to use Smarty, visit http://smarty.php.net/.</p>

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
	<li><code>index.tpl</code><br/>
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


<h1>Scripting with Vigilante</h1>


<h2>Reserved variables</h2>

<p>Vigilante uses the following variables and constants. Avoid
	assigning these variables in your own scripts. </p>

<p><code>$Conn</code><br/>
	Reference to a database connection.</p>

<p><code>$config</code><br/>
	Associative array of configuration values.</p>

<p><code>$smarty</code><br/>
	Name of Smarty object.</p>

<p><code>ENVIRONMENT</code><br/>
	Constant to determine development environment.</p>


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


<p>In Example x-x, the database connection is assigned to the
	reserved variable <code>$Conn</code>, and the Smarty
	object is assigned to the reserved variable <code>$smarty</code>.</p>


<h2>Setting up forms to use Vigilante</h2>

<p>The key to using Vigilante's database handling functions is
	to map the name of your HTML form fields with the fields in your database. You
	must use the exact syntax of your database field names on your forms.</p>

<p>In the tutorial database <code>mymusic</code>,
	the database field names use initial capital letters, such as ArtistID,
	SongTitle and LastName. In a MySQL installation of the content management
	system Movable Type (version 2.6.4), database fields use lowercase and
	underscores, such as mt_entry, mt_trackback, and mt_blog.</p>

<p>Example x-x shows an HTML form that collects various types
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


<p>Example x-x shows a script that processes the form in
	example x-x.</p>

{literal}
<blockquote>
	Example 3-3-2<br/>
	<code><em>// Make sure $do is set to "update_database".</em><br/>

		if ($do=="update_database")<br/>
		{<br/>
		<em>//Convert the form input into an associative array.</em><br/>
		�����$formData = AssignFormInputToArray();<br/>
		<br/>
		<em>//Retrieve the record from Albums to update ...</em><br/>
		�����$result_albums = SelectRecord("Albums", "AlbumID=$AlbumID", "row");<br/>
		<br/>
		<em>//... and update it.</em><br/>
		�����UpdateRecord($result_albums, 0, $formData, "Albums", "AlbumID=$AlbumID");<br/>
		<br/>
		<em>//Retrieve the record from mt_entry ...</em><br/>
		�����$result_mt = SelectRecord("mt_entry", "entry_id=$entry_id", "row");<br/>
		<br/>
		<em>//... and update it.</em><br/>
		�����UpdateRecord($result_mt, 0, $formData, "mt_entry", "entry_id=$entry_id);<br/>
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


<h2>Extending Vigilante</h2>

<p>To extend Vigilante's core libraries or to incorporate your
	own packages, save your packages in the <code>/includes/custom/</code>
	subdirectory, then call them as includes in <code>/includes/custom.php</code>.
	(<code>custom.php</code> is called into <code>common.php</code>,
	which is then called into every page using Vigilante.)</p>

<p>Example x-x is a sample function called <code>HelloWorld()</code>,
	which prints out a "Hello world" message.</p>

{literal}
<blockquote>
	Example 3-4-1<br/>
	<code>
		function HelloWorld()<br/>
		{<br/>
		�����echo "Hello, world!";<br/>
		}<br/>
	</code></blockquote>
{/literal}


<p>The function is saved in a file named <code>more_functions.php</code>
	in the <code>/includes/custom/</code>
	subdirectory. To make this function available through Vigilante, an include
	line is added to <code>/includes/custom.php</code>,
	reading in <code>more_functions.php</code>.</p>

{literal}
<blockquote>
	Example 3-4-2<br/>
	<code>
		include($config['include_custom_path'] . "more_functions.php");<br/>
	</code></blockquote>
{/literal}



<h2>Extending the xml class</h2>

<p>The purpose of Vigilante's <code>xml</code>
	class is to parse XML data for display on a web page.</p>

<p>A significant portion of the class happens in the <em>end
		handler function</em>, the function triggered when PHP's expat parser encounters
	a closing XML tag. To allow for customization, the end handler function is not
	included in the <code>xml</code> class. Instead, you
	must extend the class and provide your own. Vigilante includes an extension to
	parse RSS files, which you can use as a model for your own extensions.</p>

<p>TIP Save your extensions in the /includes/custom/ folder,
	and call them through the custom.php include.</p>

<p>Example x-x shows the basic structure of the provided end
	handler.</p>

{literal}
<blockquote>
	Example 3-5-1<br/>
	<code>

		function endHandler($parser, $sTag)<br/>
		{<br/>
		<em>//Initialize an array key.</em><br/>
		<em>//Make it static so the value is saved upon exit of the method.</em><br/>
		�����static $k;<br/>
		<br/>
		<em>//If array key is not set, initialize it to 0.</em><br/>
		�����if (!isset($k)) {$k=0;}<br/>
		<br/>
		<em>//Assign $sData property to a buffer.</em><br/>
		�����$sData = $this-&gt;sData;<br/>
		<br/>
		<em>//Assign XML data to an associative array.</em><br/>
		<em>//Save the XML tag name as an array key, indexed by the static numeric key.</em><br/>
		�����switch (strtoupper ($sTag))<br/>
		�����{<br/>
		<em>//One of the XML tags should be used to iterate the numeric key.</em><br/>
		����������case "ENDTAG01":<br/>
		���������������$this-&gt;sOut['EndTag01'][] = $k;<br/>
		���������������$k++;<br/>
		���������������break;<br/>
		����������case "ENDTAG02":<br/>
		���������������$this-&gt;sOut[$key]['EndTag02'] = $sData;<br/>
		���������������break;<br/>
		����������[. . .   more cases with end tags   . . .]<br/>
		�����}<br/>
		}
	</code></blockquote>
{/literal}


<p>To use this end handler function in your own extensions,
	simply create a <code>case</code> statement within the
	<code>switch (strtoupper($sTag))</code> statement for each
	end tag used in the XML file. Assign the property containing character data (<code>$this-&gt;sTag</code>)
	to a two-dimensional associative array with one index as an identifier, the
	other to store the tag name. One of the end tags will need to iterate a counter
	that indexes the array.</p>

<p>After the <code>xml</code> class
	successfully parses the file, you can use the resulting output object (in the
	above example, <code>$this-&gt;sOut</code>) to
	display the data.</p>

{literal}
<blockquote>
	Example 3-5-2<br/>
	<code>
		&lt;?=$xml-&gt;sOut[0]["EndTag02"];?&gt;&lt;br&gt;<br/>
		&lt;?=$xml-&gt;sOut[1]["EndTag02"];?&gt;&lt;br&gt;<br/>
		&lt;?=$xml-&gt;sOut[2]["EndTag02"];?&gt;&lt;br&gt;<br/>
	</code></blockquote>
{/literal}


<h1>Function Reference</h1>


<h2>core.php</h2>

<h3>CatchError</h3>

<h4>Usage:</h4>

<p><code>void CatchError(string <em>message</em>);</code></p>

<h4>Description:</h4>

<p><code>CatchError()</code> prints out
	the error output <em>message</em> with a color specified by <code>$config['catch_error_color']</code>.
	Use this function to provide feedback regarding form handling.</p>

{literal}
<blockquote>
	Example 4-1-1<br/>
	<code>

		if ($result)<br/>
		{<br/>
		�����$error = 'Could not perform task.';<br/>
		}<br/>
		<br/>

		echo "&lt;p&gt;" . CatchError($error) . "&lt;/p&gt;";<br/>
	</code></blockquote>
{/literal}


<h3>CatchMessage</h3>

<h4>Usage:</h4>

<p><code>void CatchMessage(string <em>message</em>);</code></p>

<h4>Description:</h4>

<p><code>CatchMessage()</code> prints out
	the non-error output <em>message</em> with a color specified by <code>$config['catch_message_color']</code>.
	Use this function to provide feedback regarding form handling.</p>

{literal}
<blockquote>
	Example 4-1-2<br/>
	<code>

		if ($result)<br/>
		{<br/>
		�����$msg = 'Task successful!';<br/>
		}<br/>
		<br/>

		echo "&lt;p&gt;" . CatchMessage($msg) . "&lt;/p&gt;";<br/>
	</code></blockquote>
{/literal}


<h3>DebugTrace</h3>

<h4>Usage:</h4>

<p><code>void DebugTrace(string <em>message</em>);</code></p>

<h4>Description:</h4>

<p><code>DebugTrace()</code> prints out
	the debug <em>message</em> with a color specified by <code>$config['debug_trace_color']</code>.
	Use this function to output results of scripts, but make sure these statements
	are commented out or deleted in your final code.</p>


<h2>layout.php</h2>

<h3>Smarty</h3>

<h4>Usage:</h4>



void Smarty(void);<br/>
<h4>Description:</h4>

<p><code>Smarty()</code> initializes a
	Smarty object, sets the paths to its libraries and configuration files, creates
	a Smarty object with the reserved variable <code>$smarty</code>,
	and makes <code>$config</code> available to
	Smarty templates. A page needs only one <code>Smarty()</code>
	call, best placed at the top under the include to <code>common.php</code>
	and a call to <code>SQL()</code>.</p>


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


<h2>sql.php</h2>

<h3>AddRecord</h3>

<h3>BuildFormData</h3>

<h3>BuildUpdateQuery</h3>

<h3>BuildInsertQuery</h3>

<h3>BuildDeleteQuery</h3>

<h3>BuildUpdateData</h3>

<h3>BuildInsertData</h3>

<h3>CatchMySQLError</h3>

<h3>CheckForTextField</h3>

<h3>DeleteRecord</h3>

<h3>ExecuteQuery</h3>

<h3>FetchRowObject</h3>

<h3>ProcessSQLLikeString</h3>

<h3>GetTableFieldNames</h3>

<h3>ProcessSQLString</h3>

<h3>RunSelectQuery</h3>

<h3>SelectRecord</h3>

<h3>SelectAllRecords</h3>

<h3>SelectJoinedRecords</h3>

<h3>SQL</h3>

<h3>UpdateRecord</h3>


<h2>xml.php</h2>

<h3>xml::parse</h3>

<h3>xml::startHandler</h3>

<h3>xml::cdataHandler</h3>

<h3>xml::setInputUrl</h3>

<h3>xml::setInputFile</h3>

<h3><em>classname</em>::endHandler</h3>

<h3><em>classname</em>::classname</h3>

