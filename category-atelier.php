<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package underscores
 */
//the query
$args = array(
    "category_name" => "atelier",
    "orderby" => "post_name",
    "order" => "ASC",
    'posts_per_page' => -1
);

$query = new WP_Query( $args );

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
            echo '<div class="grid-atelier">';

            /* Start the Loop */

			while ( $query->have_posts() ) {
                
                $query->the_post();
                $horaire= substr(get_post_field('post_name'), -2);

                echo '<p class='. get_post_field('post_author')." id=".$horaire.'>' . get_the_title() . '<br>' .get_post_field('post_name'). '<br>' .get_the_author_meta('display_name', $post->post_author). '</p>';
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
