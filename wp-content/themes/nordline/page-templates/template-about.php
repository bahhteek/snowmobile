<?php
/**
 * Template Name: О компании
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
$picture = is_array( $section1['картинка'] ?? null ) ? $section1['картинка'] : array();
$image   = $picture['url'] ?? "";

$blocks = nordline_field(
	'блоки',
	array(
		'надзаголовок' => '',
		'заголовок' => '',
		'текст' => '',
	),
	$page_id
);

$crumbs = array( array( 'label' => 'О нас' ) );
include get_template_directory() . '/template-parts/page-hero.php';
?>
<section class="section" style="padding-top:12px;">
	<div class="container benefits">
		<?php foreach ( $blocks as $block ) : ?>
			<article class="benefit"><b><?=$block['надзаголовок'];?></b><h3><?=$block['заголовок'];?></h3><p><?=$block['текст'];?></p></article>
		<?php endforeach; ?>
	</div>
</section>
<?php get_footer(); ?>
