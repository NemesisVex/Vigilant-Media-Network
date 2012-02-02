{if $project}
{include file="vm_projects_"|cat:$project|cat:".tpl"}
{else}
<div id="Main">
<p>I've divided my portfolio into three categories to represent the different aspects of my work.</p>

<h3>Internal tools</h3>

<p>Most of my professional experience has gone toward the development of tools used internally by the companies for which I work. Unfortunately, screenshots of these tools are either uninformative (in the case of command-line tools) or unavailable (due to confidentiality). I include them regardless because they do represent a different aspect to the work that is available publicly.</p>

<p><a href="/index.php/vm/portfolio/tools/">Take me to your tools</a>!</p>

<h3>Vigilant Media network</h3>

<p>That's just a fancy way of describing the sites that run on my custom-built API, which I've codenamed Vigilante. I've <a href="{$config.to_vigilante}">documented</a> the API, although by now that documentation needs serious update. A number of these sites are personal in nature, but they do demonstrate the breadth of my work, a good portion of which is self-taught.</p>

<p><a href="/index.php/vm/portfolio/network/">Take me to your network</a>!</p>

<h3>Favors</h3>

<p>Exactly as the title implies -- these sites were built as favors to friends (well, two in particular.) These sites demonstrate my limited abilities as a front-end designer. I don't come from a graphic design background, so my designs tend to be Spartan. But they suite their purpose well.</p>

<p><a href="/index.php/vm/portfolio/favors/">Take me to your favors</a>!</p>

</div>
{/if}