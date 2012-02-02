<h1>Function Reference</h1>

<h3>Smarty</h3>

<h4>Usage:</h4>

void Smarty(void);<br/>
<h4>Description:</h4><p><code>Smarty()</code> initializes a
Smarty object, sets the paths to its libraries and configuration files, creates
a Smarty object with the reserved variable <code>$smarty</code>,
and makes <code>$config</code> available to
Smarty templates. A page needs only one <code>Smarty()</code>
call, best placed at the top under the include to <code>common.php</code>
and a call to <code>SQL()</code>.</p>

