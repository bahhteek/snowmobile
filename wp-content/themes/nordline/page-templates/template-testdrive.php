<?php
/**
 * Template Name: Тест-драйв
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
$picture = is_array( $section1['картинка'] ?? null ) ? $section1['картинка'] : array();
$image   = $picture['url'] ?? "";
$crumbs = array( array( 'label' => 'Тест-драйв' ) );
include get_template_directory() . '/template-parts/page-hero.php';
?>
<section class="section" style="padding-top:12px;">
	<div class="container" style="max-width:640px;">
		<form class="form panel js-lead-form">
			<input type="hidden" name="task" value="Тест-драйв">
			<input name="name" placeholder="Имя" required>
			<input name="phone" type="tel" placeholder="Телефон" required>
			<select name="model" required>
				<option value="">Модель</option>
				<?php foreach ( nordline_get_models() as $model ) : ?>
					<option><?php echo esc_html( trim( $model['brand'] . ' ' . $model['name'] ) ); ?></option>
				<?php endforeach; ?>
			</select>
			<textarea name="comment" placeholder="Удобный день"></textarea>
			<button class="btn btn-primary" type="submit">Забронировать слот</button>
		</form>
	</div>
</section>
<?php get_footer(); ?>
