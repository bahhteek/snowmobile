<?php
/**
 * Template Name: Сравнение
 */
get_header();
$payload  = array();
$selected = array();
foreach ( nordline_get_models() as $model ) {
	$payload[] = array(
		'slug'        => $model['slug'],
		'brand'       => $model['brand'],
		'name'        => $model['name'],
		'type_label'  => $model['type_label'],
		'price_label' => $model['price_label'],
		'stock_label' => $model['stock_label'],
		'engine'      => $model['engine'],
		'hp'          => $model['hp'],
		'track'       => $model['track'],
		'seats'       => $model['seats'],
		'use'         => $model['use'],
	);
	if ( count( $selected ) < 2 ) {
		$selected[] = $model['slug'];
	}
}
wp_add_inline_script(
	'nordline',
	'window.nordlineCompare = ' . wp_json_encode(
		array(
			'models'   => $payload,
			'selected' => $selected,
		)
	) . ';',
	'before'
);

$section1 = nordline_field(
	'секция_1',
	array(
		'надзаголовок' => '',
		'заголовок'    => '',
		'текст'        => '',
		'картинка'     => array()
	),
	$page_id
);

$eyebrow = $section1['надзаголовок'] ?? '';
$title   = $section1['заголовок'] ?? '';
$lead    = $section1['текст'] ?? '';
$image = $section1['картинка']['url'] ?? '';

$crumbs  = array( array( 'label' => 'Сравнение' ) );
include get_template_directory() . '/template-parts/page-hero.php';
?>
<section class="section" style="padding-top:10px;">
	<div class="container">
		<div class="filters" id="comparePick">
			<?php foreach ( nordline_get_models() as $model ) : ?>
				<button class="chip<?php echo in_array( $model['slug'], $selected, true ) ? ' active' : ''; ?>" type="button" data-slug="<?php echo esc_attr( $model['slug'] ); ?>"><?php echo esc_html( $model['name'] ); ?></button>
			<?php endforeach; ?>
		</div>
		<div class="table-wrap" id="compareTable"></div>
		<p style="margin-top:18px;"><button class="btn btn-primary js-lead" type="button">Запросить сравнение у менеджера</button></p>
	</div>
</section>
<?php get_footer(); ?>
