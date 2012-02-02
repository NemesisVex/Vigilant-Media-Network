					<aside id="frame-1" class="prepend-1 append-1 prepend-top">
						<h3>Portfolio</h3>

						<p>A number of the samples in this portfolio are internal tools, to which they cannot be linked. Please pardon the inconvenience.</p>
					</aside>

					<section id="frame-2" class="prepend-top box last">

						<article class="prepend-1">
							<p><img src="/images/vm_folio_epicom_cases_portal_v02.jpg" width="200" height="128" alt="[Cases Portal for SugarCRM]" title="[Cases Portal for SugarCRM]" border="0"></p>

							<p>
								<strong>Cases Portal for SugarCRM</strong><br>
								<span class="smaller">
									&raquo; <a href="#cases_portal" rel="facebox">More info</a>
								</span>
							</p>

							<div id="cases_portal" class="hidden">
								<p>A number of clients asked Epicom to build external web sites their customers may access to keep track of cases filed through SugarCRM.</p>
								
								<p>These clients wanted such portals to be simple and expose only specific fields.</p>
								
								<p>So I built these portal from the ground-up using the Sugar REST API to read from and write to SugarCRM.</p>
							</div>
						</article>
							
						<article class="prepend-1 last">
							<p><img src="/images/vm_folio_ni_processdocs.jpg" width="200" height="128" alt="[NI Tech Comm: Process Documents Portal]" title="[NI Tech Comm Process Documents Portal]" border="0"></p>

							<p>
								<strong>NI Tech Comm: Process Documents Portal</strong><br>
								<span class="smaller">
									&raquo; <a href="#ni_processdocs" rel="facebox">More info</a>
								</span>
							</p>


							<div id="ni_processdocs" class="folio-info">
								<p>The NI Tech Comm Process Documents Portal is an internal web site listing various process documentation for the Technical Communications department of National Instruments.</p>

								<p>The first version of the site was maintained with XML and XSL. Manual updates and inconsistent training resulted in invalid XML when checked against a schema.</p>

								<p>So I built a management tool that stored the process documents in a database. After a user adds or updates a document in the database, a single button click rebuilds the XML, transforms it to HTML, then stores the resulting files on Perforce, where a separate automated process updates the website.</p>
							</div>
						</article>

						<article class="prepend-1">
							<p><a href="#ni_l10n_manager" rel="facebox"><img src="/images/vm_folio_ni_l10n_manager.jpg" width="200" height="128" alt="[NI Tech Comm: Localization Project Manager]" title="[NI Tech Comm: Localization Project Manager]" border="0"></a></p>

							<p><strong>NI Tech Comm: Localization Project Manager</strong><br>
								<span class="smaller">
									&raquo; <a href="#ni_l10n_manager" rel="facebox">More info</a>
								</span>
							</p>

							<div id="ni_l10n_manager" class="folio-info">
								<p>In April 2006, I was tasked to perform some administrative duties related to the localization of National Instruments documents. It was a tedious, manual process, so I built a web-based tool to automate it.</p>

								<p>The Localization Project Manager facilitates the creation of part numbers in various systems, while also tracking the progress of a document through the localization process.</p>

								<p>Before the launch of the Localization Project Manager, it would take a minimum of 20 minutes per document to finish all the necessary tasks. After the launch, that process was reduced to a maximum of 5 minutes.</p>

							</div>
						</article>

						<article class="prepend-1 last">
							<p><a href="#ni_icon_glossary" rel="facebox"><img src="/images/vm_folio_ni_icon_glossary.jpg" width="200" height="120" alt="[NI Tech Comm: Icon Glossary]" title="[NI Tech Comm Icon Glossary]" border="0"></a></p>

							<p>
								<strong>NI Tech Comm: Icon Glossary</strong><br>
								<span class="smaller">
									&raquo; <a href="#ni_icon_glossary" rel="facebox">More info</a>
								</span>
							</p>


							<div id="ni_icon_glossary" class="folio-info">
								<p>Formerly a site of static HTML pages, the NI Tech Comm Icon Glossary became a web application to address the exponential growth of the library.</p>

								<p>Icons were being made faster than they could be added to the glossary. Even an XML version of the glossary could not address the backlog. A web application dramatically sped up what would be an incredibly tedious manual process.</p>

								<p>The NI Tech Comm Icon Glossary served as a basis for the Process Documents Portal. Both applications build an XML file from the database, which is transformed into HTML and submitted to Perforce.</p>

							</div>
						</article>

						<article class="prepend-1">
							<p><a href="#ni_l10n_image_report" rel="facebox"><img src="/images/vm_folio_ni_l10n_image_report.jpg" width="200" height="120" alt="[NI Tech Comm: Localization Image Report]" title="[NI Tech Comm: Localization Image Report]" border="0"></a></p>

							<p><strong>NI Tech Comm: Localization Image Report</strong><br>
								<span class="smaller">
									&raquo; <a href="#ni_l10n_image_report" rel="facebox">More info</a>
								</span>
							</p>

							<div id="ni_l10n_image_report" class="folio-info">
								<p>An early version of this application was created when I was given 48 hours to comb through more than 500 images to determine which ones needed localization.</p>

								<p>I did it in half that time.</p>

								<p>The Localization Image Report syncs to a depot on Perforce, scans the client directory for images and saves them to a database. The application then allows a user to browse through pages of images, flagging any that require localization.</p>

								<p>A user can then generate a CSV report listing which images require localization.</p>
							</div>
						</article>

						<article class="prepend-1 last">
							<p><a href="#musicwhore" rel="facebox"><img src="/images/vm_folio_musicwhore_v08.jpg" width="200" height="128" alt="[Musicwhore.org]" title="[Musicwhore.org]" border="0"></a></p>

							<p>
								<strong>Musicwhore.org</strong><br>
								<span class="smaller">
									&raquo; <a href="http://www.musicwhore.org">Visit the site</a><br>
									&raquo; <a href="#musicwhore" rel="facebox">More info</a>
								</span>
							</p>

							<div id="musicwhore" class="folio-info">
								<p>Musicwhore.org is my music blog, where I write mostly about Japanese indie rock.</p>

								<p>It started out as an interactive webzine, complete with an artist directory and audio samples, which required a user account to access.</p>

								<p>Now the site integrates content from Musicbrainz and Amazon Web Services with the artist directory.</p>

								<p>A previous version the site is available at <a href="http://archive.musicwhore.org/">archive.musicwhore.org</a>, plus two neglected sister sites, <a href="http://www.filmwhore.org/">Filmwhore.org</a> and <a href="http://www.tvwhore.org/">TVwhore.org</a></p>
							</div>
						</article>

						<article class="prepend-1">
							<p><a href="#eponymous4" rel="facebox"><img src="/images/vm_folio_eponymous4_v04.jpg" width="200" height="128" alt="[Eponymous 4]" title="[Eponymous 4]" border="0"></a></p>

							<p>
								<strong>Eponymous 4</strong><br>
								<span class="smaller">
									&raquo; <a href="http://www.eponymous4.com/">Visit the site</a><br>
									&raquo; <a href="#eponymous4" rel="facebox">More info</a>
								</span>
							</p>

							<div id="eponymous4" class="folio-info">
								<p>Eponymous 4 is my solo music project, and the official site provides news and audio content to listeners.</p>

								<p>Because I've decided to release my own music through online channels, I created a system by which I can control the availability of album information and audio files, allowing me to prepare material in advance but making it available over time.</p>

								<p>To prevent unscrupulous search engines from misrepresenting my content, links to audio files are obfuscated.</p>
							</div>
						</article>

						<article class="prepend-1 last">
							<p><a href="#sk" rel="facebox"><img src="/images/vm_folio_sk.jpg" width="200" height="128" alt="[Supportkids, Inc.]" title="[Supportkids, Inc.]" border="0"></a></p>

							<p>
								<strong>Supportkids, Inc.</strong><br>
								<span class="smaller">
									&raquo; <a href="#sk" rel="facebox">More info</a>
								</span>
							</p>

							<div id="sk" class="folio-info">
								<p>I started out at Supportkids in 2000 as a technical liason for the content staff. My job was to wade through ASP code to find appropriate spots to insert content.</p>

								<p>Soon after, I moved on to web development. My biggest project was refining a web-based application for in-house data entry. I performed support duties for the data entry staff, and I monitored customer feedback regarding the company's online application.</p>

							</div>
						</article>

					</section>

					<script type="text/javascript" src="{$config.to_vigilante}/js/facebox.js"></script>
					{literal}
					<script type="text/javascript">
					$(document).ready(function ()
					{
						$('a[rel*=facebox]').click(function () {
							var info_id = $(this).attr('href');
							var folio_info = $(info_id);
							if (folio_info.css('display') == 'none') {
								folio_info.show('blind');
								$(this).html('Less info');
							} else {
								folio_info.hide('blind');
								$(this).html('More info');
							}
							return false;
						});
					});
					</script>
					{/literal}
