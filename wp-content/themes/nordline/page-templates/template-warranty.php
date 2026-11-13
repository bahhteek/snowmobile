<?php
/**
 * Template Name: Гарантия
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
$crumbs = array(
	array( 'label' => 'Сервис', 'url' => nordline_page_url( 'servis' ) ),
	array( 'label' => 'Гарантия' ),
);

$text = nordline_field(
	'текст',
	"",
	$page_id
);

$button_text = nordline_field(
	'текст_кнопки',
	"",
	$page_id
);

include get_template_directory() . '/template-parts/page-hero.php';
?>
<section class="section" style="padding-top:8px;">
	<div class="container prose">
		<?=$text;?>
		<button class="btn btn-primary js-lead" type="button" style="margin-top:18px;" data-model="Гарантийное обращение"><?=$button_text;?></button>
	</div>
</section>
<?php get_footer(); ?>
