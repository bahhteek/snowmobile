<?php
get_header();
echo '<section class="page-hero"><div class="container"><h1>' . esc_html( wp_title( '', false ) ?: 'Записи' ) . '</h1></div></section>';
echo '<section class="section" style="padding-top:8px;"><div class="container catalog-grid">';
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		echo '<a class="card" href="' . esc_url( get_permalink() ) . '"><div class="card-body"><h3>' . esc_html( get_the_title() ) . '</h3></div></a>';
	}
}
echo '</div></section>';
get_footer();
