<?php
/**
 * Чтение полей Secure Custom Fields.
 * Пока поле пустое, шаблон показывает статическое значение.
 */

function nordline_raw_field( $name, $post_id = false ) {
	if ( ! function_exists( 'get_field' ) ) {
		return null;
	}
	return get_field( $name, $post_id );
}

function nordline_field( $name, $fallback = '', $post_id = false ) {
	$value = nordline_raw_field( $name, $post_id );
	if ( null === $value || false === $value || '' === $value || array() === $value ) {
		return $fallback;
	}
	return $value;
}
