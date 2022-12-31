<?php
/**
 * Helper utilities for the theme.
 *
 * @package Minerva Web Development
 */

/**
 * Blacklist of words, emails, and URLs that are not allowed in gravity forms submissions.
 *
 * @param array $validation_result The validation result.
 * @return array The validation result.
 */
function mwd_gform_validation( $validation_result ) {
	$form      = $validation_result['form'];
	$spam_file = file( get_template_directory() . '/theme/blacklists/spam-keywords.txt' );
	$blacklist = array();
	foreach ( $spam_file as $line ) {
		$blacklist[] = trim( $line );
	}

	foreach ( $form['fields'] as &$field ) {
		$value = rgpost( 'input_' . str_replace( '.', '_', $field['id'] ) );
		if ( 'text' === $field->type || 'textarea' === $field->type || 'email' === $field->type ) {
			foreach ( $blacklist as $word ) {
				if ( stripos( $value, $word ) !== false ) {
					unset( $form['notifications'] );

					$field->failed_validation  = true;
					$field->validation_message = 'Spam detected.';
				}
			}
		}
	}

	$validation_result['form'] = $form;
	return $validation_result;
}

add_filter( 'gform_validation', 'mwd_gform_validation' );
