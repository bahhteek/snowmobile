<?php
/**
 * Template Name: Каталог
 */
get_header();

$section1 = nordline_field(
	'секция_1',
	array(
		'надзаголовок' => '',
		'заголовок'    => '',
		'текст'        => '',
		'картинка'     => array(),
	),
	$page_id
);

$eyebrow = $section1['надзаголовок'] ?? '';
$title   = $section1['заголовок'] ?? '';
$lead    = $section1['текст'] ?? '';
$image = $section1['картинка']['url'] ?? '';

$type  = isset( $_GET['type'] ) ? sanitize_title( wp_unslash( $_GET['type'] ) ) : '';
$brand = isset( $_GET['brand'] ) ? sanitize_title( wp_unslash( $_GET['brand'] ) ) : '';
if ( is_tax( 'ride_type' ) ) {
	$type = get_queried_object()->slug;
}
if ( is_tax( 'brand' ) ) {
	$brand = get_queried_object()->slug;
}
$models = nordline_get_models( array( 'type' => $type, 'brand' => $brand ) );
$types  = nordline_get_types();

if ( $brand ) {
	$brands = nordline_get_brands();
	if ( isset( $brands[ $brand ] ) ) {
		$title = $brands[ $brand ]['name'];
		$lead  = $brands[ $brand ]['text'] ? $brands[ $brand ]['text'] : $lead;
	}
}
$crumbs = array( array( 'label' => 'Каталог' ) );
include get_template_directory() . '/template-parts/page-hero.php';
?>
<section class="section" style="padding-top:28px;">
	<div class="container">
		<div class="filters">
			<a class="chip<?php echo $type ? '' : ' active'; ?>" href="<?php echo esc_url( nordline_page_url( 'katalog' ) ); ?>">Все типы</a>
			<?php foreach ( $types as $slug => $item ) : ?>
				<a class="chip<?php echo $type === $slug ? ' active' : ''; ?>" href="<?php echo esc_url( add_query_arg( array( 'type' => $slug, 'brand' => $brand ), nordline_page_url( 'katalog' ) ) ); ?>"><?php echo esc_html( $item['name'] ); ?></a>
			<?php endforeach; ?>
		</div>
		<div class="filters">
			<a class="chip<?php echo $brand ? '' : ' active'; ?>" href="<?php echo esc_url( $type ? add_query_arg( 'type', $type, nordline_page_url( 'katalog' ) ) : nordline_page_url( 'katalog' ) ); ?>">Все бренды</a>
			<?php foreach ( nordline_get_brands() as $slug => $item ) : ?>
				<a class="chip<?php echo $brand === $slug ? ' active' : ''; ?>" href="<?php echo esc_url( add_query_arg( array( 'brand' => $slug, 'type' => $type ), nordline_page_url( 'katalog' ) ) ); ?>"><?php echo esc_html( $item['name'] ); ?></a>
			<?php endforeach; ?>
		</div>
		<p class="muted" style="margin: 8px 0 18px;">Найдено: <?php echo esc_html( (string) count( $models ) ); ?></p>
		<div class="catalog-grid">
			<?php
			if ( $models ) {
				foreach ( $models as $model ) {
					include get_template_directory() . '/template-parts/snowmobile-card.php';
				}
			} else {
				echo '<p class="muted">В этой категории нет товаров.</p>';
			}
			?>
		</div>
	</div>
</section>
<?php get_footer(); ?>
