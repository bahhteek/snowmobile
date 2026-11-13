<?php get_header(); ?>
<?php
$section1 = nordline_field(
	'секция_1',
	array(
		'надзаголовок' => '',
		'заголовок'    => '',
		'текст'        => '',
		'кнопки' => array(),
		'информация' => array(),
		'картинка'     => array(),
		'текст_картинки' => '',
	),
	$page_id
);

$section2 = nordline_field(
	'секция_2',
	array(
		'надзаголовок' => '',
		'заголовок'    => '',
		'текст'        => '',
	),
	$page_id
);

$section3 = nordline_field(
	'секция_3',
	array(
		'надзаголовок' => '',
		'заголовок'    => '',
		'текст'        => '',
		'кнопка' => array(),
	),
	$page_id
);

$section4 = nordline_field(
	'подбор',
	array(
		'надзаголовок' => '',
		'заголовок'    => '',
		'текст'        => '',
		'вопросы'        => array(),
	),
	$page_id
);

$section5 = nordline_field(
	'почему_nordline',
	array(
		'надзаголовок' => '',
		'заголовок'    => '',
		'текст'        => '',
		'пункты'        => array(),
	),
	$page_id
);

$section6 = nordline_field(
	'после_покупки',
	array(
		'надзаголовок' => '',
		'заголовок'    => '',
		'текст'        => '',
		'блоки' => array(),
	),
	$page_id
);

$section7 = nordline_field(
	'сравнение',
	array(
		'надзаголовок' => '',
		'заголовок'    => '',
		'текст'        => '',
		'снегоходы_для_сравнения'        => array(),
	),
);

$section8 = nordline_field(
	'заявка',
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
$buttons = $section1['кнопки'] ?? array();
$information = $section1['информация'] ?? array();
$image_text = $section1['текст_картинки'] ?? '';
$image = $section1['картинка']['url'] ?? '';

$front_id = (int) get_option( 'page_on_front' );
$models   = nordline_get_models();
$compare  = array();
$picked   = $section7['снегоходы_для_сравнения'] ?? array();
if ( is_array( $picked ) ) {
	foreach ( $picked as $post ) {
		if ( is_numeric( $post ) ) {
			$post = get_post( (int) $post );
		}
		if ( $post instanceof WP_Post ) {
			$compare[] = nordline_model_from_post( $post );
		}
	}
}
$quiz_models = array();
foreach ( $models as $model ) {
	$quiz_models[] = array(
		'name'       => trim( $model['brand'] . ' ' . $model['name'] ),
		'type'       => $model['type'],
		'typeLabel'  => $model['type_label'],
		'price'      => (int) preg_replace( '/[^\d]/', '', (string) $model['price_label'] ),
		'priceLabel' => $model['price_label'],
		'use'        => $model['use'],
		'seats'      => $model['seats'],
		'url'        => $model['url'],
	);
}
wp_add_inline_script(
	'nordline',
	'window.nordlineQuiz = ' . wp_json_encode( array( 'models' => $quiz_models ) ) . ';',
	'before'
);
?>

<section class="hero">
	<div class="hero-media">
		<img src="<?php echo esc_url( nordline_img( 'hero.jpg' ) ); ?>" alt="Зимний склон">
	</div>
	<div class="container hero-grid">
		<div class="hero-content">
			<p class="eyebrow"><?= $eyebrow; ?></p>
			<h1><?php echo nl2br( esc_html( $title ) ); ?></h1>
			<p class="hero-lead"><?php echo esc_html( $lead ); ?></p>
			<?php if ( count( $buttons ) > 0 ) : ?>
				<div class="hero-actions">
					<?php if ($buttons['кнопка_1']['текст'] && $buttons['кнопка_1']['ссылка']) : ?>
					<a class="btn btn-primary" href="<?php echo esc_url( $buttons['кнопка_1']['ссылка'] ); ?>"><?php echo esc_html( $buttons['кнопка_1']['текст'] ); ?></a>
					<?php endif; ?>
					<?php if ($buttons['кнопка_2']['ссылка'] && $buttons['кнопка_2']['текст']) : ?>
					<a class="btn btn-ghost" href="<?php echo esc_url( $buttons['кнопка_2']['ссылка'] ); ?>"><?php echo esc_html( $buttons['кнопка_2']['текст'] ); ?></a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<div class="hero-stats">
				<?php if ( count( $information ) > 0 ) : ?>
					<?php foreach ( $information as $item ) : ?>
						<div><b><?php echo esc_html( $item['заголовок'] ); ?></b><span><?php echo esc_html( $item['текст'] ); ?></span></div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
		<figure class="hero-sled">
			<?php if ($image) : ?>
			<img src="<?php echo esc_url( $image ); ?>" alt="Снегоход на снегу">
			<?php endif; ?>
			<figcaption><?php echo esc_html( $image_text ); ?></figcaption>
		</figure>
	</div>
</section>

<section class="section" id="types">
	<div class="container">
		<div class="section-head">
			<div>
				<p class="eyebrow"><?=$section2['надзаголовок']?></p>
				<h2><?=$section2['заголовок']?></h2>
			</div>
			<p><?=$section2['текст']?></p>
		</div>
		<div class="ride-grid">
			<?php foreach ( nordline_get_types() as $type ) : ?>
				<a class="ride-card" href="<?php echo esc_url( $type['url'] ); ?>">
					<img src="<?php echo esc_url( $type['image'] ); ?>" alt="<?php echo esc_attr( $type['name'] ); ?>">
					<div>
						<?php if ( ! empty( $type['label'] ) ) : ?><small><?php echo esc_html( $type['label'] ); ?></small><?php endif; ?>
						<h3><?php echo esc_html( $type['name'] ); ?></h3>
						<p><?php echo esc_html( $type['text'] ); ?></p>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
		<div class="filters" style="margin-top: 16px;">
			<?php foreach ( nordline_get_brands() as $slug => $brand ) : ?>
				<a class="chip" href="<?php echo esc_url( $brand['url'] ); ?>"><?php echo esc_html( $brand['name'] ); ?></a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section" id="lineup" style="background: var(--bg-2);">
	<div class="container">
		<div class="section-head">
			<div>
				<p class="eyebrow"><?=$section3['надзаголовок']?></p>
				<h2><?=$section3['заголовок']?></h2>
			</div>
			<p><?=$section3['текст']?></p>
		</div>
		<div class="filters" id="filters">
			<button class="chip active" data-filter="all" type="button">Все</button>
			<?php
			$demo_type_slugs = array();
			if ( ! nordline_has_posts( 'snowmobile' ) ) {
				foreach ( nordline_demo_types() as $demo_slug => $demo_type ) {
					$demo_type_slugs[ $demo_type['name'] ] = $demo_slug;
				}
			}
			foreach ( nordline_get_types() as $slug => $type ) :
				$filter = isset( $demo_type_slugs[ $type['name'] ] ) ? $demo_type_slugs[ $type['name'] ] : $slug;
				?>
				<button class="chip" data-filter="<?php echo esc_attr( $filter ); ?>" type="button"><?php echo esc_html( $type['name'] ); ?></button>
			<?php endforeach; ?>
		</div>
		<div class="catalog-grid" id="catalog">
			<?php foreach ( $models as $model ) { include get_template_directory() . '/template-parts/snowmobile-card.php'; } ?>
			<p class="muted catalog-empty<?php echo $models ? '' : ' is-visible'; ?>" id="catalogEmpty">В этой категории нет товаров.</p>
		</div>
		<?php if ($section3['кнопка']['текст'] && $section3['кнопка']['ссылка']) : ?>
		<p style="margin-top: 22px;"><a class="btn btn-ghost" href="<?php echo esc_url( $section3['кнопка']['ссылка'] ); ?>"><?php echo esc_html( $section3['кнопка']['текст'] ); ?></a></p>
		<?php endif; ?>
	</div>
</section>

<section class="section" id="quiz">
	<div class="container">
		<div class="quiz">
			<div class="quiz-copy">
				<p class="eyebrow"><?=$section4['надзаголовок']?></p>
				<h2><?=$section4['заголовок']?></h2>
				<p><?=$section4['текст']?></p>
				<?php if (count($section4['вопросы']) > 0) : ?>
					<ul class="steps">
						<?php $i = 1; foreach ($section4['вопросы'] as $question) : ?>
							<li><span class="num"><?=$i;?></span><div><?=$question['вопрос']?></div></li>
						<?php $i++; endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
			<div class="quiz-widget">
				<div class="quiz-progress" id="quizProgress"><i class="on"></i><i></i><i></i></div>
				<div id="quizStep">
					<h3 id="quizTitle">Где будете ездить?</h3>
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

<section class="section" style="background: var(--bg-2);">
	<div class="container">
		<div class="section-head">
			<div>
				<p class="eyebrow"><?=$section5['надзаголовок']?></p>
				<h2><?=$section5['заголовок']?></h2>
			</div>
			<p><?=$section5['текст']?></p>
		</div>
		<?php if (count($section5['пункты']) > 0) : ?>
		<div class="benefits">
			<?php $i = 1; foreach ($section5['пункты'] as $item) : ?>
			<article class="benefit"><b><?=$i > 10 ? $i : '0' . $i;?></b><h3><?=$item['заголовок']?></h3><p><?=$item['текст']?></p></article>
			<?php $i++; endforeach; ?>
		</div>
		<?php endif; ?>
	</div>
</section>

<section class="section" id="service">
	<div class="container">
		<div class="section-head">
			<div>
				<p class="eyebrow"><?=$section6['надзаголовок']?></p>
				<h2><?=$section6['заголовок']?></h2>
			</div>
			<p><?=$section6['текст']?></p>
		</div>
		<?php if (count($section6['блоки']) > 0) : ?>
			<div class="split">
				<?php $i = 1; foreach ($section6['блоки'] as $item) : ?>
					<article class="split-card">
						<img src="<?=$item['картинка']['url'];?>" alt="<?=$item['заголовок'];?>">
						<div class="inner">
							<small class="eyebrow"><?=$item['надзаголовок'];?></small>
							<h3><?=$item['заголовок'];?></h3>
							<p><?=$item['текст'];?></p>
							<?php if ($item['кнопка']['ссылка'] && $item['кнопка']['текст']) : ?>
								<a class="btn <?=$i % 2 !== 0 ? 'btn-primary' : 'btn-ghost' ?>" href="<?=$item['кнопка']['ссылка'];?>"><?=$item['кнопка']['текст'];?></a>
							<?php endif; ?>
						</div>
					</article>
				<?php $i++; endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>

<section class="section" id="compare" style="background: var(--bg-2);">
	<div class="container">
		<div class="section-head">
			<div>
				<p class="eyebrow"><?=$section7['надзаголовок']?></p>
				<h2><?=$section7['заголовок']?></h2>
			</div>
			<p><?=$section7['текст']?></p>
		</div>
		<?php if ( $compare ) : ?>
		<div class="table-wrap">
			<table class="compare-table">
				<thead>
					<tr>
						<th>Параметр</th>
						<?php foreach ( $compare as $model ) : ?><th><?php echo esc_html( $model['name'] ); ?></th><?php endforeach; ?>
					</tr>
				</thead>
				<tbody>
					<?php
					$rows = array(
						'Тип езды' => 'type_label',
						'Двигатель' => 'engine',
						'Мощность' => 'hp',
						'Гусеница' => 'track',
						'Цена от' => 'price_label',
						'Статус' => 'stock_label',
					);
					foreach ( $rows as $label => $key ) :
						?>
						<tr>
							<td><?php echo esc_html( $label ); ?></td>
							<?php foreach ( $compare as $model ) : ?><td><?php echo esc_html( $model[ $key ] ); ?></td><?php endforeach; ?>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<?php endif; ?>
	</div>
</section>

<section class="section" id="lead">
	<div class="container">
		<div class="lead">
			<div>
				<p class="eyebrow"><?=$section8['надзаголовок']?></p>
				<h2><?=$section8['заголовок']?></h2>
				<p><?=$section8['текст']?></p>
			</div>
			<form class="form js-lead-form">
				<input name="name" type="text" placeholder="Имя" required>
				<input name="phone" type="tel" placeholder="Телефон" required>
				<select name="task" required>
					<option value="">Задача</option>
					<option>Горы и глубокий снег</option>
					<option>Трасса</option>
					<option>Туризм 1+1</option>
					<option>Охота / рыбалка</option>
					<option>Хозяйство и работа</option>
				</select>
				<textarea name="comment" placeholder="Модель, бюджет или вопрос"></textarea>
				<button class="btn btn-primary" type="submit">Отправить заявку</button>
				<p class="note">Заявка сохраняется в разделе «Заявки». Онлайн-оплаты нет.</p>
			</form>
		</div>
	</div>
</section>

<?php get_footer(); ?>
