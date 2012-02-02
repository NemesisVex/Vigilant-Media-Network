<h1>Getting Started</h1>

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
