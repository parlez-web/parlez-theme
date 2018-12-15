<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package My_Boutique_Theme
 */

?>
	<div id="before-footer" class="widget-area before-footer">
		<?php dynamic_sidebar( 'before-footer' ); ?> 
	</div>

	<footer id="colophon" class="site-footer">
		<?php get_template_part('template-parts/footer/footer', 'style-3'); ?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
