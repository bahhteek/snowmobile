<?php
get_header();
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		$title   = get_the_title();
		$eyebrow = '';
		$lead    = '';
		$crumbs  = array();
		$image   = '';
		$image   = '';
		include get_template_directory() . '/template-parts/page-hero.php';
		echo '<section class="section" style="padding-top:8px;"><div class="container prose">';
		the_content();
		echo '</div></section>';
	endwhile;
endif;
get_footer();
