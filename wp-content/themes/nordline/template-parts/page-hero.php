<section class="page-hero<?php echo $image ? ' photo' : ''; ?>">
	<?php if ( $image ) : ?>
		<div class="hero-media"><img src="<?php echo esc_url( $image ); ?>" alt=""></div>
	<?php endif; ?>
	<div class="container"<?php echo $image ? ' style="position:relative;z-index:1;padding-bottom:36px;"' : ''; ?>>
		<?php if ( ! empty( $crumbs ) ) : ?>
			<div class="crumbs">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
				<?php foreach ( $crumbs as $crumb ) : ?>
					<span>/</span>
					<?php if ( ! empty( $crumb['url'] ) ) : ?>
						<a href="<?php echo esc_url( $crumb['url'] ); ?>"><?php echo esc_html( $crumb['label'] ); ?></a>
					<?php else : ?>
						<span><?php echo esc_html( $crumb['label'] ); ?></span>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		<?php if ( ! empty( $eyebrow ) ) : ?><p class="eyebrow"><?php echo esc_html( $eyebrow ); ?></p><?php endif; ?>
		<h1><?php echo esc_html( $title ); ?></h1>
		<?php if ( ! empty( $lead ) ) : ?><p class="hero-lead"><?php echo esc_html( $lead ); ?></p><?php endif; ?>
	</div>
</section>
