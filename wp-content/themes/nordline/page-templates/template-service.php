<?php
/**
 * Template Name: Сервис
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

$service_items = nordline_field(
	'сервис',
	array(
		'заголовок' => '',
		'текст' => '',
	),
	$page_id
);

$form = nordline_field(
	'форма',
	array(
		'надзаголовок' => '',
		'заголовок' => '',
	),
	$page_id
);

$form_title = $form['заголовок'] ?? '';
$form_eyebrow = $form['надзаголовок'] ?? '';

$crumbs = array( array( 'label' => 'Сервис' ) );
include get_template_directory() . '/template-parts/page-hero.php';
?>
<section class="section" style="padding-top:12px;">
	<div class="container info-grid">
		<div class="benefits" style="grid-template-columns:1fr 1fr;">
			<?php $i = 1; foreach ( $service_items as $item ) : ?>
				<article class="benefit"><b><?=$i < 10 ? '0' . $i : $i;?></b><h3><?=$item['заголовок'];?></h3><?=$item['текст'];?></article>
			<?php $i++; endforeach; ?>
		</div>
		<div class="panel">
			<p class="eyebrow"><?=$form_eyebrow;?></p>
			<h2 style="font-size:42px;margin:10px 0 14px;"><?=$form_title;?></h2>
			<form class="form js-lead-form">
				<input name="name" placeholder="Имя" required>
				<input name="phone" type="tel" placeholder="Телефон" required>
				<select name="task" required>
					<option value="">Работы</option>
					<option>Сезонное ТО</option>
					<option>Хранение</option>
					<option>Гарантия</option>
					<option>Диагностика</option>
					<option>Ремонт</option>
				</select>
				<textarea name="comment" placeholder="Модель и что беспокоит"></textarea>
				<button class="btn btn-primary" type="submit">Записаться</button>
			</form>
		</div>
	</div>
</section>
<?php get_footer(); ?>
