<?php
/**
 * The template for displaying front-page.
 * Template name: Home
 * @package understrap
 */

get_header();
?>

<section class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-6 main-img">
                <?php 
                    $img = get_field('main_image') 
                ?>
                    <img src="<?= esc_url($img['url']); ?>" alt="<?= esc_attr($img['alt']); ?>"> 
                </div>
            <div class="col-md-6 main-description">
                <?php the_field('main_title') ?>
                <?php the_field('main_subtitle') ?>
                <?php the_field('main_description') ?>
            </div>
        </div> 
        <a href="#welcome" class="text-center"><span class="fa fa-chevron-down"></span></a>  
    </div>
</section>
<section class="welcome" id="welcome">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <?php 
                    $img = get_field('welcome_image') 
                ?>
                    <img src="<?= esc_url($img['url']); ?>" alt="<?= esc_attr($img['alt']); ?>"> 
            </div>
            <div class="col-md-6 welcome-description">
                <h2><?php the_field('welcome_title') ?></h2>
                <p><?php the_field('welcome_description') ?></p>
            </div>
        </div>
    </div>
</section>
<section class="offering">
    <div class="container text-center">
        <h2 class="offering-title"><?php the_field('offering_title') ?></h2>
        <p class="offering-description"><?php the_field('offering_description') ?></p>
        <ul class="offering-list d-flex justify-content-around flex-wrap">
        <?php
			if( have_rows('offering_items') ):
   			 while ( have_rows('offering_items') ) : the_row();?>
			
        		<li class="offering-item d-flex flex-column justify-content-end">
					<?php $img = get_sub_field('offering_img') ?>
                    <img src="<?= esc_url($img['url']); ?>" alt="<?= esc_attr($img['alt']); ?>">
                    <h3><?php the_sub_field('offering_item_title') ?></h3>
                    <p><?php the_sub_field('offering_item_description') ?></p>
				</li>

   			<?php endwhile;

			else :
			endif;
			?>
        </ul>
    </div>
</section>
<section class="works text-center">
    <div class="container">
        <h2 class="works-title"><?php the_field('works_title') ?></h2>
        <p class="works-description"><?php the_field('works_description') ?></p>
        <ul class="mb-5 mx-auto works-nav d-block d-md-flex justify-content-center">
        <?php
            $terms = get_terms( 'category', 'orderby=none', 'order=ASC' );

            if( $terms && ! is_wp_error($terms) ){?>  
            <li class="category-btn">
                <button data-name='*' class="active">All</button>
            </li>
       <?php foreach( $terms as $term ){?>
            <li class="category-btn">
                <button data-name="<?= '.' . $term->term_id; ?>"><?=  $term->name; ?></button>
            </li>
        <?php	}
            }
        ?>
        </ul>
        <ul class="row works-list">
            <?php
            $args = array(
                'post_type' => 'works',
                'posts_per_page' => -1,
                'orderby' => 'date',
                'order' => 'DESC'
            );

            $query = new WP_Query( $args );

            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                    $query->the_post();
                    $cur_terms = get_the_terms( $post->ID, 'category' );
                    if( is_array( $cur_terms ) ){
                    foreach( $cur_terms as $cur_term ){
	                }
                } ?>
                    <li class="work-item col-12 col-md-6 col-lg-4 mb-3 <?= $cur_term->term_id ?>">
                        <?php the_post_thumbnail(); ?>
                        <div class="works-overlay d-flex justify-content-center align-items-center">
                            <a href="<?php the_permalink() ?>" class="d-flex align-items-center justify-content-center" aria-label="Work"><?php the_title() ?></a>
                        </div>
                    </li>
                <?php }
            } else {
                echo 'Not found';
            }
            wp_reset_postdata();
        ?> 
        </ul>       
        </div>
    </div>
</section>

<?php
get_footer();
?>