{if $rsNews}
{if $rsNews->entry_text}
{parse_line_breaks txt=$rsNews->entry_text}

{if $rsNews->entry_text_more}
{parse_line_breaks txt=$rsNews->entry_text_more}
{/if}

<p><span class="smaller"><em>-- Posted: {$rsNews->entry_created_on|date_format:"%Y-%m-%d %H:%M:%S"}</em></span></p>
{/if}
{/if}
