<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package My_Boutique_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php 
	if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
		?><div class="entry-thumbnail site-max-width">
           <?php the_post_thumbnail(); ?>
        </div>
    <?php } ?>

	<header class="entry-header site-max-width">
		<?php	
		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta site-max-width">
			<?php parlez_entry_categories(); ?> |
			<?php parlez_posted_on(); ?> 
		</div><!-- .entry-meta -->
		<?php
		endif; ?>

		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title site-max-width">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>

		<?php if ( has_excerpt() ) : // Only show custom excerpts not autoexcerpts ?>
		    <p class="entry-excerpt site-max-width"><?php echo get_the_excerpt(); ?></p>
		<?php endif; ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'parlez' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'parlez' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer site-max-width">
		<?php parlez_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
