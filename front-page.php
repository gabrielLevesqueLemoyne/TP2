<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package underscore
 */

  // The Query
  $args = array(
    "category_name" => "evenement",
    "post_status" => "future",
    "posts_per_page" => 3,     
    "orderby" => "date",
    "order" => "ASC"
);

$query1 = new WP_Query( $args );

  /* The 2nd Query (without global var) */
  $args2 = array(
    "category_name" => "nouvelle",
    "posts_per_page" => 3
);

  $query2 = new WP_Query( $args2 );

  /* The 3nd Query (without global var) */
  $args3 = array(
    "category_name" => "evenement",
    "orderby" => "date",

);

  $query3 = new WP_Query( $args3 );


get_header();
?>
        <nav class="menu">
          <input id="checkMenu" type="checkbox">
          <label id="btnMenu" for="checkMenu">&#9776;</label>
          <ul class="listeMenu">
            <li class="choixMenu"><a href="index.html">Page Principale</a></li>
            <li class="choixMenu"><a >Événements</a></li>
            <li class="choixMenu"><a>À propos</a></li>
            <li class="choixMenu"><a>Contacter</a></li>
            <li class="choixMenu"><a>Dates</a></li>
            <li class="choixMenu"><a>Disponibilités</a></li>
            <li class="choixMenu"><a>À propos</a></li>
            <li class="choixMenu"><a>Produits</a></li>
            <li class="choixMenu"><a>Contacter</a></li>
          </ul>
        </nav>   
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text">
          <?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

                get_template_part('template-parts/content', 'page');

            endwhile;
        endif;
        ?>
        <?php

 //////////////Nouvelle///////////

echo '<h2>' . category_description( get_category_by_slug( 'nouvelle' )). '</h2>';

  // The 2nd Loop
  while ( $query2->have_posts() ) {
      $query2->the_post();
      the_post_thumbnail('thumbnail');
      echo '<h2>' . get_the_title(). '</h2>';
      echo '<div class="contentNouvelle"  id="event-'.get_the_ID().'">';
      echo '<button class="btnNouvelle" type=button id="'.get_the_ID().'"> Voir plus </button>';
      echo '<div id="nouvelleBtn"></div>';
      echo "</div>";
  }

 /* Restore original Post Data 
  * NB: Because we are using new WP_Query we aren't stomping on the 
  * original $wp_query and it does not need to be reset with 
  * wp_reset_query(). We just need to set the post data back up with
  * wp_reset_postdata().
  */
 wp_reset_postdata();

 echo '<h2>' . category_description( get_category_by_slug( 'evenement' )). '</h2>';
// The Loop
while ( $query1->have_posts() ) {
    $query1->the_post();
    echo "<div class='evenement'>";
    echo '<h2>' . get_the_title() . '</h2>';
    echo the_post_thumbnail('thumbnail');
    echo '<p>' . get_the_excerpt() . '</p>';
    echo "</div>";
}
//  // Restore original Post Data
wp_reset_postdata();

/////////////////ÉVÈNEMENTS////////////////

echo '<section id="evenement">' . category_description( get_category_by_slug( 'evenement' )). '</section>';
// The Loop

while ( $query3->have_posts() ) {
    $query3->the_post();
    echo '<p>' . get_the_title() . ' - ' . get_the_date('d/m/y') . '<p>';
}

//  // Restore original Post Data
wp_reset_postdata();
  
 ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();