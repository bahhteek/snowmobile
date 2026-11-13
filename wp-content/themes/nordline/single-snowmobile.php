<?php
get_header();
$model = isset( $GLOBALS['nordline_current_model'] ) ? $GLOBALS['nordline_current_model'] : null;
if ( ! $model && is_singular( 'snowmobile' ) ) {
	$model = nordline_model_from_post( get_queried_object() );
}
if ( ! $model ) {
	$model = nordline_find_model( 'summit' );
}
?>
<section class="section" style="padding-top:36px;">
	<div class="container">
		<div class="crumbs">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a><span>/</span>
			<a href="<?php echo esc_url( nordline_page_url( 'katalog' ) ); ?>">Каталог</a><span>/</span>
			<span><?php echo esc_html( $model['name'] ); ?></span>
		</div>
		<div class="product">
			<div>
				<div class="gallery-main"><img id="mainPhoto" src="<?php echo esc_url( $model['image'] ); ?>" alt="<?php echo esc_attr( $model['name'] ); ?>"></div>
				<div class="thumbs" id="thumbs">
					<?php foreach ( $model['gallery'] as $index => $src ) : ?>
						<button type="button" class="<?php echo 0 === $index ? 'active' : ''; ?>" data-src="<?php echo esc_url( $src ); ?>"><img src="<?php echo esc_url( $src ); ?>" alt=""></button>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="buy-box">
				<div class="brand"><?php echo esc_html( trim( $model['brand'] . ( $model['year'] ? ' · ' . $model['year'] : '' ) ) ); ?></div>
				<h1><?php echo esc_html( $model['name'] ); ?></h1>
				<p class="muted"><?php echo esc_html( trim( $model['type_label'] . ( $model['use'] ? ' · ' . $model['use'] : '' ) ) ); ?></p>
				<?php if ( ! empty( $model['badges'] ) ) : ?>
					<div class="badges badges-inline">
						<?php foreach ( $model['badges'] as $badge ) : ?>
							<span class="badge <?php echo esc_attr( $badge['class'] ); ?>"><?php echo esc_html( $badge['label'] ); ?></span>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
				<div class="price" style="text-align:left;margin:16px 0;"><?php echo esc_html( $model['price_label'] ); ?></div>
				<dl class="specs">
					<?php
					$buy_specs = ! empty( $model['specs'] ) ? $model['specs'] : array(
						array( 'label' => 'Двигатель', 'value' => $model['engine'] ),
						array( 'label' => 'Мощность', 'value' => $model['hp'] ),
						array( 'label' => 'Гусеница', 'value' => $model['track'] ),
						array( 'label' => 'Посадка', 'value' => $model['seats'] ),
					);
					foreach ( $buy_specs as $spec ) :
						?>
						<div><dt><?php echo esc_html( $spec['label'] ); ?></dt><dd><?php echo esc_html( $spec['value'] ); ?></dd></div>
					<?php endforeach; ?>
				</dl>
				<div class="card-actions" style="margin-top:18px;">
					<button class="btn btn-primary js-lead" type="button" data-model="<?php echo esc_attr( trim( $model['brand'] . ' ' . $model['name'] ) ); ?>">Запросить цену</button>
					<a class="btn btn-ghost" href="<?php echo esc_url( nordline_page_url( 'sravnenie' ) ); ?>">В сравнение</a>
				</div>
				<p class="note" style="margin-top:12px;">Онлайн-оплаты нет. Заявка уходит менеджеру: наличие, комплектация, счёт.</p>
			</div>
		</div>
		<div class="tabs">
			<button class="chip active" data-tab="about" type="button">Описание</button>
			<button class="chip" data-tab="spec" type="button">Характеристики</button>
			<?php if ( ! empty( $model['configs'] ) ) : ?><button class="chip" data-tab="cfg" type="button">Комплектации</button><?php endif; ?>
		</div>
		<div class="tab-panel show panel" id="about">
			<div class="prose"><?php echo wp_kses_post( false !== strpos( $model['desc'], '<' ) ? $model['desc'] : wpautop( $model['desc'] ) ); ?></div>
			<p class="muted" style="margin-top:12px;">Гарантия 12 месяцев. Предпродажная подготовка и постановка на сервис — в этом же салоне.</p>
		</div>
		<div class="tab-panel panel" id="spec">
			<table class="compare-table">
				<tbody>
					<?php if ( $model['brand'] ) : ?><tr><td>Бренд</td><td><?php echo esc_html( $model['brand'] ); ?></td></tr><?php endif; ?>
					<?php if ( $model['type_label'] ) : ?><tr><td>Подкатегория</td><td><?php echo esc_html( $model['type_label'] ); ?></td></tr><?php endif; ?>
					<?php foreach ( $buy_specs as $spec ) : ?>
						<tr><td><?php echo esc_html( $spec['label'] ); ?></td><td><?php echo esc_html( $spec['value'] ); ?></td></tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<div class="tab-panel panel" id="cfg">
			<ul class="prose">
				<?php foreach ( $model['configs'] as $config ) : ?><li><?php echo esc_html( $config ); ?></li><?php endforeach; ?>
			</ul>
			<?php if ( ! $model['configs'] ) : ?><p class="muted">Комплектации появятся из повторителя SCF «configs».</p><?php endif; ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>
