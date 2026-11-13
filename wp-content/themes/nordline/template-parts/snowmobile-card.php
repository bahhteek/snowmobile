<?php
$badges = array();
if ( ! empty( $model['badges'] ) && is_array( $model['badges'] ) ) {
	$badges = $model['badges'];
} else {
	if ( ! empty( $model['hit'] ) ) {
		$badges[] = array( 'class' => 'hit', 'label' => 'Хит' );
	}
	if ( ! empty( $model['stock_label'] ) ) {
		$badges[] = array(
			'class' => ( isset( $model['stock'] ) && 'in' === $model['stock'] ) ? 'in' : 'soon',
			'label' => $model['stock_label'],
		);
	}
}
$card_specs = array();
if ( ! empty( $model['specs'] ) && is_array( $model['specs'] ) ) {
	$card_specs = array_slice( $model['specs'], 0, 4 );
} else {
	$card_specs = array(
		array( 'label' => 'Двигатель', 'value' => $model['engine'] ),
		array( 'label' => 'Мощность', 'value' => $model['hp'] ),
		array( 'label' => 'Гусеница', 'value' => $model['track'] ),
		array( 'label' => 'Сценарий', 'value' => $model['use'] ),
	);
}
?>
<article class="card" data-type="<?php echo esc_attr( $model['type'] ); ?>" data-slug="<?php echo esc_attr( $model['slug'] ); ?>">
	<a class="card-media" href="<?php echo esc_url( $model['url'] ); ?>">
		<img src="<?php echo esc_url( $model['image'] ); ?>" alt="<?php echo esc_attr( $model['brand'] . ' ' . $model['name'] ); ?>">
		<?php if ( $badges ) : ?>
			<div class="badges">
				<?php foreach ( $badges as $badge ) : ?>
					<span class="badge <?php echo esc_attr( $badge['class'] ); ?>"><?php echo esc_html( $badge['label'] ); ?></span>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</a>
	<div class="card-body">
		<div class="card-top">
			<div>
				<div class="brand"><?php echo esc_html( trim( $model['brand'] . ( $model['year'] ? ' · ' . $model['year'] : '' ) ) ); ?></div>
				<h3><?php echo esc_html( $model['name'] ); ?></h3>
			</div>
			<div class="price"><?php echo esc_html( $model['price_label'] ); ?><small><?php echo esc_html( $model['type_label'] ); ?></small></div>
		</div>
		<dl class="specs">
			<?php foreach ( $card_specs as $spec ) : ?>
				<div><dt><?php echo esc_html( $spec['label'] ); ?></dt><dd><?php echo esc_html( $spec['value'] ); ?></dd></div>
			<?php endforeach; ?>
		</dl>
		<div class="card-actions">
			<a class="btn btn-primary" href="<?php echo esc_url( $model['url'] ); ?>">Подробнее</a>
			<button class="btn btn-ghost js-lead" type="button" data-model="<?php echo esc_attr( trim( $model['brand'] . ' ' . $model['name'] ) ); ?>">Заявка</button>
		</div>
	</div>
</article>
