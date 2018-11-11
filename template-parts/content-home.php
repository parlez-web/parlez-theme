<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package My_Boutique_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" class="first-post" <?php post_class(); ?>>
		<?php 
		if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				?><div class="entry-thumbnail">
         		<?php the_post_thumbnail('featured-large'); ?>
         		</div>
         	<?php } ?>
		
	<div class="entry-body">

		<header class="entry-header">
			<?php
			if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php myboutique_entry_categories(); ?>
			</div><!-- .entry-meta -->
			<?php
			endif; ?>

			<?php
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	         	?>
		</header><!-- .entry-header -->

		<div class="entry-content entry-snippet">
			<?php
				the_excerpt( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s<span class="meta-nav">&rarr;</span>', 'myboutique' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'myboutique' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<!-- <footer class="entry-footer">
			<?php //myboutique_entry_footer(); ?>
		</footer> .entry-footer -->

	</div>	
</article><!-- #post-<?php the_ID(); ?> -->
