		<div id="container" class="container">
			<div id="masthead">
				<header>
					<?php if ($site_name): ?>
					<h1 id="title">
						<a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
							<?php print $site_name; ?>
						</a>
					</h1>
					<?php endif; ?>
				</header>

				<nav id="nav-column-1">
					<?php if ($main_menu): ?>
					<?php print theme('links__system_main_menu', array('links' => $main_menu)); ?>
					<?php endif; ?>
				</nav>

				<nav id="nav-column-2">
					<ul id="nav-social">
						<li><a href="http://twitter.com/eponymous4"><img src="<?php echo eponymous4_get_vigilante_uri(); ?>/images/icons/twitter.png" alt="[Twitter]" title="[Twitter]" /></a></li>
						<li><a href="http://facebook.com/Eponymous4"><img src="<?php echo eponymous4_get_vigilante_uri(); ?>/images/icons/facebook.png" alt="[Facebook]" title="[Facebook]" /></a></li>
						<li><a href="http://soundcloud.com/observantrecords"><img src="<?php echo eponymous4_get_vigilante_uri(); ?>/images/icons/soundcloud.png" alt="[Soundcloud]" title="[Soundcloud]" /></a></li>
						<li><a href="http://youtube.com/user/observantrecords"><img src="<?php echo eponymous4_get_vigilante_uri(); ?>/images/icons/youtube.png" alt="[YouTube]" title="[YouTube]" /></a></li>
						<li><a href="/rss.xml"><img src="<?php echo eponymous4_get_vigilante_uri(); ?>/images/icons/feed.png" alt="[RSS]" title="[RSS]" /></a></li>
						<li><a href="http://myspace.com/eponymous4"><img src="<?php echo eponymous4_get_vigilante_uri(); ?>/images/icons/myspace.png" alt="[MySpace]" title="[MySpace]" /></a></li>
					</ul>
				</nav>
			</div>

			<div id="content">
				<div id="music-index">
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
				</div>

			</div>

			<img src="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/' . variable_get('file_public_path', conf_path() . '/files');?>/images/exm_vol_03_restraint.jpg" class="bg" alt="[Empty Ensemble Logo]" />
		</div>

