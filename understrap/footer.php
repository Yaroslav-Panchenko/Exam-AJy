<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<footer>
	<section class="clients">
		<div class="container">
			<h2 class="clients-title text-center"><?php the_field('clients_title', 'option') ?></h2>
			<ul class="clients-list d-flex justify-content-around flex-wrap">
			<?php
			if( have_rows('clients_items', 'option') ):
   			 while ( have_rows('clients_items', 'option') ) : the_row();?>
			
        		<li>
					<?php $img = get_sub_field('clients_logo', 'option') ?>
					<a href="<?php the_sub_field('clients_link', 'option') ?>" target="_blank"><img src="<?= esc_url($img['url']); ?>" alt="<?= esc_attr($img['alt']); ?>"></a>
				</li>

   			<?php endwhile;

			else :
			endif;
			?>
			</ul>
		</div>
	</section>
	<section class="contact" style="background: url(<?php the_field('footer_bg_image', 'option') ?>)  no-repeat center top/cover;">
		<div class="contact-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-left') ) : ?>
						<?php endif; ?>
					</div>
					<div class="col-md-6">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-right') ) : ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="footer-logo text-center"><?php the_custom_logo() ?></div>
	<div class="footer-copy text-center">&copy; <?= get_the_date('Y'); ?> <?= __('All Rights Reserved.', 'understrap') ?></div>
</footer>

<?php wp_footer(); ?>

</body>

</html>

