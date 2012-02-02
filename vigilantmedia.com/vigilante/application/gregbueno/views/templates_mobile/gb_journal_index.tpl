<code>{$rsEntry->entry_created_on|date_format:"%A.%Y.%m.%d.%H:%M"}</code>
<hr />

{if $rsEntry->entry_text}{eval_entry txt=$rsEntry->entry_text}{/if}

<hr />

<div class="BottomEntryNavLeft">
	<nav>
{write_nav_entry_link date_str=$rsEntry->entry_created_on direct="next" path="/entry/XXXXXX/" blog_id=$config.blog_id} &#8226;
{write_nav_entry_link date_str=$rsEntry->entry_created_on direct="prev" path="/entry/XXXXXX/" blog_id=$config.blog_id} &#8226;
		<a href="/entry/random/">RANDOM</a><br />
{write_yesteryear_links date_str=$rsEntry->entry_created_on path="/entry/XXXXXX/" blog_id=$config.blog_id}<br />
	</nav>
</div>

{if $rsEntry->entry_allow_comments==1}
<div class="BottomEntryNavRight">
	<a href="/entry/{$rsEntry->entry_id}/comments/">COMMENTS</a> ({get_num_comments id=$rsEntry->entry_id})<br />
</div>
{/if}
<br />

<p><span class="smaller">Partially powered by <a href="http://www.movabletype.org/">Movable Type 5</a></span></p>

