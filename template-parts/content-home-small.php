<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package MP_Starter_Theme
 */

?>

<article class="small" <?php post_class(); ?>>
	<?php
	if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
		?><div class="entry-thumbnail">
         	<?php the_post_thumbnail('slider'); ?>
         </div>
    <?php } ?>

    <div class="entry-body">

		<header class="entry-header">
		<?php

			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

			if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php jouy_posted_on(); ?> / 
				<?php jouy_entry_categories(); ?>
			</div><!-- .entry-meta -->
			<?php
			endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content entry-snippet">
			<?php
			if(get_theme_mod('jouy_readmore_checkbox', true) == true)
				$readmore = '... <a href="' . get_permalink( $post->ID ) . '" class="readmore" title="Read More"><button class="btn read-more">' . get_theme_mod('jouy_readmore_text', 'Read more') . '</button><i class="icon-arrow-right"></i></a>';

				echo wp_trim_words(get_the_excerpt(), 20, $readmore);

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jouy' ),
					'after'  => '</div>',
				) );

			?>
		</div><!-- .entry-content -->
		
	</div><!-- .entry-body -->
	
</article><!-- #post-<?php the_ID(); ?> -->
