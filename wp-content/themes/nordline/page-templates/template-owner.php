<?php
/**
 * Template Name: Владельцу
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
$owner_items = nordline_field(
	'блоки',
	array(
		'заголовок' => '',
		'текст' => '',
	),
	$page_id
);
$crumbs = array( array( 'label' => 'Владельцу' ) );
include get_template_directory() . '/template-parts/page-hero.php';
?>
<section class="section" style="padding-top:8px;">
	<div class="container catalog-grid">
		<?php foreach ($owner_items as $item) : ?>
			<article class="panel">
				<h3><?php echo esc_html( $item['заголовок'] ); ?></h3>
				<p class="muted"><?php echo esc_html( $item['текст'] ); ?></p>
			</article>
		<?php endforeach; ?>
	</div>
</section>
<?php get_footer(); ?>
