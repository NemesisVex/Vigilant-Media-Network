<h1>Scripting with Vigilante</h1>

<h2>Extending Vigilante</h2>

<p>To extend Vigilante's core libraries or to incorporate your
own packages, save your packages in the <code>/includes/custom/</code>
subdirectory, then call them as includes in <code>/includes/custom.php</code>.
(<code>custom.php</code> is called into <code>common.php</code>,
which is then called into every page using Vigilante.)</p>

<p>Example 3-4-1 is a sample function called <code>HelloWorld()</code>,
which prints out a "Hello world" message.</p>

{literal}
<blockquote>
Example 3-4-1<br/>
<code>
function HelloWorld()<br/>
{<br/>
     echo "Hello, world!";<br/>
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
