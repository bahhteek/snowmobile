<?php get_header(); ?>
<section class="page-hero">
	<div class="container">
		<p class="eyebrow">404</p>
		<h1>Такой страницы нет</h1>
		<p class="hero-lead">Вернитесь в каталог или оставьте заявку — подскажем модель.</p>
		<div class="hero-actions">
			<a class="btn btn-primary" href="<?php echo esc_url( nordline_page_url( 'katalog' ) ); ?>">В каталог</a>
			<a class="btn btn-ghost" href="<?php echo esc_url( home_url( '/' ) ); ?>">На главную</a>
		</div>
	</div>
</section>
<?php get_footer(); ?>
