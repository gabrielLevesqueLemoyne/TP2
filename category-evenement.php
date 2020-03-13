<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package underscores
 */
//the query
$args1 = array(
    "category_name" => "evenement",
    "orderby" => "date",
    "post_status" => "future",
    "order" => "ASC",
    'posts_per_page' => -1
);

$query1 = new WP_Query( $args1 );

$args2 = array(
    "category_name" => "evenement",
    'posts_per_page' => 1
);

$query2 = new WP_Query( $args2 );

get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_description( '<h1 class="page-title">', '</h1>' );
				?>
			</header><!-- .page-header -->

            <?php
            
            ////START DIV GRID
            echo '<div class="grid-evenement">';

            /* Start the Loop */

			while ( $query1->have_posts() ) {
                
                $query1->the_post();
                //$horaire= substr(get_post_field('post_name'), -2);
                echo '<div class="element-grid" id='.get_the_date('m').'>';
                echo '<p><a href="https://www.youtube.com/?hl=fr&gl=CA">' . get_the_title() .'</a></p>';
                echo '<p>' . get_the_date() . '</p>';
                echo '</div>';
            }

            echo '</div>';
            wp_reset_postdata();


				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				//get_template_part( 'template-parts/content', get_post_type() )

			//the_posts_navigation();

		else :

			//get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
