<?php
/**
 * Template Name: Аксессуары
 */
get_header();
$section1 = nordline_field(
	'1_секция',
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
$image = "";
$accessories = nordline_field(
	'аксессуары',
	array(),
	$page_id
);
$crumbs = array( array( 'label' => 'Аксессуары' ) );
include get_template_directory() . '/template-parts/page-hero.php';
?>
<section class="section" style="padding-top:12px;">
	<div class="container catalog-grid">
		<?php foreach ($accessories as $accessory) : ?>
			<article class="card accessory-card">
				<div class="card-media"><img src="<?php echo esc_url( $accessory['картинка']['url'] ); ?>" alt="<?php echo esc_html( $accessory['название'] ); ?>"></div>
				<div class="card-body">
					<h3><?php echo esc_html( $accessory['название'] ); ?></h3>
					<div class="price" style="text-align:left;">от <?php echo esc_html( number_format( (float) $accessory['цена'], 0, ',', ' ' ) ); ?> ₽</div>
					<button class="btn btn-primary js-lead" type="button" data-model="<?php echo esc_attr( $accessory['name'] ); ?>">Запросить</button>
				</div>
			</article>
		<?php endforeach; ?>
	</div>
</section>
<?php get_footer(); ?>
