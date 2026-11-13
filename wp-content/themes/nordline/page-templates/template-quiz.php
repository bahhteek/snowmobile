<?php
/**
 * Template Name: Подбор
 */
get_header();

$section1 = nordline_field(
	'секция_1',
	array(
		'надзаголовок' => '',
		'заголовок'    => '',
		'текст'        => '',
		'картинка'     => array()
	),
	$page_id
);

$section2 = nordline_field(
	'квиз-блок',
	array(
		'надзаголовок' => '',
		'заголовок'    => '',
		'текст'        => '',
	),
	$page_id
);

$eyebrow = $section1['надзаголовок'] ?? '';
$title   = $section1['заголовок'] ?? '';
$lead    = $section1['текст'] ?? '';
$image = $section1['картинка']['url'] ?? '';
$crumbs  = array( array( 'label' => 'Подбор' ) );
include get_template_directory() . '/template-parts/page-hero.php';
?>
<section class="section" style="padding-top:12px;">
	<div class="container">
		<div class="quiz">
			<div class="quiz-copy">
				<p class="eyebrow"><?php echo $section2['надзаголовок'] ?? ''; ?></p>
				<h2><?php echo $section2['заголовок'] ?? ''; ?></h2>
				<p><?php echo $section2['текст'] ?? ''; ?></p>
			</div>
			<div class="quiz-widget">
				<div class="quiz-progress" id="quizProgress"><i class="on"></i><i></i><i></i></div>
				<div id="quizStep">
					<h3 id="quizTitle"></h3>
					<div class="options" id="quizOptions"></div>
					<div class="quiz-nav">
						<button class="btn btn-ghost" id="quizBack" type="button">Назад</button>
						<button class="btn btn-primary" id="quizNext" type="button">Далее</button>
					</div>
				</div>
				<div class="quiz-result" id="quizResult"></div>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
