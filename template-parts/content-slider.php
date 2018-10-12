<?php
/**
 * Template part for displaying posts in slick slider
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package MP_Starter_Theme
 */

?>

<div class="recent-post">
  <a href="<?php print get_permalink($loop->ID) ?>">
    <div class="recent-post-thumbnail">
      <?php echo the_post_thumbnail(); ?>
    </div>
  </a>
  
  <div class="recent-post-caption">
    <div class="recent-post-inner">
      <div class="slider-category"><?php jouy_entry_categories(); ?></div>
      <a href="<?php print get_permalink($loop->ID) ?>"><h3><?php print get_the_title(); ?></h3></a>
    </div>
  </div>

  <div class="slick-navigation">
    <a class="prev"><i class="icon-arrow-left"></i></a>
    <a class="next"><i class="icon-arrow-right"></i></a>
  </div>
</div>