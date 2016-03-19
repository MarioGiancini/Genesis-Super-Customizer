/**
 * global jQuery, _SuperCustomizerReset, ajaxurl, wp
 */

jQuery(function ($) {
    // Container that contains the Customizer save button
    var $container = $( '#customize-header-actions' );
    // Reference the main body element
    var $body = $( 'body.wp-customizer' );
    var $overlay = $( '.wp-full-overlay' );
    var $button = $('<input type="submit" name="gsc-reset" id="gsc-reset" class="button-secondary button">')
        .attr('value', _SuperCustomizerReset.reset)
        .css({
            'float': 'right',
            'margin-right': '4px',
            'margin-top': '9px'
        });

    $button.on('click', function (event) {
        event.preventDefault();

        var data = {
            wp_customize: 'on',
            action: 'customizer_reset',
            nonce: _SuperCustomizerReset.nonce.reset
        };

        var r = confirm(_SuperCustomizerReset.confirm);

        if (!r) return;

        // Give the customizer an in progress state
        $button.attr('disabled', 'disabled');
        $( 'iframe' ).contents().find( 'body' ).addClass( 'wp-customizer-unloading' );
        $button.val( 'Resetting' );
        $body.addClass( 'saving' );
        $overlay.addClass( 'customize-loading' );
        $( '#customize-preivew').removeClass( 'iframe-ready' );

        $.post(ajaxurl, data, function () {
            wp.customize.state('saved').set(true);
            location.reload();
        });
    });

    $container.append($button);

    $container.find('.spinner').css({'margin-left': '0px'});
});