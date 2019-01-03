<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package My_Boutique_Theme
 */


$show_overlay = get_theme_mod('myboutique_featured_overlay_checkbox', true);
?>

<article <?php post_class(); ?>>
	<?php
			if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				?><div class="entry-thumbnail">
         		<?php the_post_thumbnail(); ?>
         		</div>
         	<?php } 
         ?>

    <?php if($show_overlay) : ?>
	<header class="entry-header">
		<?php

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php myboutique_entry_categories(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
		
		<?php
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		?>

		<a href="<?php echo esc_url(get_permalink()) ?>" class="readmore"><?php echo get_theme_mod('myboutique_readmore_text', 'Read more') ?> >></a>

	</header><!-- .entry-header -->
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
