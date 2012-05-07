				<nav id="page-nav" class="span-20 last">
					<div class="span-4">&nbsp;</div>
					<div id="page-nav-bar" class="span-13 prepend-1 append-1 last">
				<?php echo previous_posts_link(); ?>	
				<?php echo next_posts_link(); ?>
					</div>
				</nav>

				<footer class="span-20 last">
					<div class="span-4">&nbsp;</div>
					<div class="span-13 prepend-1 append-1 last">
					&#169; <?php echo gmdate('Y'); ?> Greg Bueno
					</div>
				</footer>

			</div>
			
			<?php get_sidebar('footer');?>
			
		</div>
		
<?php wp_footer(); ?>
			
	</body>
</html>
