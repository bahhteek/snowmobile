<?php
/**
 * Template Name: Юрлицам
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
$crumbs = array( array( 'label' => 'Юрлицам' ) );
include get_template_directory() . '/template-parts/page-hero.php';
?>
<section class="section" style="padding-top:8px;">
	<div class="container" style="max-width:640px;">
		<form class="form panel js-lead-form">
			<input type="hidden" name="task" value="Юрлицо">
			<input name="model" placeholder="Компания">
			<input name="name" placeholder="Контакт" required>
			<input name="phone" type="tel" placeholder="Телефон" required>
			<textarea name="comment" placeholder="Задача: парк, экспедиция, тендер"></textarea>
			<button class="btn btn-primary" type="submit">Отправить запрос</button>
		</form>
	</div>
</section>
<?php get_footer(); ?>
