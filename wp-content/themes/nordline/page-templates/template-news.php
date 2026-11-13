<?php
/**
 * Template Name: Новости
 */
get_header();
$article = isset( $_GET['article'] ) ? sanitize_title( wp_unslash( $_GET['article'] ) ) : '';
$item    = $article ? nordline_find_news( $article ) : null;
if ( $item && empty( $item['post_id'] ) && ! nordline_has_posts( 'post' ) ) :
	?>
	<section class="section" style="padding-top:36px;">
		<div class="container" style="max-width:860px;">
			<div class="crumbs">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a><span>/</span>
				<a href="<?php echo esc_url( nordline_page_url( 'novosti' ) ); ?>">Новости</a><span>/</span>
				<span><?php echo esc_html( $item['title'] ); ?></span>
			</div>
			<p class="eyebrow"><?php echo esc_html( $item['date'] ); ?></p>
			<h1><?php echo esc_html( $item['title'] ); ?></h1>
			<div class="article-hero"><img src="<?php echo esc_url( $item['image'] ); ?>" alt=""></div>
			<div class="prose"><?php echo wp_kses_post( $item['html'] ); ?></div>
			<p style="margin-top:22px;"><button class="btn btn-primary js-lead" type="button">Оставить заявку</button></p>
		</div>
	</section>
	<?php
else :
	$section1 = nordline_field(
		'новости',
		array(
			'надзаголовок' => '',
			'заголовок'    => '',
		),
		$page_id
	);
	$title = $section1['заголовок'] ?? ''; 
	$eyebrow = $section1['надзаголовок'] ?? ''; 
	$image = ''; 
	$lead = '';
	$crumbs = array( array( 'label' => 'Новости' ) );
	include get_template_directory() . '/template-parts/page-hero.php';
	?>
	<section class="section" style="padding-top:8px;">
		<div class="container catalog-grid">
			<?php foreach ( nordline_get_news() as $news ) : ?>
				<a class="card" href="<?php echo esc_url( $news['url'] ); ?>">
					<div class="card-media"><img src="<?php echo esc_url( $news['image'] ); ?>" alt=""></div>
					<div class="card-body">
						<div class="brand"><?php echo esc_html( $news['date'] ); ?></div>
						<h3><?php echo esc_html( $news['title'] ); ?></h3>
						<p class="muted"><?php echo esc_html( $news['lead'] ); ?></p>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</section>
	<?php
endif;
get_footer();
