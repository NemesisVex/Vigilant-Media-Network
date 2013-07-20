			<div class="container">
				<header>
					<h1>Résumé</h1>
				</header>

				<p><a href="/content/greg_bueno_resumex.pdf" class="button"><img src="{$smarty.const.VIGILANTMEDIA_CDN_BASE_URI}/web/images/icons/down-blue.gif" /> Download</a></p>

				{if $summary}
				<div class="resume-column-1">
					<h2>Summary</h2>
				</div>

				<div class="resume-column-2">
				{foreach item=summary_list from=$summary[0]}
					{if $summary_list.type}
					<h4>{$summary_list.type}</h4>
					{/if}
					<ul class="resume-summary-list">
					{foreach name=list_items item=item from=$summary_list->items[0]}
						<li>{$item}</li>
					{/foreach}
					</ul>
				{/foreach}
				</div>

				{/if}

				{if $skills}
				<div class="resume-column-1">
					<h2>Skills</h2>
				</div>

				<div class="resume-column-2">
				{foreach item=skill_list from=$skills[0]}
					<p>
						<em>{$skill_list.type}</em><br />
				{foreach name=list_items item=skill from=$skill_list->skills[0]}
				{$skill}{if $smarty.foreach.list_items.last==false}, {/if}
				{/foreach}
					</p>
				{/foreach}
				</div>
				{/if}

				{if $professional}
				<div class="resume-column-1">
					<h2>Professional experience</h2>
				</div>

				<div class="resume-column-2">
				{foreach key=i item=pro from=$professional[0]}
					<h4>{$pro->title}</h4>

					<ul class="company-info">
						<li>{$pro->company}</li>
						<li>{$pro->location}</li>
						<li><em>{$pro->dates}</em></li>
					</ul>

					<ul class="resume-duty">
				{foreach item=duty from=$pro->duties[0]}
						<li>{$duty}</li>
				{/foreach}
					</ul>
				{/foreach}
				</div>
				{/if}

				{if $projects}
				<div class="resume-column-1">
					<h2>Side Projects</h2>
				</div>

				<div class="resume-column-2">
				{foreach key=i item=project from=$projects[0]}
					<h4>{$project->title}</h4>

					<ul class="company-info">
						<li>{$project->company}</li>
						<li>{$project->location}</li>
						<li><em>{$project->dates}</em></li>
					</ul>

					<ul class="resume-duty">
				{foreach item=duty from=$project->duties[0]}
						<li> {$duty}</li>
				{/foreach}
					</ul>
				{/foreach}
				</div>
				{/if}

				{if $miscellaneous}
				<div class="resume-column-1">
					<h2>Miscellaneous experience</h2>
				</div>

				<div class="resume-column-2">
				{foreach key=i item=misc from=$miscellaneous[0]}
					<h4>{$misc->title}</h4>

					<ul class="company-info">
						<li>{$misc->company}</li>
						<li>{$misc->location}</li>
						<li><em>{$misc->dates}</em></li>
					</ul>

					<ul class="resume-duty">
				{foreach item=duty from=$misc->duties[0]}
						<li> {$duty}</li>
				{/foreach}
					</ul>
				{/foreach}
				</div>
				{/if}

				{if $education}
				<div class="resume-column-1">
					<h2>Education</h2>
				</div>

				<div class="resume-column-2">
				{foreach item=ed from=$education[0]}
					<h4>{$ed->school}</h4>

					<ul class="company-info">
						<li>{$ed->degree}</li>
						<li>{$ed->location}</li>
						<li><em>{$ed->dates}</em></li>
					</ul>
				{/foreach}
				</div>
				{/if}

				{if $awards}
				<div class="resume-column-1">
					<h2>Awards</h2>
				</div>

				<div class="resume-column-2">
				{foreach item=award from=$awards[0]}
					<h4>{$award->honor}</h4>

					<p>
						{$award->contest}
					</p>
				{/foreach}
				</div>
				{/if}
