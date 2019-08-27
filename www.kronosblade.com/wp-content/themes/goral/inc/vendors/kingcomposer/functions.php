<?php

add_action('init', 'goral_kingcomposer_init');
function goral_kingcomposer_init() {
    if ( function_exists( 'kc_add_icon' ) ) {
    	$css_folder = goral_get_css_folder();
		$min = goral_get_asset_min();
        kc_add_icon( $css_folder . '/font-monia'.$min.'.css' );
    }
 
}