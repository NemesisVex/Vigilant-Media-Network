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
						<li><a href="http://twitter.com/eponymous4"><img src="http://vigilante.vigilantmedia.com/images/icons/twitter.png" alt="[Twitter]" title="[Twitter]" /></a></li>
						<li><a href="http://facebook.com/Eponymous4"><img src="http://vigilante.vigilantmedia.com/images/icons/facebook.png" alt="[Facebook]" title="[Facebook]" /></a></li>
						<li><a href="http://soundcloud.com/observantrecords"><img src="http://vigilante.vigilantmedia.com/images/icons/soundcloud.png" alt="[Soundcloud]" title="[Soundcloud]" /></a></li>
						<li><a href="http://youtube.com/user/observantrecords"><img src="http://vigilante.vigilantmedia.com/images/icons/youtube.png" alt="[YouTube]" title="[YouTube]" /></a></li>
						<li><a href="/rss"><img src="http://vigilante.vigilantmedia.com/images/icons/feed.png" alt="[RSS]" title="[RSS]" /></a></li>
						<li><a href="http://myspace.com/eponymous4"><img src="http://vigilante.vigilantmedia.com/images/icons/myspace.png" alt="[MySpace]" title="[MySpace]" /></a></li>
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
				<?php if (!empty($page['content']['system_main']['nodes'])): ?>
				<?php foreach ($page['content']['system_main']['nodes'] as $node_id => $node): ?>
				<?php if (!empty($node['albums']['#albums'])): ?>
				<ul class="album-list">
				<?php foreach ($node['albums']['#albums'] as $album):
					?>
					<li>
						<a href="<?php echo drupal_get_path_alias('node/' . $node_id) ?>"><img src="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/' . variable_get('file_public_path', conf_path() . '/files');?>/images/_covers/_exm_front_200_<?php echo $album['album_image']; ?>" alt="[<?php echo $album['album_title']; ?>]" title="[<?php echo $album['album_title']; ?>]" /></a>
					</li>
				<?php endforeach; ?>
				</ul>
				<?php endif; ?>
				<?php endforeach; ?>
				<?php endif; ?>
				</div>

			</div>
			
			<img src="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/' . variable_get('file_public_path', conf_path() . '/files');?>/images/exm_vol_03_restraint.jpg" class="bg" alt="[Empty Ensemble Logo]" />
		</div>

