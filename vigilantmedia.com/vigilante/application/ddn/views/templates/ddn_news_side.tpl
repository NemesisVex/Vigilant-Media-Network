{if $rsDates}
<h3>Past news</h3>

{foreach item=rsDate from=$rsDates}
<a href="/index.php/news/archives/{$rsDate->entry_month}/{$rsDate->entry_year}/">{$rsDate->entry_date|date_format:"%b. %Y"}</a><br/>
{/foreach}

{/if}
