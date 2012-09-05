				<script type="text/javascript" src="http://vigilante.vigilantmedia.com/js/facebox.js"></script>
				{literal}
				<script type="text/javascript">
				var facebox_options = {
					closeImage: 'http://vigilante.vigilantmedia.com/images/closelabel.gif',
					loadingImage: 'http://vigilante.vigilantmedia.com/images/loading.gif'
				};
				$(function () {
					$('a[rel*=facebox]').facebox(facebox_options);
				});
				</script>
				{/literal}

				<header>
					<h1>Projects</h1>
				</header>

				<section id="current" class="full-column-last">
					<header>
						<h2>Current</h2>
					</header>

					<article class="two-column-single">

						<h3><a href="https://bitbucket.org/NemesisVex/vigilant-media-network">Vigilant Media Network</a></h3>

						<a href="https://bitbucket.org/NemesisVex/vigilant-media-network"><img src="/images/codeigniter.png" class="img-align-right" alt="[CodeIgniter]" title="[CodeIgniter]" /></a>

						<p>The Vigilant Media Network is a set of personal web projects running off the CodeIgniter framework. The Network also includes installations of Movable Type, WordPress and Drupal.</p>

						<p>The source code for the network is available to view on <a href="https://bitbucket.org/NemesisVex/vigilant-media-network">Bitbucket</a>.</p>


					</article>

					<article class="two-column-single-last">
						<h3><a href="https://bitbucket.org/NemesisVex/movable-type-forcepreview">Movable Type Force Preview plugin</a></h3>

						<a href="https://bitbucket.org/NemesisVex/movable-type-forcepreview"><img src="/images/movable_type.png" class="img-align-right" alt="[Movable Type]" title="[Movable Type]"  /></a>

						<p>Force Preview for Movable Type prevents comment spam by requiring users to preview a comment before submitting a comment.</p>

						<p><a href="http://unicom.com/">Chip Rosenthal</a> created the Movable Type Force Preview plugin for Movable Type 3. I updated this plugin to work with Movable Type 4 and 5.</p>
					</article>
				</section>

				<section id="past" class="full-column-last">
					<header>
						<h2>Past</h2>
					</header>

					<div class="three-columns">
						<article class="three-column-single">
							<p class="centered"><a href="/images/_full_vm_folio_epicom_cases_portal_v02.jpg" rel="facebox"><img src="/images/vm_folio_epicom_cases_portal_v02.jpg" alt="[Epicom Cases Portal]" title="[Epicom Cases Portal]" class="folio-image" /></a></p>

							<h3>SugarCRM: Cases Portal</h3>

							<p>A number of clients asked Epicom to build external web sites their customers may access to keep track of cases filed through SugarCRM.</p>

							<p>These clients wanted such portals to be simple and expose only specific fields.</p>

							<p>So I helped to build these portal from the ground-up using the Sugar REST API to read from and write to SugarCRM.</p>

							<p>Find out more about this project from the <a href="http://www.epicom.com/product_catalog/support-portal">Epicom web site</a>.</p>
						</article>

						<article class="three-column-single">
							<p class="centered"><a href="/images/_full_vm_folio_ni_processdocs.jpg" rel="facebox"><img src="/images/vm_folio_ni_processdocs.jpg" alt="[NI Tech Comm Process Documents]" title="[NI Tech Comm Process Documents]" class="folio-image" /></a></p>

							<h3>NI Tech Comm: Process Documents Portal</h3>

							<p>The NI Tech Comm Process Documents Portal is an internal web site listing various process documentation for the Technical Communications department of National Instruments.</p>

							<p>The first version of the site was maintained with XML and XSL. Manual updates and inconsistent training resulted in invalid XML when checked against a schema.</p>

							<p>So I built a management tool that stored the process documents in a database. After a user adds or updates a document in the database, a single button click rebuilds the XML, transforms it to HTML, then stores the resulting files on Perforce, where a separate automated process updates the website.</p>
						</article>

						<article class="three-column-single-last">
							<p class="centered"><a href="/images/_full_vm_folio_ni_l10n_manager.jpg" rel="facebox"><img src="/images/vm_folio_ni_l10n_manager.jpg" alt="[NI Tech Comm Localization Project Manager]" title="[NI Tech Comm Localization Project Manager]" class="folio-image" /></a></p>

							<h3>NI Tech Comm: Localization Project Manager</h3>

							<p>In April 2006, I was tasked to perform some administrative duties related to the localization of National Instruments documents. It was a tedious, manual process, so I built a web-based tool to automate it.</p>

							<p>The Localization Project Manager facilitates the creation of part numbers in various systems, while also tracking the progress of a document through the localization process.</p>

							<p>Before the launch of the Localization Project Manager, it would take a minimum of 20 minutes per document to finish all the necessary tasks. After the launch, that process was reduced to a maximum of 5 minutes.</p>

						</article>
					</div>

					<div class="three-columns">
						<article class="three-column-single">
							<p class="centered"><a href="/images/_full_vm_folio_ni_icon_glossary.jpg" rel="facebox"><img src="/images/vm_folio_ni_icon_glossary.jpg" alt="[NI Icon Glossary]" title="[NI Icon Glossary]" class="folio-image" /></a></p>

							<h3>NI Tech Comm: Icon Glossary</h3>

							<p>Formerly a site of static HTML pages, the NI Tech Comm Icon Glossary became a web application to address the exponential growth of the library.</p>

							<p>Icons were being made faster than they could be added to the glossary. Even an XML version of the glossary could not address the backlog. A web application dramatically sped up what would be an incredibly tedious manual process.</p>

							<p>The NI Tech Comm Icon Glossary served as a basis for the Process Documents Portal. Both applications build an XML file from the database, which is transformed into HTML and submitted to Perforce.</p>

						</article>

						<article class="three-column-single">
							<p class="centered"><a href="/images/_full_vm_folio_ni_l10n_image_report.jpg" rel="facebox"><img src="/images/vm_folio_ni_l10n_image_report.jpg" alt="[NI Tech Comm Localization Image Report]" title="[NI Tech Comm Localization Image Report]" class="folio-image" /></a></p>

							<h3>NI Tech Comm: Localization Image Report</h3>

							<p>An early version of this application was created when I was given 48 hours to comb through more than 500 images to determine which ones needed localization.</p>

							<p>I did it in half that time.</p>

							<p>The Localization Image Report syncs to a depot on Perforce, scans the client directory for images and saves them to a database. The application then allows a user to browse through pages of images, flagging any that require localization.</p>

							<p>A user can then generate a CSV report listing which images require localization.</p>
						</article>

						<article class="three-column-single-last">
							<p class="centered"><a href="/images/_full_vm_folio_central_admin.jpg" rel="facebox"><img src="/images/vm_folio_central_admin.jpg" alt="[Vigilant Media Central Administration]" title="[Vigilant Media Central Administration]" class="folio-image" /></a></p>

							<h3>Vigilant Media Central Administration</h3>

							<p>Vigilant Media Central Administration is the custom-built content management system I use to maintain the <a href="http://eponymous4.com/">Eponymous 4 Official Site</a>, <a href="http://musicwhore.org/">Musicwhore.org</a> and various other projects.</p>

							<p>The site dates back to the early 2000s and has served as a learning laboratory. In the beginning, it was powered by something that could be considered a precursor to a framework, albeit mostly written a procedural style.</p>

							<p>In 2008, Vigilant Media Central Administration moved to CodeIgniter and jQuery, and more recently, portions of the site employ jQuery UI.</p>

						</article>

					</div>
				</section>
