</div>

<footer class="footer">
	<div class="container">
		<div class="row">
			<div class="span4">
				<p><a href="http://gocartdv.com" target="_blank"><img src="<?php echo base_url('assets/img/driven-by-gocart.png');?>" alt="Driven By GoCart" /></a></p>
			</div>

			<div class="span4">
				
				<ul id="nav-social">
					<li><a href="http://twitter.com/ObservantRecs"><img src="http://vigilante.vigilantmedia.com/images/icons/twitter.png" alt="[Twitter]" title="[Twitter]" /></a></li>
					<li><a href="http://facebook.com/observantrecords"><img src="http://vigilante.vigilantmedia.com/images/icons/facebook.png" alt="[Facebook]" title="[Facebook]" /></a></li>
					<li><a href="http://youtube.com/user/observantrecords"><img src="http://vigilante.vigilantmedia.com/images/icons/youtube.png" alt="[YouTube]" title="[YouTube]" /></a></li>
					<li><a href="http://soundcloud.com/observantrecords"><img src="http://vigilante.vigilantmedia.com/images/icons/soundcloud.png" alt="[SoundCloud]" title="[SoundCloud]" /></a></li>
				</ul>

				<p>&copy; <?php echo date('Y'); ?> <a href="http://observantrecords.com/">Observant Records</a></p>
			</div>
			
			<div class="span3">
				<h4>More information</h4>

				<ul>
					<?php foreach($this->pages as $page):?>
						<?php if ($page->slug == 'shop-information'): ?>
							<?php foreach ($page->children as $menu_page): ?>
					<li>
							<?php if(empty($menu_page->content)):?>
						<a href="<?php echo $menu_page->url;?>" <?php if($menu_page->new_window ==1){echo 'target="_blank"';} ?>><?php echo $menu_page->menu_title;?></a>
							<?php else:?>
						<a href="<?php echo site_url($menu_page->slug);?>"><?php echo $menu_page->menu_title;?></a>
							<?php endif;?>
					</li>
							<?php endforeach; ?>
						<?php endif;?>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		
		
	</div>
	


</footer>

</body>
</html>