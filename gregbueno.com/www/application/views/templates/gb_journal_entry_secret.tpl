<code>{$rsEntry->entry_created_on|date_format:"%A.%Y.%m.%d.%H:%M"} (secret)</code>

<hr />
{if $rsEntry->entry_text_more}
{eval_entry txt=$rsEntry->entry_text_more}
{/if}
