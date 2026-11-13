<?php
/**
 * Template Name: Карта сайта
 */
get_header();
$title = 'Карта сайта'; $eyebrow = 'Все разделы'; $image = '';
$lead = 'Навигация по страницам салона: каталог, подбор, сервис и заявки. Онлайн-оплаты нет.';
$crumbs = array( array( 'label' => 'Карта сайта' ) );
include get_template_directory() . '/template-parts/page-hero.php';
$pages = nordline_pages();
?>
<section class="section" style="padding-top:8px;">
	<div class="container sitemap">
		<div class="sitemap-col">
			<h2>Каталог</h2>
			<ul>
				<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a></li>
				<li><a href="<?php echo esc_url( nordline_page_url( 'katalog' ) ); ?>">Вся техника</a></li>
				<?php foreach ( nordline_get_categories() as $slug => $category ) : ?>
					<li>
						<a href="<?php echo esc_url( $category['url'] ); ?>"><?php echo esc_html( $category['name'] ); ?></a>
						<?php $children = nordline_get_category_children( $slug ); ?>
						<?php if ( $children ) : ?>
							<ul>
								<?php foreach ( $children as $child ) : ?>
									<li><a href="<?php echo esc_url( $child['url'] ); ?>"><?php echo esc_html( $child['name'] ); ?></a></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
				<li><a href="<?php echo esc_url( nordline_page_url( 'podbor' ) ); ?>">Подбор снегохода</a></li>
				<li><a href="<?php echo esc_url( nordline_page_url( 'sravnenie' ) ); ?>">Сравнение моделей</a></li>
			</ul>
		</div>
		<div class="sitemap-col">
			<h2>Бренды и модели</h2>
			<ul>
				<?php foreach ( nordline_get_brands() as $brand ) : ?>
					<li><a href="<?php echo esc_url( $brand['url'] ); ?>"><?php echo esc_html( $brand['name'] ); ?></a></li>
				<?php endforeach; ?>
				<?php foreach ( nordline_get_models() as $model ) : ?>
					<li><a href="<?php echo esc_url( $model['url'] ); ?>"><?php echo esc_html( trim( $model['brand'] . ' ' . $model['name'] ) ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="sitemap-col">
			<h2>Покупка и сервис</h2>
			<ul>
				<?php foreach ( array( 'rassrochka', 'treyd-in', 'test-drayv', 'yurlicam', 'servis', 'garantiya', 'zapchasti', 'aksessuary', 'vladeltsu' ) as $slug ) : ?>
					<li><a href="<?php echo esc_url( nordline_page_url( $slug ) ); ?>"><?php echo esc_html( $pages[ $slug ][0] ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="sitemap-col">
			<h2>Компания</h2>
			<ul>
				<?php foreach ( array( 'o-kompanii', 'kontakty', 'novosti', 'politika' ) as $slug ) : ?>
					<li><a href="<?php echo esc_url( nordline_page_url( $slug ) ); ?>"><?php echo esc_html( $pages[ $slug ][0] ); ?></a></li>
				<?php endforeach; ?>
				<?php foreach ( nordline_get_news() as $news ) : ?>
					<li><a href="<?php echo esc_url( $news['url'] ); ?>"><?php echo esc_html( $news['title'] ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</section>
<?php get_footer(); ?>
