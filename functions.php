<?php

/*
 * Advanced Custom Fields
 */
function abr_acf_path() {
	return get_stylesheet_directory_uri() . '/inc/acf/';
}
add_filter('acf/helpers/get_dir', 'abr_acf_path');
define('ACF_LITE', false);
require_once(STYLESHEETPATH . '/inc/acf/acf.php');

// stories
require_once(STYLESHEETPATH . '/inc/story.php');

function abr_scripts() {
	wp_enqueue_style('abr-main', get_stylesheet_directory_uri() . '/css/main.css');
}
add_action('wp_enqueue_scripts', 'abr_scripts');

function abr_submit_button() {
	?>
	<a class="button open-abr-submit-form">Enviar um relato</a>
	<?php
}
//add_action('wp_footer', 'abr_submit_button');