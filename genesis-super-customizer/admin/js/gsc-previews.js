( function( $ ) {
    /**
     * Set live previews for built in customizer settings
     */
    wp.customize( 'blogname', function( value ) {
        value.bind( function( newval ) {
            $( '.site-title a' ).text( newval );
        } );
    } );
    wp.customize( 'blogdescription', function( value ) {
        value.bind( function( newval ) {
            $( '.site-description' ).text( newval );
        } );
    } );

    /**
     * Loop through localized mod_settings object and hook up all live previews
     */
    Object.keys(mod_settings).forEach(function(key) {

        var modArray = mod_settings[key];

        wp.customize( key, function( value ) {
            value.bind( function( newval ) {
                for (var i = 0; i < modArray.styles.length; i++) {
                    $( modArray.selector ).css( modArray.styles[i], modArray.prefix + newval + modArray.postfix);
                }
            } );
        } );

    });

} )( jQuery );