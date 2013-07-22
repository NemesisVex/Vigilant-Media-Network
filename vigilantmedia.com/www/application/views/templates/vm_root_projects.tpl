				<script type="text/javascript" src="{$smarty.const.VIGILANTMEDIA_CDN_BASE_URI}/web/js/facebox.js"></script>
				<script type="text/javascript">
				var facebox_options = {ldelim}
					closeImage: '{$smarty.const.VIGILANTMEDIA_CDN_BASE_URI}/web/images/closelabel.gif',
					loadingImage: '{$smarty.const.VIGILANTMEDIA_CDN_BASE_URI}/web/images/loading.gif'
				{rdelim};
				$(function () {ldelim}
					$('a[rel*=facebox]').facebox(facebox_options);
				{rdelim});
				</script>

				<header>
					<h1>Projects</h1>
				</header>

				<section id="current" class="full-column-last">
					<header>
						<h2>Current</h2>
					</header>

					<article class="two-column-single">

						<h3><a href="https://bitbucket.org/observantrecords">Observant Records Network</a></h3>

						<a href="https://bitbucket.org/observantrecords"><img src="/images/observant_records_o_square_logo.png" class="img-align-right" alt="[Observant Records]" title="[Observant Records]" width="128" /></a>

						<p>Drupal powers the official sites of my various music projects, including <a href="http://observantrecords.com/">Observant Records</a>, <a href="http://eponymous4.com/">Eponymous 4</a>, <a href="http://emptyensemble.com/">Empty Ensemble</a> and <a href="http://shinkyokuadvocacy.com/">Shinkyoku Advocacy</a>.</p>
						
						<p>An <a href="https://bitbucket.org/observantrecords/observant-records-administration">administration site</a> maintains release information, which is accessed through a <a href="https://bitbucket.org/observantrecords/observant-records-drupal">custom-built Drupal module</a>, while Amazon Cloudfront provides audio content.</p>
						
						<p><a href="http://gocartdv.com/">GoCart</a> runs the <a href="https://bitbucket.org/observantrecords/observant-records-shop">Observant Records Shop</a>.</p>
						
						<p>The source code for the network is available to view on <a href="https://bitbucket.org/observantreocrds">Bitbucket</a>.</p>

					</article>

					<article class="two-column-single-last">

						<h3><a href="https://bitbucket.org/NemesisVex/vigilant-media-network">Vigilant Media Network</a></h3>

						<a href="https://bitbucket.org/NemesisVex/vigilant-media-network"><img src="/images/codeigniter.png" class="img-align-right" alt="[CodeIgniter]" title="[CodeIgniter]" /></a>

						<p>The Vigilant Media Network is a set of personal web projects running off the CodeIgniter framework. The Network also includes installations of Movable Type and WordPress.</p>

						<p>The source code for the network is available to view on <a href="https://bitbucket.org/NemesisVex/vigilant-media-network">Bitbucket</a>.</p>

					</article>
				</section>

				<section id="past" class="full-column-last">
					<header>
						<h2>Past</h2>
					</header>

					<div class="three-columns">
						<article class="three-column-single">
							<p class="centered"><a href="/images/_full_vm_folio_uw_limited_submissions.jpg" rel="facebox"><img src="/images/vm_folio_uw_limited_submissions.jpg" alt="[University of Washington Research Limited Submissions]" title="[University of Washington Research Limited Submissions]" class="folio-image" /></a></p>

							<h3>University of Washington Research Limited Submissions</h3>
							
							<p>The <a href="http://www.washington.edu/research/funding/limited-submissions/">University of Washington Research Limited Submissions site</a> posts information about grants, awards and fellowships that limit the number of applications per institution.</p>
							
							<p>The design and functionality of the original site had not been updated in a number of years, so for this project, I worked primarily on the controllers and models for the public-facing site and a new administration interface.</p>
						</article>

						<article class="three-column-single">
							<p class="centered"><a href="/images/_full_vm_folio_epicom_cases_portal_v02.jpg" rel="facebox"><img src="/images/vm_folio_epicom_cases_portal_v02.jpg" alt="[Epicom Cases Portal]" title="[Epicom Cases Portal]" class="folio-image" /></a></p>

							<h3>SugarCRM: Cases Portal</h3>

							<p>A number of clients asked Epicom to build external web sites their customers may access to keep track of cases filed through SugarCRM.</p>

							<p>These clients wanted such portals to be simple and expose only specific fields.</p>

							<p>So I helped to build these portal from the ground-up using the Sugar REST API to read from and write to SugarCRM.</p>

							<p>Find out more about this project from the <a href="http://www.epicom.com/product_catalog/support-portal">Epicom web site</a>.</p>
						</article>

						<article class="three-column-single-last">
							<p class="centered"><a href="/images/_full_vm_folio_mt_force_preview_plugin.jpg" rel="facebox"><img src="/images/vm_folio_mt_force_preview_plugin.jpg" alt="[Movable Type Force Preview Plugin]" title="[Movable Type Force Preview Plugin]" class="folio-image" /></a></p>

							<h3>Movable Type Force Preview plugin</h3>

							<p><a href="https://bitbucket.org/NemesisVex/movable-type-forcepreview">Force Preview for Movable Type</a> prevents comment spam by requiring users to preview a comment before submitting it.</p>

							<p><a href="http://unicom.com/">Chip Rosenthal</a> created the Force Preview plugin for Movable Type 3. I updated it to work with Movable Type 4 and 5.</p>
						</article>
					</div>

					<div class="three-columns">
						<article class="three-column-single">
							<p class="centered"><a href="/images/_full_vm_folio_ni_processdocs.jpg" rel="facebox"><img src="/images/vm_folio_ni_processdocs.jpg" alt="[NI Tech Comm Process Documents]" title="[NI Tech Comm Process Documents]" class="folio-image" /></a></p>

							<h3>NI Tech Comm: Process Documents Portal</h3>

							<p>The NI Tech Comm Process Documents Portal is an internal web site listing various process documentation for the Technical Communications department of National Instruments.</p>

							<p>The first version of the site was maintained with XML and XSL. Manual updates and inconsistent training resulted in invalid XML when checked against a schema.</p>

							<p>So I built a management tool that stored the process documents in a database from which static HTML files were generated.</p>
						</article>

						<article class="three-column-single">
							<p class="centered"><a href="/images/_full_vm_folio_ni_l10n_manager.jpg" rel="facebox"><img src="/images/vm_folio_ni_l10n_manager.jpg" alt="[NI Tech Comm Localization Project Manager]" title="[NI Tech Comm Localization Project Manager]" class="folio-image" /></a></p>

							<h3>NI Tech Comm: Localization Project Manager</h3>

							<p>In April 2006, I was tasked to perform some administrative duties related to the localization of National Instruments documents, so I built a web-based tool to automate the process.</p>

							<p>The Localization Project Manager facilitates the creation of part numbers in various systems, while also tracking the progress of a document through the localization process.</p>

							<p>Automating this process reduced the administrative overhead for each localized document from 20 minutes to less than five.</p>

						</article>

						<article class="three-column-single-last">
							<p class="centered"><a href="/images/_full_vm_folio_ni_icon_glossary.jpg" rel="facebox"><img src="/images/vm_folio_ni_icon_glossary.jpg" alt="[NI Icon Glossary]" title="[NI Icon Glossary]" class="folio-image" /></a></p>

							<h3>NI Tech Comm: Icon Glossary</h3>

							<p>Formerly a site of static HTML pages, the NI Tech Comm Icon Glossary became a web application to address the exponential growth of the library.</p>

							<p>Icons were being made faster than they could be added to the glossary, so I built an administrative interface to allow icons to be added, edited or removed easily.</p>

							<p>Glossary content could also be exported to CSV or XML.</p>

						</article>

					</div>
				</section>
