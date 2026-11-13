<?php
/**
 * Template Name: Политика
 */
get_header();
$title = nordline_field(
	'заголовок',
	"",
	$page_id
);
$eyebrow = ''; 
$image = ''; 
$lead = '';
$text = nordline_field(
	'текст',
	"",
	$page_id
);
$crumbs = array( array( 'label' => 'Политика' ) );
include get_template_directory() . '/template-parts/page-hero.php';
?>
<section class="section" style="padding-top:8px;">
	<div class="container prose">
		<?=$text;?>
	</div>
</section>
<?php get_footer(); ?>
