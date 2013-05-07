		<div id="container">
			<div id="masthead">
				<header id="logo">
						<a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
							<img src="<?php print $logo; ?>" alt="[<?php echo $site_name; ?>]" title="[<?php echo $site_name; ?>]" id="observant-records-logo" />
						</a>
				</header>

				<nav id="nav-column-1">
					<?php if ($main_menu): ?>
					<?php print theme('links__system_main_menu', array('links' => $main_menu)); ?>
					<?php endif; ?>
				</nav>

				<nav id="nav-column-2">
					<ul id="nav-social">
						<li><a href="http://twitter.com/ObservantRecs"><img src="<?php echo observantrecs_get_vigilante_uri(); ?>/images/icons/twitter.png" alt="[Twitter]" title="[Twitter]" /></a></li>
						<li><a href="http://www.facebook.com/ObservantRecords"><img src="<?php echo observantrecs_get_vigilante_uri(); ?>/images/icons/facebook.png" alt="[Facebook]" title="[Facebook]" /></a></li>
						<li><a href="http://soundcloud.com/observantrecords"><img src="<?php echo observantrecs_get_vigilante_uri(); ?>/images/icons/soundcloud.png" alt="[SoundCloud]" title="[SoundCloud]" /></a></li>
						<li><a href="http://youtube.com/user/observantrecords"><img src="<?php echo observantrecs_get_vigilante_uri(); ?>/images/icons/youtube.png" alt="[YouTube]" title="[YouTube]" /></a></li>
					</ul>
				</nav>
			</div>

			<div id="content">
				<div id="column-1">
				<?php if ($messages): ?>
					<section id="success">
					<?php print $messages; ?>
					</section>
				<?php endif; ?>
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
				</div>

				<div id="column-2">
				<?php if ($page['sidebar_first']): ?>
					<?php print render($page['sidebar_first']); ?>
				<?php endif; ?>

				<?php if ($page['sidebar_second']): ?>
					<?php print render($page['sidebar_second']); ?>
				<?php endif; ?>
				</div>
			</div>

			<footer id="footer">
				<p>
					&copy <?php echo date('Y'); ?> Observant Records
				</p>
			<?php if ($page['footer']): ?>
			<?php print render($page['footer']); ?>
			<?php endif; ?>
			</footer>
		</div>
