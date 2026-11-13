<?php
/**
 * Template Name: Рассрочка
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
$text = nordline_field(
	'текст_справа_от_формы',
	"",
	$page_id
);
$crumbs = array( array( 'label' => 'Рассрочка' ) );
include get_template_directory() . '/template-parts/page-hero.php';
?>
<section class="section" style="padding-top:8px;">
	<div class="container info-grid">
		<div class="panel">
			<h3 style="font-size:36px;margin-bottom:16px;">Калькулятор</h3>
			<form class="form js-lead-form">
				<label class="muted">Цена, ₽</label>
				<input id="sum" type="number" value="890000">
				<label class="muted">Срок, мес.</label>
				<select id="months"><option>6</option><option selected>12</option><option>18</option><option>24</option></select>
				<p class="price" style="text-align:left;">Платёж ≈ <span id="pay">74 167</span> ₽ / мес.</p>
				<input type="hidden" name="task" value="Рассрочка">
				<input name="name" placeholder="Имя" required>
				<input name="phone" type="tel" placeholder="Телефон" required>
				<textarea name="comment" placeholder="Модель"></textarea>
				<button class="btn btn-primary" type="submit">Оставить заявку на рассрочку</button>
			</form>
		</div>
		<div class="prose">
			<?=$text;?>
		</div>
	</div>
</section>
<?php get_footer(); ?>
