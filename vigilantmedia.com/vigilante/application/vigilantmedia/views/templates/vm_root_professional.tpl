<aside id="frame-1" class="span-6 prepend-1 append-1 prepend-top">
	<h3>R&eacute;sum&eacute;</h3>

	<p>To see recommendations from co-workers, please also visit <a href="http://www.linkedin.com/pub/greg-bueno/3/3a3/a98">my LinkedIn profile</a>.</p>

	<p>Download: <a href="/content/greg_bueno_resumex.pdf"><img src="/images/pdf.gif" title="[PDF]" alt="[PDF]" width="16" height="16" border="0"></a></p>

</aside>

<section id="frame-2" class="span-14 prepend-top box last">
{if $summary}
	<h2>Summary</h2>

	<hr />

{foreach item=summary_list from=$summary[0]}
{if $summary_list.type}
	<p>
		<em>{$summary_list.type}</em>
	</p>
{/if}
	<ul class="resume-summary-list">
{foreach name=list_items item=item from=$summary_list->items[0]}
		<li>{$item}</li>
{/foreach}
	</ul>
{/foreach}


{/if}

{if $skills}
	<h2>Skills</h2>

	<hr />

{foreach item=skill_list from=$skills[0]}
	<p>
		<em>{$skill_list.type}</em><br>
{foreach name=list_items item=skill from=$skill_list->skills[0]}
{$skill}{if $smarty.foreach.list_items.last==false}, {/if}
{/foreach}
	</p>
{/foreach}

{/if}

{if $professional}
	<h2>Professional experience</h2>

	<hr />

{foreach key=i item=pro from=$professional[0]}
	<p><strong>{$pro->title}</strong><br>
{$pro->company}<br>
{$pro->location}<br>
		<em>{$pro->dates}</em><br>
	</p>
	<ul class="resume-duty">
{foreach item=duty from=$pro->duties[0]}
		<li>{$duty}</li>
{/foreach}
	</ul>
{/foreach}
{/if}

{if $projects}
	<h2>Side Projects</h2>

	<hr />

{foreach key=i item=project from=$projects[0]}
	<p><strong>{$project->title}</strong><br>
{$project->company}<br>
{$project->location}<br>
		<em>{$project->dates}</em><br>
	</p>

	<ul class="resume-duty">
{foreach item=duty from=$project->duties[0]}
		<li> {$duty}</li>
{/foreach}
	</ul>
{/foreach}
{/if}

{if $miscellaneous}
	<h2>Miscellaneous experience</h2>

	<hr />

{foreach key=i item=misc from=$miscellaneous[0]}
	<p><strong>{$misc->title}</strong><br>
{$misc->company}<br>
{$misc->location}<br>
		<em>{$misc->dates}</em><br>
	</p>
	<ul class="resume-duty">
{foreach item=duty from=$misc->duties[0]}
		<li> {$duty}</li>
{/foreach}
	</ul>
{/foreach}
{/if}

{if $education}
	<h2>Education</h2>

	<hr />

{foreach item=ed from=$education[0]}
	<p><strong>{$ed->school}</strong><br>
{$ed->degree}<br>
{$ed->location}<br>
		<em>{$ed->dates}</em><br>
	</p>
{/foreach}
{/if}

{if $awards}
	<h2>Awards</h2>

	<hr />

{foreach item=award from=$awards[0]}
	<p><strong>{$award->honor}</strong><br>
{$award->contest}<br>
	</p>
{/foreach}
{/if}
</section>
