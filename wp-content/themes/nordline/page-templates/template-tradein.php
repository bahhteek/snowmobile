<?php
/**
 * Template Name: Трейд-ин
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
$crumbs = array( array( 'label' => 'Трейд-ин' ) );
include get_template_directory() . '/template-parts/page-hero.php';
?>
<section class="section" style="padding-top:8px;">
	<div class="container" style="max-width:640px;">
		<form class="form panel js-lead-form">
			<input type="hidden" name="task" value="Трейд-ин">
			<input name="name" placeholder="Имя" required>
			<input name="phone" type="tel" placeholder="Телефон" required>
			<input name="model" placeholder="Ваша модель и год" required>
			<textarea name="comment" placeholder="Моточасы, состояние и на какую модель хотите пересесть"></textarea>
			<button class="btn btn-primary" type="submit">Отправить на оценку</button>
		</form>
	</div>
</section>
<?php get_footer(); ?>
