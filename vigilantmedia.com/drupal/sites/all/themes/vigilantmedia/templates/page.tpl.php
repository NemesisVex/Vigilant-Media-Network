		<header id="masthead">
			<div class="container">

				<hgroup id="masthead-left" class="span-12">
					<?php if ($site_name): ?>
					<h1 id="title">
						<a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
							<?php echo $site_name; ?>
						</a>
					</h1>
					<?php endif; ?>
			        <?php if ($site_slogan): ?>
					<h3 id="subtitle">
						<?php echo $site_slogan; ?>
					</h3>
					<?php endif; ?>
				</hgroup>

				<nav id="masthead-right" class="span-12 prepend-top last">
					<?php if ($main_menu): ?>
					<?php print theme('links__system_main_menu', array('links' => $main_menu)); ?>
					<?php endif; ?>
				</nav>

			</div>
		</header>

		<div id="content">
			<div class="container">
				<aside id="frame-1" class="span-6 prepend-1 append-1 prepend-top">
				<?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
				<a id="main-content"></a>
				<?php print render($title_prefix); ?>
				<?php if ($title): ?><h2 class="title" id="page-title"><?php print $title; ?></h2><?php endif; ?>
				<?php print render($title_suffix); ?>
				<?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
				<?php print render($page['help']); ?>
				<?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
				<?php print render($page['content']); ?>
				<?php //print $feed_icons; ?>
				</aside>

				<section id="frame-2" class="span-14 prepend-top box last">
				<?php if ($page['sidebar_first']): ?>
					<?php print render($page['sidebar_first']); ?>
				<?php endif; ?>

				<?php if ($page['sidebar_second']): ?>
					<?php print render($page['sidebar_second']); ?>
				<?php endif; ?>
				</section>
			</div>
		</div>
