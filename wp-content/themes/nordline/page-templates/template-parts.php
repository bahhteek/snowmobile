<?php
/**
 * Template Name: Запчасти
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
$parts = nordline_field(
	'запчасти',
	array(),
	$page_id
);
$crumbs = array( array( 'label' => 'Запчасти' ) );
include get_template_directory() . '/template-parts/page-hero.php';
?>
<section class="section" style="padding-top:8px;">
	<div class="container">
		<div class="catalog-grid">
			<?php foreach ($parts as $part) : ?>
				<article class="panel">
					<div class="brand">Совместимость</div>
					<h3 style="font-size:32px;margin:8px 0;"><?php echo esc_html( $part['название'] ); ?></h3>
					<p class="muted"><?php echo esc_html( $part['модель'] ); ?></p>
					<div class="price" style="text-align:left;margin:12px 0;">от <?php echo esc_html( number_format( (float) $part['цена'], 0, ',', ' ' ) ); ?> ₽</div>
					<button class="btn btn-primary js-lead" type="button" data-model="<?php echo esc_attr( $part['name'] ); ?>">Запросить</button>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>
