<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

	<?php if (have_posts()) : ?>

		<h2 class="pagetitle"><?php _e( 'Search Results', 'sunburn' ); ?></h2>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link( __( '&laquo; Previous Entries', 'sunburn' ) ); ?></div>
			<div class="alignright"><?php previous_posts_link( __( 'Next Entries &raquo;', 'sunburn' ) ); ?></div>
		</div>


		<?php while (have_posts()) : the_post(); ?>

			<div <?php post_class(); ?>>
				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permanent Link to %s', 'sunburn' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></h3>
				<small><?php the_time( get_option( 'date_format' ) ); ?></small>

				<p class="postmetadata">
					<?php printf( __( 'Posted in %s', 'sunburn'), get_the_category_list( ', ' ) ); ?>
					 |
					<?php edit_post_link( __( 'Edit', 'sunburn' ), '', ' | ' ); ?>
					<?php the_tags( __( 'Tags:', 'sunburn' ) . ' ', ', ', '<br />' ); ?>
					<?php comments_popup_link( __( 'Leave a Comment &#187;', 'sunburn' ), __( '1 Comment &#187;', 'sunburn' ), __( '% Comments &#187;', 'sunburn' ) ); ?>
				</p>
			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link( __( '&laquo; Previous Entries', 'sunburn' ) ); ?></div>
			<div class="alignright"><?php previous_posts_link( __( 'Next Entries &raquo;', 'sunburn' ) ); ?></div>
		</div>

	<?php else : ?>

		<h2 class="center"><?php _e( 'No posts found. Try a different search?', 'sunburn' ); ?></h2>
		<?php get_search_form(); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
