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

$brand    = isset( $_GET['brand'] ) ? sanitize_title( wp_unslash( $_GET['brand'] ) ) : '';
$category = isset( $_GET['category'] ) ? sanitize_title( wp_unslash( $_GET['category'] ) ) : '';
if ( is_tax( 'brand' ) ) {
	$brand = get_queried_object()->slug;
}
if ( is_tax( 'equipment' ) ) {
	$category = get_queried_object()->slug;
}

$category_term = $category ? get_term_by( 'slug', $category, 'equipment' ) : null;
$parent_slug   = '';
$sub_slug      = '';
if ( $category_term && ! is_wp_error( $category_term ) ) {
	if ( $category_term->parent ) {
		$parent_term = get_term( (int) $category_term->parent, 'equipment' );
		$parent_slug = ( $parent_term && ! is_wp_error( $parent_term ) ) ? $parent_term->slug : '';
		$sub_slug    = $category_term->slug;
	} else {
		$parent_slug = $category_term->slug;
	}
}

$models     = nordline_get_models( array( 'brand' => $brand, 'category' => $sub_slug ? $sub_slug : $parent_slug ) );
$categories = nordline_get_categories();
$children   = $parent_slug ? nordline_get_category_children( $parent_slug ) : array();

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
			<a class="chip<?php echo $parent_slug ? '' : ' active'; ?>" href="<?php echo esc_url( nordline_page_url( 'katalog' ) ); ?>">Вся техника</a>
			<?php foreach ( $categories as $slug => $item ) : ?>
				<a class="chip<?php echo $parent_slug === $slug ? ' active' : ''; ?>" href="<?php echo esc_url( add_query_arg( 'category', $slug, nordline_page_url( 'katalog' ) ) ); ?>"><?php echo esc_html( $item['name'] ); ?></a>
			<?php endforeach; ?>
		</div>
		<?php if ( $children ) : ?>
		<div class="filters">
			<a class="chip<?php echo $sub_slug ? '' : ' active'; ?>" href="<?php echo esc_url( add_query_arg( array_filter( array( 'category' => $parent_slug, 'brand' => $brand ) ), nordline_page_url( 'katalog' ) ) ); ?>">Все</a>
			<?php foreach ( $children as $slug => $item ) : ?>
				<a class="chip<?php echo $sub_slug === $slug ? ' active' : ''; ?>" href="<?php echo esc_url( add_query_arg( array_filter( array( 'category' => $slug, 'brand' => $brand ) ), nordline_page_url( 'katalog' ) ) ); ?>"><?php echo esc_html( $item['name'] ); ?></a>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
		<div class="filters">
			<a class="chip<?php echo $brand ? '' : ' active'; ?>" href="<?php echo esc_url( add_query_arg( array_filter( array( 'category' => $sub_slug ? $sub_slug : $parent_slug ) ), nordline_page_url( 'katalog' ) ) ); ?>">Все бренды</a>
			<?php foreach ( nordline_get_brands() as $slug => $item ) : ?>
				<a class="chip<?php echo $brand === $slug ? ' active' : ''; ?>" href="<?php echo esc_url( add_query_arg( array_filter( array( 'brand' => $slug, 'category' => $sub_slug ? $sub_slug : $parent_slug ) ), nordline_page_url( 'katalog' ) ) ); ?>"><?php echo esc_html( $item['name'] ); ?></a>
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
