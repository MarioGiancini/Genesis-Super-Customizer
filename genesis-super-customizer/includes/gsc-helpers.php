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
* Register the Customize_Number_Control class for Customizer.
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
      *
      * @since 1.0.0
      */
      public function render_content() {

        $range_id = $this->type . '_' . $this->instance_number;

        ?>

        <label>
          <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
          <?php if( $this->description ): ?><p class="description"><?php echo $this->description; ?></p><?php endif; ?>
            <input
              type="<?php echo $this->type; ?>"
              id="<?php echo $range_id; ?>"
              <?php $this->link(); ?>
              value="<?php echo $this->value(); ?>"
              <?php $this->input_attrs(); ?>
              oninput="<?php echo $range_id; ?>_amount.value=<?php echo $range_id; ?>.value" />
            <span class="range-amount" style="margin: 3px 3px 0 0; float: right;">
              <output
              id="<?php echo $range_id; ?>_amount"
              for="<?php echo $range_id; ?>">
              <?php echo $this->value(); ?> </output> <?php echo $this->postfix; ?>
            </span>
          </span>
        </label>

        <?php
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

function hex2rgba($color, $alpha = false) {

  $default = 'rgb(0,0,0)';

  //Return default if no color provided
  if(empty($color))
  return $default;

  //Sanitize $color if "#" is provided
  if ($color[0] == '#' ) {
    $color = substr( $color, 1 );
  }

  //Check if color has 6 or 3 characters and get values
  if (strlen($color) == 6) {
    $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
  } elseif ( strlen( $color ) == 3 ) {
    $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
  } else {
    return $default;
  }

  //Convert hexadec to rgb
  $rgb =  array_map('hexdec', $hex);

  //Check if alpha is set(rgba or rgb)
  if(isset($alpha)){
    if(abs($alpha) > 1)
    $alpha = 1.0;
    $output = 'rgba('.implode(",",$rgb).','.$alpha.')';
  } else {
    $output = 'rgb('.implode(",",$rgb).')';
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
    if( genesis_get_option( 'override_link_colors', 'genesis-customizer-settings' ) ) {
      return true;
    } else {
      return false;
    }
}

function override_button_colors() {
    if( genesis_get_option( 'override_button_colors', 'genesis-customizer-settings' ) ) {
      return true;
    } else {
      return false;
    }
}

function override_footer_colors() {
    if( genesis_get_option( 'override_footer_colors', 'genesis-customizer-settings' ) ) {
      return true;
    } else {
      return false;
    }
}

function override_input_colors() {
    if( genesis_get_option( 'override_input_colors', 'genesis-customizer-settings' ) ) {
      return true;
    } else {
      return false;
    }
}

function override_nav_colors() {
    if( genesis_get_option( 'override_nav_colors', 'genesis-customizer-settings' ) ) {
      return true;
    } else {
      return false;
    }
}
