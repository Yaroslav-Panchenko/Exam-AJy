<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<li class="post-item">
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
		<a href="<?php the_permalink( ) ?>" class="article-link"><span class="fa fa-share"></span></a>
		<div class="entry-content">
		<a href="<?php the_permalink( ) ?>"><h2><?php the_title() ?></h2></a>
			<?php the_excerpt(); ?>
		</div>
		<div class="post-meta text-center">
			<?php 
					$d = 'M. d. Y';
					$t = 'Y-m-d';
			?>
			<time datetime="<?= get_the_date($t)?>"><?= get_the_date($d, $post->ID) ?></time>
		</div>
	</article>
</li>

