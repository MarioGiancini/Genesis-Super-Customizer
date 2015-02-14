<?php

/**
* Register comments customizer settings
*
* @link       http://genesissupercustomizer.com
* @since      1.0.0
*
* @package    Genesis_Super_Customizer
* @subpackage Genesis_Super_Customizer/includes
*/

class GSC_Comments extends GSC_Base {

  protected $new_section = true;

  protected $mod_section = 'comments';

  protected $section_title = 'Comment Settings';

  protected $section_desc = 'Adjust comment area colors and styles.';

  protected $section_priority = 100;

  //* Setup mods here to get for output
  protected function get_mods() {

    $this->mod_settings = array(
      'comment_background_color' => array(
        'css'         => array( 'li.comment', 'background-color', '', '', true, array( 'rgba' => 'comment_alpha' ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '#f5f5f5',
        'option'      => true,
      ),
      'comment_alpha' => array(
        'css'         => array(),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 100,
        'label'       => 'Comment Background Alpha',
        'description' => '0% to 100%.',
        'input_attrs' => array(
          'min'   => 0,
          'max'   => 100,
          'step'  => 5,
        ),
        'decimal'     => true,
        'option'      => true,
      ),
      'comment_area_padding' => array(
        'css'         => array( '.entry-comments, .comment-respond, .entry-pings', 'padding', '', 'px', true, array(
          'affects'  => array( '.comment-respond .form-submit' ),
          'affects_values'  => array( '.comment-respond .form-submit' => 'margin-bottom: 0;' )
        ) ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 40,
        'option'      => true,
        'input_attrs' => array(
          'min'   => 0,
          'max'   => 100,
        ),
      ),
      'comment_font' => array(
        'css'         => array( 'li.comment', 'font-family' ),
        'priority'    => 10,
        'type'        => 'select',
        'default'     => 'Lato, sans-serif',
        'choices'     => $this->fonts,
        'label'       => 'Comments Font Family',
        'option'      => true,
      ),
      'comment_text_color' => array(
        'css'         => array( 'li.comment', 'color' ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '',
        'option'      => true,
      ),
      'comment_font_size' => array(
        'css'         => array( 'li.comment', 'font-size', '', 'px' ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 18,
        'option'      => true,
        'input_attrs' => array(
          'min'   => 8,
          'max'   => 24,
        ),
      ),
      'comment_header_background' => array(
        'css'         => array( '.comment-header', 'background-color', '', '', true, array( 'rgba' => 'comment_header_alpha' ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '',
        'option'      => true,
      ),
      'comment_header_alpha' => array(
        'css'         => array(),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 100,
        'input_attrs' => array(
          'min'   => 0,
          'max'   => 100,
          'step'  => 5,
        ),
        'decimal'     => true,
        'option'      => true,
      ),
      'comment_header_padding' => array(
        'css'         => array( '.comment-header', 'padding', '', 'px', true, array(
          'affects'  => array( '.entry-comments .comment-meta', '.comment-header' ),
          'affects_values'  => array( '.entry-comments .comment-meta' => 'margin-bottom: 0;', '.comment-header' => 'margin-bottom: 20px;' )
        ) ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 0,
        'option'      => true,
        'input_attrs' => array(
          'min'   => 0,
          'max'   => 20,
        ),
      ),
      'comment_header_font_size' => array(
        'css'         => array( '.comment-header', 'font-size', '', 'px' ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 16,
        'input_attrs' => array(
          'min'   => 8,
          'max'   => 24,
        ),
        'option'      => true,
      ),
      'comment_border_color' => array(
        'css'         => array( 'li.comment', 'border-color', '', '', true, array( 'rgba' => 'comment_border_alpha' ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '',
        'option'      => true,
      ),
      'comment_border_alpha' => array(
        'css'         => array(),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 100,
        'description' => '0% to 100%.',
        'input_attrs' => array(
          'min'   => 0,
          'max'   => 100,
          'step'  => 5,
        ),
        'decimal'     => true,
        'option'      => true,
      ),
      'comment_border_width' => array(
        'css'         => array( 'li.comment', 'border-width', '', 'px' ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 2,
        'description' => 'Set the width of comment borders up to 15px.',
        'input_attrs' => array(
          'min'   => 0,
          'max'   => 15,
        ),
        'option'      => true,
      ),
      'comment_border_style' => array(
        'css'         => array( 'li.comment', 'border-top-style border-left-style border-bottom-style' ),
        'priority'    => 10,
        'type'        => 'select',
        'default'     => 'solid',
        'choices'     => $this->border_styles,
        'option'      => true,
      )
    );

  }

} // end class

new GSC_Comments;
