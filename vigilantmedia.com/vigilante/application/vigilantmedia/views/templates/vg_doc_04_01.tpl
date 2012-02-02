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
     $error = 'Could not perform task.';<br/>
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
     $msg = 'Task successful!';<br/>
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

