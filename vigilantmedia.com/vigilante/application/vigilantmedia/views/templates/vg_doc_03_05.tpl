<h1>Scripting with Vigilante</h1>

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

<p>Example 3-5-1 shows the basic structure of the provided end
handler.</p>

{literal}
<blockquote>
Example 3-5-1<br/>
<code>

function endHandler($parser, $sTag)<br/>
{<br/>
<em>//Initialize an array key.</em><br/>
<em>//Make it static so the value is saved upon exit of the method.</em><br/>
     static $k;<br/>
<br/>
<em>//If array key is not set, initialize it to 0.</em><br/>
     if (!isset($k)) {$k=0;}<br/>
<br/>
<em>//Assign $sData property to a buffer.</em><br/>
     $sData = $this-&gt;sData;<br/>
<br/>
<em>//Assign XML data to an associative array.</em><br/>
<em>//Save the XML tag name as an array key, indexed by the static numeric key.</em><br/>
     switch (strtoupper ($sTag))<br/>
     {<br/>
<em>//One of the XML tags should be used to iterate the numeric key.</em><br/>
          case "ENDTAG01":<br/>
               $this-&gt;sOut['EndTag01'][] = $k;<br/>
               $k++;<br/>
               break;<br/>
          case "ENDTAG02":<br/>
               $this-&gt;sOut[$key]['EndTag02'] = $sData;<br/>
               break;<br/>
          [. . .   more cases with end tags   . . .]<br/>
     }<br/>
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

