<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package My_Boutique_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" class=<?php post_class(); ?>>
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
				<?php parlez_entry_categories(); ?>
			</div><!-- .entry-meta -->
			<?php
			endif; ?>

			<?php
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	         	?>
		</header><!-- .entry-header -->

		<div class="entry-content entry-snippet">
			<?php
			if(get_theme_mod('parlez_readmore_text', 'Read More') != '') {
				$readmore = '... <a href="' . get_permalink( $post->ID ) . '" class="readmore" title="Read More"><button class="btn read-more">' . get_theme_mod('parlez_readmore_text', 'Read more') . ' >></button></a>';
				}

				echo wp_trim_words(get_the_excerpt(), 20, $readmore);

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'parlez' ),
					'after'  => '</div>',
				) );

			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php parlez_entry_footer(); ?>
		</footer>

	</div>	
</article><!-- #post-<?php the_ID(); ?> -->
