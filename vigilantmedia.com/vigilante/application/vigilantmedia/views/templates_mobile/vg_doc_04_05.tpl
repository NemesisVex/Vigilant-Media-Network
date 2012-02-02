<h1>Function Reference</h1>

<h2>xml.php</h2><h3>xml::parse</h3>
<p>
<em>Usage:</em> 
</p>
<p>
<code>void object->parse()</code> 
</p>
<p>
<em>Description:</em> 
</p>

<p>After establishing a file pointer resource with <em>setInputFile</em> or <em>setInputUrl</em>, call <code>parse()</code> to begin XML parsing. The function reads in the file and executes PHP's XML parsing functions.</p>

<h3>xml::setInputUrl</h3>
<p>
<em>Usage:</em> 
</p>
<p>
<code>void object->setInputUrl(string <em>url</em>)</code> 
</p>
<p>
<em>Description:</em> 
</p>

<p><code>setInputFile</code> prepares a file pointer resource for <em>url</em>, which will be read when <em>parse</em> is called.</p>

<h3>xml::setInputFile</h3>
<p>
<em>Usage:</em> 
</p>
<p>
<code>void object->setInputFile(string <em>file path</em>)</code> 
</p>
<p>
<em>Description:</em> 
</p>
<p><code>setInputFile</code> prepares a file pointer resource for <em>file path</em>, which will be read when <em>parse</em> is called.</p>

