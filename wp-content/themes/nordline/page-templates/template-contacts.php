<?php
/**
 * Template Name: Контакты
 */
get_header();

$page_id = get_queried_object_id();

$section1 = nordline_field(
	'1_секция',
	array(
		'надзаголовок' => '',
		'заголовок'    => '',
		'текст'        => '',
	),
	$page_id
);

$section2 = nordline_field(
	'2_секция',
	array(
		'картинка'     => array(),
		'заголовок'    => 'Нужно указать заголовок',
		'адрес'        => 'Нужно указать адрес',
		'телефон'      => 'Нужно указать телефон',
		'почта'        => 'Нужно указать почту',
		'график'       => 'Нужно указать график',
		'текст_кнопки' => 'Нужно указать текст кнопки',
	),
	$page_id
);

$eyebrow = $section1['надзаголовок'] ?? '';
$title   = $section1['заголовок'] ?? '';
$lead    = $section1['текст'] ?? '';
$image   = '';
$crumbs  = array(
	array( 'label' => 'Контакты' ),
);

$section2_title = $section2['заголовок'] ?? '';
$address        = $section2['адрес'] ?? '';
$phone          = $section2['телефон'] ?? '';
$email          = $section2['почта'] ?? '';
$hours          = $section2['график'] ?? '';
$button_text    = $section2['текст_кнопки'] ?? '';
$picture        = is_array( $section2['картинка'] ?? null ) ? $section2['картинка'] : array();
$picture_url    = $picture['url'] ?? '';
$picture_alt    = $picture['alt'] ?? '';

include get_template_directory() . '/template-parts/page-hero.php';
?>
<section class="section" style="padding-top:8px;">
	<div class="container contact-grid">
		<div class="panel">
			<h3 style="font-size:36px;margin-bottom:12px;"><?php echo esc_html( $section2_title ); ?></h3>
			<p><?php echo esc_html( $address ); ?></p>
			<p>
				<a href="<?php echo esc_url( 'tel:' . preg_replace( '/[^\d+]/', '', $phone ) ); ?>">
					<?php echo esc_html( $phone ); ?>
				</a>
			</p>
			<p><?php echo esc_html( $email ); ?></p>
			<p class="muted" style="margin:12px 0 18px;"><?php echo esc_html( $hours ); ?></p>
			<button class="btn btn-primary js-lead" type="button"><?php echo esc_html( $button_text ); ?></button>
		</div>
		<div
			class="map-fake"
			<?php if ( $picture_url ) : ?>
				style="background-image: url('<?php echo esc_url( $picture_url ); ?>')"
			<?php endif; ?>
			<?php if ( $picture_alt ) : ?>
				role="img"
				aria-label="<?php echo esc_attr( $picture_alt ); ?>"
			<?php endif; ?>
		></div>
	</div>
</section>
<?php get_footer(); ?>