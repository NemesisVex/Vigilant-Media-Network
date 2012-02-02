<h1>Function Reference</h1>

<h2>sql.php</h2>

<h3>AddRecord</h3> 

<p><em>Usage:</em></p>

<p>
<tt>string&nbsp;AddRecord(array&nbsp;input,&nbsp;string&nbsp;table,&nbsp;string&nbsp;extra&nbsp;fields,&nbsp;string&nbsp;extra&nbsp;values)</tt> 
</p>
<p>
<em>Description:</em> 
</p>
<p>
<tt>AddRecord()</tt> writes a single record to a database. 
</p>
<p>
When a user submits a form, the form data must first be turned into an associative array with <tt>AssignFormInputToArray()</tt>. <tt>AddRecord()</tt> then queries <em>table</em> for an array of fields. The function pieces together an <tt>Insert</tt> query using only those fields with submitted data. After the query is executed, the function returns the newly created index. 

</p>
<p>
Assign <tt>AddRecord()</tt> to a string if you wish to capture the returned index. The function will still work with no string assignment. 
</p>
<p>
Although <em>extra fields</em> and <em>extra values</em> allow writing to fields not specified in the form input, it's easier to keep these arguments unassigned and to append additional fields and values to the <em>input</em> array. 

</p>
<p>
<em>extra fields</em> and <em>extra values</em> both require a leading comma before listing the appended strings, and both strings must list fields and values in parallel order. 
</p>
<p>
The following syntax produces the same result. 
</p>

<pre>$newID = AddRecord($form_input, $table_name, ", Field1, Field2", ", $Value1, $Value2";

$form_input["Field1"] = $Value1;
$form_input["Field2"] = $Value2;
$newID = AddRecord($form_input, $table_name, '', '');
</pre><p>

<h3>BuildDeleteQuery</h3> 

</p>
<p>
<em>Usage:</em> 
</p>
<p>
<tt>string&nbsp;BuildDeleteQuery(string&nbsp;table,&nbsp;string&nbsp;condition)</tt> 
</p>
<p>
<em>Description:</em> 
</p>

<p>
<tt>BuildDeleteQuery()</tt> returns a deletion query strung together from the specified <em>table</em> and <em>condition</em>. This function is called from <tt>DeleteQuery()</tt>, which executes the actual deletion of a record. 
</p>
<p>
<h3>BuildFormData</h3> 
</p>
<p>

<em>Usage:</em> 
</p>
<p>
<tt>array&nbsp;BuildFormData(string&nbsp;table,&nbsp;array&nbsp;input)</tt> 
</p>
<p>
<em>Description:</em> 
</p>
<p>
<tt>BuildFormData()</tt> maps an associative array of fields and values (<em>input</em>) to the fields of a database table (<em>table</em>). This function extracts values from <em>input</em> that are directly related to a database query, and it ignores any form field that does not exist in <em>table</em>. 

</p>
<p>
This function is rarely used and may be deprecated the future. 
</p>
<p>
<h3>BuildInsertData</h3> 
</p>
<p>
<em>Usage:</em> 
</p>
<p>
<tt>array&nbsp;BuildInsertData(array&nbsp;input,&nbsp;string&nbsp;table)</tt> 

</p>
<p>
<em>Description:</em> 
</p>
<p>
<tt>BuildInsertData()</tt> compares fields of a database table with input submitted through a form to determine which fields to fill when inserting a new record. The function then returns an associative array with fields containing new values. 
</p>
<p>
The function queries the database for a single record, cycles through each field in that record, and matches it with a parallel cell in <em>input</em>. 
</p>
<p>
<h3>BuildInsertQuery</h3> 

</p>
<p>
<em>Usage:</em> 
</p>
<p>
<tt>string&nbsp;BuildInsertQuery(string&nbsp;table,&nbsp;string&nbsp;fields,&nbsp;string&nbsp;values)</tt> 
</p>
<p>
<em>Description:</em> 

</p>
<p>
<tt>BuildInsertQuery()</tt> pieces together a query statement to insert a record into a database. <em>fields</em> and <em>values</em> are comma-delimited strings. Each value listed in <em>values</em> must be parallel to its corresponding field in <em>fields</em>. 
</p>

<p>
This function is used in conjunction <tt>AddRecord()</tt> and is rarely used outside of it. 
</p>
<p>
<h3>BuildUpdateData</h3> 
</p>
<p>
<em>Usage:</em> 
</p>
<p>
<tt>array&nbsp;BuildUpdateData(resource&nbsp;result,&nbsp;int&nbsp;row,&nbsp;array&nbsp;input)</tt> 

</p>
<p>
<em>Description:</em> 
</p>
<p>
<tt>BuildUpdateData()</tt> compares a record stored in database with input submitted through a form to determine which fields to update. The function then returns an associative array with fields containing new values. 
</p>
<p>
The function cycles through each field in <em>result</em>, retrieves its parallel cell in <em>input</em> and compares the values with each other. If the new value is different from the current value, the field-value pair is saved to a new associative array. Empty strings are assigned null values, if the database field allows for it. 

</p>
<p>
This function is used in conjunction with <tt>UpdateRecord()</tt> and is rarely used outside of it. 
</p>
<p>
<h3>BuildUpdateQuery</h3> 
</p>
<p>
<em>Usage:</em> 
</p>
<p>
<tt>string&nbsp;BuildUpdateQuery(string&nbsp;table,&nbsp;array&nbsp;data,&nbsp;string&nbsp;condition)</tt> 

</p>
<p>
<em>Description:</em> 
</p>
<p>
<tt>BuildUpdateQuery()</tt> pieces together a query statement to update a single database record. The function cycles through each field in <em>data</em> and concatenates a string of assignments, placed after <tt>Set</tt> in the query statement. If set, <em>condition</em> is appended to the statement. 

</p>
<p>
This function is used in conjunction with <tt>UpdateRecord()</tt> and is rarely used outside of it. 
</p>
<p>
<h3>CatchMySQLError</h3> 
</p>
<p>
<em>Usage:</em> 
</p>
<p>
<tt>void&nbsp;CatchMySQLError()</tt> 

</p>
<p>
<em>Description:</em> 
</p>
<p>
<tt>CatchMySQLError()</tt> prints <tt>mysql_error()</tt> using <tt>DebugTrace()</tt> only when an error is available. This function is particularly useful when debugging errors. 
</p>

<p>
<h3>CheckForTextField</h3> 
</p>
<p>
<em>Usage:</em> 
</p>
<p>
<tt>boolean&nbsp;CheckForTextField(string&nbsp;field&nbsp;type)</tt> 
</p>
<p>
<em>Description:</em> 
</p>
<p>

<tt>CheckForTextField()</tt> determines whether a string needs to be use MySQL escape quotes. PHP, for some reason, does not use the same terminology as MySQL when naming types of fields. <tt>String</tt>, <tt>blob</tt>, <tt>date</tt> and <tt>datetime</tt> types all require escaped quotes. Other fields types do not. 
</p>
<p>
This function is used in conjunction with <tt>mysql_field_type()</tt>. When you pass the value from <tt>mysql_field_type()</tt> to <tt>CheckForTextField()</tt>, the function returns a boolean to indicate whether escape quotes are required. 

</p>
<p>
<tt>CheckForTextField()</tt> is used in <tt>AddRecord()</tt> and <tt>UpdateRecord()</tt> and are rarely used outside of those functions. 
</p>
<p>
<h3>DeleteRecord</h3> 
</p>
<p>

<em>Usage:</em> 
</p>
<p>
<tt>void&nbsp;DeleteRecord(string&nbsp;table,&nbsp;string&nbsp;condition)</tt> 
</p>
<p>
<em>Description:</em> 
</p>
<p>
<tt>DeleteRecord()</tt> deletes records from a database. Specify a <tt>condition</tt> to delete a specific record or set of records. 

</p>
<p>
<h3>ExecuteQuery</h3> 
</p>
<p>
<em>Usage:</em> 
</p>
<p>
<tt>void&nbsp;ExecuteQuery(string&nbsp;query)</tt> 
</p>
<p>
<em>Description:</em> 

</p>
<p>
<tt>ExecuteQuery</tt> runs a database query. It serves as alias to <tt>mysql_query()</tt>. 
</p>
<p>
<h3>FetchRowObject</h3> 
</p>
<p>
<em>Usage:</em> 
</p>
<p>

<tt>object&nbsp;FetchRowObject(resource&nbsp;result)</tt> 
</p>
<p>
<em>Description:</em> 
</p>
<p>
<tt>FetchRowObject()</tt> fetches a row from a database query and returns the results as an object. It serves as an alias to <tt>mysql_fetch_object()</tt>. 
</p>
<p>

<h3>GetTableFieldNames</h3> 
</p>
<p>
<em>Usage:</em> 
</p>
<p>
<tt>array&nbsp;GetTableFieldNames(string&nbsp;table)</tt> 
</p>
<p>
<em>Description:</em> 
</p>

<p>
<tt>GetTableFieldNames</tt> queries the database <em>table</em> for a single record, then cycles through each field to create an associative array, assigning the field's type with the field's name serving as the array's key.
</p>
<p>
This function is used in conjunction with <tt>AddRecord()</tt> and is rarely used outside of it.
</p>
<p>
<h3>ProcessSQLLikeString</h3> 
</p>
<p>
<em>Usage:</em> 
</p>
<p>
<tt>string&nbsp;ProcessSQLLikeString(string&nbsp;data,&nbsp;string&nbsp;prefix,&nbsp;string&nbsp;suffix)</tt> 
</p>

<p>
<em>Description:</em> 
</p>
<p>
<tt>ProcessSQLLikeString()</tt> performs the same string handling functions as <tt>ProcessSQLString</tt> but concatenates <em>prefix</em> or <em>suffix</em> wildcards to <tt>Like</tt> clauses in queries.
</p>
<p>
<h3>ProcessSQLString</h3> 
</p>
<p>
<em>Usage:</em> 
</p>
<p>
<tt>string&nbsp;ProcessSQLString(string&nbsp;data)</tt> 

</p>
<p>
<em>Description:</em> 
</p>
<p>
<tt>ProcessSQLString()</tt> prepares strings for SQL queries by striping PHP slashes and escaping single quotes.
</p>
<p>
<h3>RunSelectQuery</h3> 
</p>
<p>
<em>Usage:</em> 
</p>
<p>

<tt>mixed&nbsp;RunSelectQuery(string&nbsp;query,&nbsp;string&nbsp;resource type)</tt> 
</p>
<p>
<em>Description:</em> 
</p>
<p>
<tt>RunSelectQuery()</tt> executes <em>query</em> and returns either a resource or an object, depending upon <em>resource type</em>, which accepts the following settings: 
</p>
<ul>
<li> <tt>"row"</tt> &#8212; Returns a resource.</li>
<li> <tt>"rs"</tt> &#8212; Returns the database result with <tt>mysql_fetch_object()</tt>.</li>
</ul>
<p>
This function is originally intended to run complex <tt>Select</tt> queries, but it may also run <tt>Update</tt> and <tt>Delete</tt> queries. You will still need to set <em>resource type</em>, even though it will be ignored for non-<tt>Select</tt> queries.
</p>
<p>
<h3>SelectRecord</h3> 
</p>
<p>

<em>Usage:</em> 
</p>
<p>
<tt>mixed&nbsp;SelectRecord(string&nbsp;query,&nbsp;string&nbsp;where&nbsp;clause,&nbsp;string&nbsp;resource&nbsp;type)</tt> 
</p>
<p>
<em>Description:</em> 
</p>
<p>
<tt>SelectRecord()</tt> executes a <tt>Select</tt> query on <em>table</em> with the clause <em>where</em> and returns a resource or object, depending upon <em>resource type</em>:
</p>
<ul>
<li> <tt>"row"</tt> &#8212; Returns a resource.</li>
<li> <tt>"rs"</tt> &#8212; Returns the database result with <tt>mysql_fetch_object()</tt>.</li>
</ul>

<p>CAUTION: <tt>SelectRecord()</tt> executes a query with an asterisk(*). This function does not support querying for specific fields. Use <tt>RunSelectQuery</tt> instead.</p>

<p>CAUTION: Omit the word "Where" in your clause. The function provides it already.</p>

<p>

<h3>SelectAllRecords</h3> 
</p>
<p>
<em>Usage:</em> 
</p>
<p>
<tt>mixed&nbsp;SelectAllRecords(string&nbsp;table,&nbsp;string&nbsp;condition,&nbsp;string&nbsp;resource&nbsp;type)</tt> 
</p>
<p>
<em>Description:</em> 
</p>

<p>
<tt>SelectAllRecords()</tt> returns all records in <em>table</em> as either a resource or object, depending upon <em>resource type</em>:
<ul>
<li> <tt>"row"</tt> &#8212; Returns a resource.</li>
<li> <tt>"rs"</tt> &#8212; Returns the database result with <tt>mysql_fetch_object()</tt>.</li>
</ul>

<p>You may use <em>condition</em> to specify an <tt>Order</tt> clause.</p>

<p>
<h3>SelectJoinedRecords</h3> 
</p>
<p>
<em>Usage:</em> 
</p>
<p>
<tt>mixed&nbsp;SelectJoinedRecords(string&nbsp;table,&nbsp;string&nbsp;dataset,&nbsp;string&nbsp;condition,&nbsp;string&nbsp;resource type)</tt> 
</p>

<p>
<em>Description:</em> 
</p>
<p>
<tt>SelectJoinedRecords()</tt> pieces together a <tt>Select</tt> query on <em>table</em>, retrieving <em>dataset</em> with the clause <em>condition</em>. The function returns a resource or an object, depending upon <em>resource type</em>:
</p>
<ul>
<li> <tt>"row"</tt> &#8212; Returns a resource.</li>
<li> <tt>"rs"</tt> &#8212; Returns the database result with <tt>mysql_fetch_object()</tt>.</li>
</ul>
<p>
<h3>SQLConnect</h3> 
</p>
<p>
<em>Usage:</em> 
</p>
<p>
<tt>resource&nbsp;SQLConnect(string&nbsp;host,&nbsp;string&nbsp;user,&nbsp;string&nbsp;password,&nbsp;string&nbsp;databse)</tt> 

</p>
<p>
<em>Description:</em> 
</p>
<p>
<tt>SQLConnect()</tt> connects to the databse <em>host</em> with the login <em>user</em> and <em>password</em> and selects <em>database</em>.
</p>
<p>
<h3>UpdateRecord</h3> 
</p>
<p>
<em>Usage:</em> 
</p>
<p>

<tt>void&nbsp;UpdateRecord(resource&nbsp;query&nbsp;result,&nbsp;int&nbsp;result&nbsp;offset,&nbsp;array&nbsp;data,&nbsp;string&nbsp;table,&nbsp;string&nbsp;condition)</tt> 
</p>
<p>
<em>Description:</em> 
</p>
<p>
<tt>UpdateRecord()</tt> updates a single record in a databse.
</p>
<p>
When a user submits a form, the form data must first be turned into an associative array with <tt>AssignFormInputToArray()</tt>. <tt>UpdateRecord()</tt> then queries <em>table</em> for an existing record found with <em>condition</em>. The function compares the form data with the retrieved recordset and pieces together an <tt>Update</tt> query using only those fields with changed data. 
</p>
