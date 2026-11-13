<?php
$header = nordline_field( 'шапка', array(
	'телефон' => "",
), 4 );
$phone = $header['телефон'] ?? "";
$items = nordline_nav_items( 'primary' );
if ( ! $items ) {
	$fallback = nordline_default_nav();
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="grain"></div>

<div class="ticker">
	<div class="ticker-track">
		<?php for ( $i = 0; $i < 2; $i++ ) : ?>
			<span>Официальный ввоз</span>
			<span>В наличии с ПСМ</span>
			<span>Гарантия 12 месяцев</span>
			<span>Еженедельные поставки</span>
			<span>Рассрочка и трейд-ин</span>
			<span>Сервис и оригинальные запчасти</span>
		<?php endfor; ?>
	</div>
</div>

<header class="header" id="header">
	<div class="container">
		<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="logo-mark">N</span> NORDLINE</a>
		<nav class="nav">
			<?php if ( $items ) : ?>
				<?php foreach ( $items as $item ) : ?>
					<a href="<?php echo esc_url( $item->url ); ?>"<?php echo in_array( 'current-menu-item', (array) $item->classes, true ) ? ' class="active"' : ''; ?>><?php echo esc_html( $item->title ); ?></a>
				<?php endforeach; ?>
			<?php else : ?>
				<?php foreach ( $fallback as $item ) : ?>
					<a href="<?php echo esc_url( $item['url'] ); ?>"<?php echo is_page( $item['slug'] ) ? ' class="active"' : ''; ?>><?php echo esc_html( $item['title'] ); ?></a>
				<?php endforeach; ?>
			<?php endif; ?>
		</nav>
		<div class="header-actions">
			<a class="phone" href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
			<button class="btn btn-primary js-lead" type="button">Получить предложение</button>
			<button class="burger" id="burger" aria-label="Меню"><span></span></button>
		</div>
	</div>
</header>

<nav class="mobile-nav" id="mobileNav">
	<?php
	$mobile = nordline_nav_items( 'mobile' );
	$mobile_links = $mobile ? $mobile : null;
	if ( $mobile_links ) :
		foreach ( $mobile_links as $item ) :
			?>
			<a href="<?php echo esc_url( $item->url ); ?>"><?php echo esc_html( $item->title ); ?></a>
			<?php
		endforeach;
	else :
		foreach ( nordline_default_nav() as $item ) :
			?>
			<a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['title'] ); ?></a>
			<?php
		endforeach;
		?>
		<a href="<?php echo esc_url( nordline_page_url( 'zapchasti' ) ); ?>">Запчасти</a>
	<?php endif; ?>
	<a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
</nav>
