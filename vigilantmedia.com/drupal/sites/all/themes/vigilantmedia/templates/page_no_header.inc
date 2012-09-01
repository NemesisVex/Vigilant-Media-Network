		<header id="masthead">
			<div class="container">
				<hgroup id="masthead-left">
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

				<nav id="masthead-right">
					<?php if ($main_menu): ?>
					<?php print theme('links__system_main_menu', array('links' => $main_menu)); ?>
					<?php endif; ?>
				</nav>

			</div>
		</header>

		<div id="content">
			<div class="container">
				<aside id="frame-1">
				<?php if ($page['sidebar_first']): ?>
					<?php print render($page['sidebar_first']); ?>
				<?php endif; ?>

				<?php if ($page['sidebar_second']): ?>
					<?php print render($page['sidebar_second']); ?>
				<?php endif; ?>
				</aside>

				<section id="frame-2">
				<?php if ($messages): ?>
					<section id="success">
					<?php print $messages; ?>
					</section>
				<?php endif; ?>
				<?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
				<a id="main-content"></a>
				<?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
				<?php print render($page['help']); ?>
				<?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
				<?php print render($page['content']); ?>
				<?php //print $feed_icons; ?>
				</section>
			</div>
		</div>
