				<article>
					<header class="entry-header">
							<h3 class="headline"><?php if ( is_single() || is_page() ) : ?>
					<?php the_title(); ?>
				<?php else : ?>
					<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'musicwhore' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
				<?php endif; ?></h3>
					</header>

						<?php if ( ! is_page() ) : ?>
					<div class="entry-meta">
						Posted by <a href="<?php echo esc_html(get_author_posts_url( get_the_author_meta( 'ID' ))); ?>"><?php echo esc_html(get_the_author()); ?></a>
						on <time pubdate="pubdate"><?php the_time( 'M d, Y' ); ?></time>
						in <?php the_category( ', ' ); ?>
					</div>
						<?php endif; ?>

					<div class="entry-content">

						<section class="entry-text">
							<?php wp_link_pages( array( 'before' => '<p class="page-link"><span>' . __( 'Pages:', 'musicwhore' ) . '</span>', 'after' => '</p>' ) ); ?>
							<?php the_content( __( 'More <span class="meta-nav">&raquo;</span>', 'chunk' ) ); ?>
						<?php if ( ! is_page() ) : ?>
							<?php comments_template( '', true ); ?>
						<?php endif; ?>
						</section>

					</div>

				</article>
