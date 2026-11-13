<?php

function nordline_save_request() {
	check_ajax_referer( 'nordline_lead', 'nonce' );

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$task    = isset( $_POST['task'] ) ? sanitize_text_field( wp_unslash( $_POST['task'] ) ) : '';
	$comment = isset( $_POST['comment'] ) ? sanitize_textarea_field( wp_unslash( $_POST['comment'] ) ) : '';
	$model   = isset( $_POST['model'] ) ? sanitize_text_field( wp_unslash( $_POST['model'] ) ) : '';

	if ( '' === $name || '' === $phone ) {
		wp_send_json_error( array( 'message' => 'Укажите имя и телефон' ), 400 );
	}

	$body = "Телефон: {$phone}\nЗадача: {$task}\nМодель: {$model}\n\n{$comment}";
	wp_insert_post(
		array(
			'post_type'    => 'request',
			'post_status'  => 'publish',
			'post_title'   => $name . ' — ' . $phone,
			'post_content' => $body,
		)
	);

	wp_send_json_success( array( 'message' => 'Заявка принята. Онлайн-оплаты нет — перезвоним.' ) );
}
add_action( 'wp_ajax_nordline_lead', 'nordline_save_request' );
add_action( 'wp_ajax_nopriv_nordline_lead', 'nordline_save_request' );
