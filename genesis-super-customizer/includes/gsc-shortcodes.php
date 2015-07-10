<?php
/**
* Load shortcode functions
*
* @since      1.0.3
* @package    Geneis_Super_Customizer
* @subpackage Geneis_Super_Customizer/includes
* @author     Mario Giancini <mario.giancini@gmail.com>
*/

/**
* Register the theme color and background shortcodes.
*
* @since    1.0.3
*/

//* Adds the theme-color class to a span element.
function gsc_shortcode_theme_color( $atts, $content = null ) {
	return '<span class="theme-color">' . do_shortcode($content) . '</span>';
}
add_shortcode( 'themecolor', 'gsc_shortcode_theme_color' );

//* Adds the theme-bg class to a span element.
function gsc_shortcode_theme_bg( $atts, $content = null ) {
	return '<span class="theme-bg">' . do_shortcode($content) . '</span>';
}
add_shortcode( 'themebg', 'gsc_shortcode_theme_bg' );

/**
* Register the accent color and background shortcodes.
*
* @since    1.0.3
*/

//* Adds the accent-color class to a span element.
function gsc_shortcode_accent_color( $atts, $content = null ) {
	return '<span class="accent-color">' . do_shortcode($content) . '</span>';
}
add_shortcode( 'accentcolor', 'gsc_shortcode_accent_color' );

//* Adds the accent-color class to a span element.
function gsc_shortcode_accent_bg( $atts, $content = null ) {
	return '<span class="accent-bg">' . do_shortcode($content) . '</span>';
}
add_shortcode( 'accentbg', 'gsc_shortcode_accent_bg' );

/**
* Register the main-bg color and background shortcodes.
*
* @since    1.0.3
*/

//* Adds the bg-color class to a span element.
function gsc_shortcode_bg_color( $atts, $content = null ) {
	return '<span class="bg-color">' . do_shortcode($content) . '</span>';
}
add_shortcode( 'bgcolor', 'gsc_shortcode_bg_color' );

//* Adds the main-bg class to a span element.
function gsc_shortcode_main_bg( $atts, $content = null ) {
	return '<span class="main-bg">' . do_shortcode($content) . '</span>';
}
add_shortcode( 'mainbg', 'gsc_shortcode_main_bg' );
