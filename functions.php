<?php
/**
 * Research AMP child theme functions and definitions.
 *
 * Use this file to add custom PHP functions to modify or extend the functionality
 * of your Research AMP child theme.
 */

/**
 * Enqueues stylesheets.
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		// Enqueue stylesheet from parent theme research-amp-theme.
		wp_enqueue_style( 'research-amp-theme', get_template_directory_uri() . '/style.css' );

		// Enqueue the stylesheet from the current theme.
		wp_enqueue_style( 'research-amp-child-theme', get_stylesheet_uri(), array( 'research-amp-theme' ) );
	}
);
