<?php
/**
 * Load helper functions
 *
 * @since      1.0.0
 * @package    Geneis_Super_Customizer
 * @subpackage Geneis_Super_Customizer/includes
 * @author     Mario Giancini <mario.giancini@gmail.com>
 */

/**
 * Register the Customize_Range_Control class for Customizer.
 *
 * @since    1.0.0
 */
function add_customize_range_control( $wp_customize ) {
	if ( class_exists( 'WP_Customize_Control' ) ) {

		class Customize_Range_Control extends WP_Customize_Control {

			public $type = 'range';

			public $postfix;

			/**
			 * Override the parent function and render the control's content.
			 * Derived from Anthony Hortin's Slider Custom Control.
			 * @since 1.2.0
			 * @author Anthony Hortin <http://maddisondesigns.com>
			 * @license http://www.gnu.org/licenses/gpl-2.0.html
			 * @link https://github.com/maddisondesigns/customizer-custom-controls/
			 */
			public function render_content() {

				$range_id = $this->type . '_' . $this->instance_number;
				// Set a default step of 1 if none is set to work with custom controller
				$step = array_key_exists('step', $this->input_attrs) ? $this->input_attrs['step'] : 1;

				?>
				<div class="slider-custom-control">
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><input type="number" id="<?php echo esc_attr( $range_id ); ?>" name="<?php echo esc_attr( $range_id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-slider-value" <?php $this->link(); ?> />
					<div class="slider" slider-min-value="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" slider-max-value="<?php echo esc_attr( $this->input_attrs['max'] ); ?>" slider-step-value="<?php echo esc_attr( $step ); ?>"></div><span class="slider-remove dashicons  dashicons-no" slider-remove-value="" title="Remove"></span><span class="slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr( $this->value() ); ?>" title="Reset"></span>
				</div>
				<?php if( $this->description ) { ?>
					<br>
					<p class="description"><?php echo $this->description; ?></p>
				<?php }
			}
		}

	}
}

add_action( 'customize_register', 'add_customize_range_control' );

/**
 ** Convert hexdec color string to rgb(a) string
 *
 * @since    1.0.0
 * @author Meks HQ
 * @link http://mekshq.com/how-to-convert-hexadecimal-color-code-to-rgb-or-rgba-using-php/
 */

function hex2rgba( $color, $alpha = false ) {

	$default = 'rgb(0,0,0)';

	//Return default if no color provided
	if ( empty( $color ) ) {
		return $default;
	}

	//Sanitize $color if "#" is provided
	if ( $color[0] == '#' ) {
		$color = substr( $color, 1 );
	}

	//Check if color has 6 or 3 characters and get values
	if ( strlen( $color ) == 6 ) {
		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( strlen( $color ) == 3 ) {
		$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
		return $default;
	}

	//Convert hexadec to rgb
	$rgb = array_map( 'hexdec', $hex );

	//Check if alpha is set(rgba or rgb)
	if ( isset( $alpha ) ) {
		if ( abs( $alpha ) > 1 ) {
			$alpha = 1.0;
		}
		$output = 'rgba(' . implode( ",", $rgb ) . ',' . $alpha . ')';
	} else {
		$output = 'rgb(' . implode( ",", $rgb ) . ')';
	}

	//Return rgb(a) color string
	return $output;
}

/**
 * Register the customizer mod callback functions for contextual controls
 *
 * @since    1.0.7
 */
function override_link_colors() {
	if ( genesis_get_option( 'override_link_colors', 'genesis-customizer-settings' ) ) {
		return true;
	} else {
		return false;
	}
}

function override_button_colors() {
	if ( genesis_get_option( 'override_button_colors', 'genesis-customizer-settings' ) ) {
		return true;
	} else {
		return false;
	}
}

function override_footer_colors() {
	if ( genesis_get_option( 'override_footer_colors', 'genesis-customizer-settings' ) ) {
		return true;
	} else {
		return false;
	}
}

function override_input_colors() {
	if ( genesis_get_option( 'override_input_colors', 'genesis-customizer-settings' ) ) {
		return true;
	} else {
		return false;
	}
}

function override_nav_colors() {
	if ( genesis_get_option( 'override_nav_colors', 'genesis-customizer-settings' ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Slider sanitization
 *
 * @param  string	Slider value to be sanitized
 * @return string	Sanitized input
 */
if ( ! function_exists( 'skyrocket_range_sanitization' ) ) {
	function skyrocket_range_sanitization( $input, $setting ) {
		$attrs = $setting->manager->get_control( $setting->id )->input_attrs;
		$min = ( isset( $attrs['min'] ) ? $attrs['min'] : $input );
		$max = ( isset( $attrs['max'] ) ? $attrs['max'] : $input );
		$step = ( isset( $attrs['step'] ) ? $attrs['step'] : 1 );
		$number = floor( $input / $attrs['step'] ) * $attrs['step'];
		return skyrocket_in_range( $number, $min, $max );
	}
}

/**
 * Only allow values between a certain minimum & maxmium range
 *
 * @param  number	Input to be sanitized
 * @return number	Sanitized input
 */
if ( ! function_exists( 'skyrocket_in_range' ) ) {
	function skyrocket_in_range( $input, $min, $max ){
		if ( $input < $min ) {
			$input = $min;
		}
		if ( $input > $max ) {
			$input = $max;
		}
		return $input;
	}
}

