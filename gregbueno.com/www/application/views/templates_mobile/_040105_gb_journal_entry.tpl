<div style="text-align: center">
<p class="normal"><span style="font-size: smaller;">
{if $rsNext}<a href="/index.php/journal/entry/{$rsNext->entry_id}/" title="{$rsNext->entry_excerpt|escape:"html"}">NEXT</a>{else}NEXT{/if} |
{if $rsPrevious}<a href="/index.php/journal/entry/{$rsPrevious->entry_id}/" title="{$rsPrevious->entry_excerpt|escape:"html"}">PREVIOUS</a>{else}PREVIOUS{/if}
<br>
</span></p>
</div>

<hr size="1" width="50%">

<p class="normal"><tt>{$rsEntry->entry_created_on|date_format:"%A, %y-%b-%d %I:%M %r"}</tt></p>

{if $rsEntry->entry_text}
{eval_entry txt=$rsEntry->entry_text}
{else}
<p>No journal entry yet written.</p>
{/if}

<p><br/></p>

<div style="text-align: center">
<span style="font-size: smaller;">
<p class="normal">
{if $rsNext}<a href="/index.php/journal/entry/{$rsNext->entry_id}/" title="{$rsNext->entry_excerpt|escape:"html"}">NEXT</a>{else}NEXT{/if} |
{if $rsPrevious}<a href="/index.php/journal/entry/{$rsPrevious->entry_id}/" title="{$rsPrevious->entry_excerpt|escape:"html"}">PREVIOUS</a>{else}PREVIOUS{/if} |
<a href="/index.php/journal/entry/random/">RANDOM</a><br>
{if $rsPastEntries}
ON THIS DAY IN:
{foreach item=rsPastEntry from=$rsPastEntries name="past"}
<a href="/index.php/journal/entry/{$rsPastEntry->entry_id}/">{$rsPastEntry->entry_created_on|date_format:"%Y"}</a>
{if $smarty.foreach.past.last == false} &#8226; {/if}
{/foreach}
{/if}<br>
<a href="/index.php/journal/">&#26085;&#12293;&#12398;&#26412;</a> | <a href="/index.php/meisakuki/">&#21517;&#20316;&#35352;</a> | <a href="/index.php/sakufu/">&#20316;&#35676;</a></p>
</span>
</div>
