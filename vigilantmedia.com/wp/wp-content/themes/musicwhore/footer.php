<nav id="page-nav" class="span-20 last">
	<div class="span-4">&nbsp;</div>
	<div id="page-nav-bar" class="span-13 prepend-1 append-1 last">
<?php echo previous_posts_link(); ?>	
<?php echo next_posts_link(); ?>
	</div>
</nav>

			</div>
			
			<?php get_sidebar('footer');?>
			
			<footer>
				<div class="span-4">&nbsp;</div>
				<div class="span-14 append-1 prepend-1">
					<p>
						&#169; <?php echo gmdate('Y'); ?> Greg Bueno
					</p>
				</div>
			</footer>

		</div>
		
<?php wp_footer(); ?>
			
	</body>
</html>
