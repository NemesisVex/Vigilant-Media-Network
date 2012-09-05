
				<aside id="content-column-2">
			<?php get_sidebar('footer');?>
				</aside>
				<!--CONTENT END-->
			</div>
		</div>

		<nav id="page-nav">
			<div id="page-nav-spacer">&nbsp;</div>
			<div id="page-nav-content">
		<?php echo previous_posts_link(); ?>
		<?php echo next_posts_link(); ?>
			</div>
		</nav>

		<footer id="footer">
			<div class="container centered">

			&copy; 2012 Greg Bueno
			</div>
		</footer>

		<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
		try {
			var pageTracker = _gat._getTracker("UA-7828220-7");
			pageTracker._trackPageview();
		} catch(err) {}
		</script>

		<?php wp_footer(); ?>

	</body>
</html>
