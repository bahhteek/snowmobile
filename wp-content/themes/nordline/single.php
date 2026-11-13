<?php
get_header();
while ( have_posts() ) :
	the_post();
	$image = get_the_post_thumbnail_url( null, 'large' );
	?>
	<section class="section" style="padding-top:36px;">
		<div class="container" style="max-width:860px;">
			<div class="crumbs">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a><span>/</span>
				<a href="<?php echo esc_url( nordline_page_url( 'novosti' ) ); ?>">Новости</a><span>/</span>
				<span><?php the_title(); ?></span>
			</div>
			<p class="eyebrow"><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></p>
			<h1><?php the_title(); ?></h1>
			<?php if ( $image ) : ?><div class="article-hero"><img src="<?php echo esc_url( $image ); ?>" alt=""></div><?php endif; ?>
			<div class="prose"><?php the_content(); ?></div>
			<p style="margin-top:22px;"><button class="btn btn-primary js-lead" type="button">Оставить заявку</button></p>
		</div>
	</section>
	<?php
endwhile;
get_footer();
