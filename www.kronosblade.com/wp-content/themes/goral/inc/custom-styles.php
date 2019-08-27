<?php
//convert hex to rgb
if ( !function_exists ('goral_getbowtied_hex2rgb') ) {
	function goral_getbowtied_hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);
		
		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		return implode(",", $rgb); // returns the rgb values separated by commas
		//return $rgb; // returns an array with the rgb values
	}
}
if ( !function_exists ('goral_custom_styles') ) {
	function goral_custom_styles() {
		global $post;	
		
		ob_start();	
		?>
		
		<!-- ******************************************************************** -->
		<!-- * Theme Options Styles ********************************************* -->
		<!-- ******************************************************************** -->
			
		<style>

			/* check main color */ 
			<?php if ( goral_get_config('main_color') != "" ) : ?>

				/* seting background main */
				.bg-theme,.btn-theme
				{
					background: <?php echo esc_html( goral_get_config('main_color') ) ?>;
				}
				/* setting color*/
				
				.text-theme,a:hover,a:active
				{
					color: <?php echo esc_html( goral_get_config('main_color') ) ?>;
				}
				/* setting border color*/
				.btn-theme,
				.border-theme{
					border-color: <?php echo esc_html( goral_get_config('main_color') ) ?>;
				}

			<?php endif; ?>

			/* check second color */ 
			<?php if ( goral_get_config('second_color') != "" ) : ?>

				/* seting background main */
				#back-to-top,
				.date,
				.bg-theme-second,.btn-theme-second
				{
					background: <?php echo esc_html( goral_get_config('second_color') ) ?>;
				}
				/* setting color*/
				
				.text-second,.second-color
				{
					color: <?php echo esc_html( goral_get_config('second_color') ) ?> !important;
				}
				/* setting border color*/
				.btn-theme-second
				{
					border-color: <?php echo esc_html( goral_get_config('second_color') ) ?>;
				}

			<?php endif; ?>
			

			/* Typo */
			<?php
				$main_font = goral_get_config('main_font');
				if ( !empty($main_font) ) :
			?>
				/* seting background main */
				body, p
				{
					<?php if ( isset($main_font['font-family']) && $main_font['font-family'] ) { ?>
						font-family: <?php echo esc_html( $main_font['font-family'] ) ?>;
					<?php } ?>
					<?php if ( isset($main_font['font-weight']) && $main_font['font-weight'] ) { ?>
						font-weight: <?php echo esc_html( $main_font['font-weight'] ) ?>;
					<?php } ?>
					<?php if ( isset($main_font['font-style']) && $main_font['font-style'] ) { ?>
						font-style: <?php echo esc_html( $main_font['font-style'] ) ?>;
					<?php } ?>
					<?php if ( isset($main_font['font-size']) && $main_font['font-size'] ) { ?>
						font-size: <?php echo esc_html( $main_font['font-size'] ) ?>;
					<?php } ?>
					<?php if ( isset($main_font['line-height']) && $main_font['line-height'] ) { ?>
						line-height: <?php echo esc_html( $main_font['line-height'] ) ?>;
					<?php } ?>
					<?php if ( isset($main_font['color']) && $main_font['color'] ) { ?>
						color: <?php echo esc_html( $main_font['color'] ) ?>;
					<?php } ?>
				}
				
			<?php endif; ?>

			<?php
				$second_font = goral_get_config('second_font');
				if ( !empty($second_font) ) :
			?>
				/* seting background main */
				.btn,.widget-title,.woocommerce div.product p.price, .woocommerce div.product span.price,
              	.product-block.grid .groups-button .add-cart .btn, .product-block.grid .groups-button .add-cart .button,
              	.archive-shop div.product .information .compare, .archive-shop div.product .information .add_to_wishlist, .archive-shop div.product .information .yith-wcwl-wishlistexistsbrowse > a, .archive-shop div.product .information .yith-wcwl-wishlistaddedbrowse > a,
             	.tabs-v1 .nav-tabs li > a,.commentform .title
				{
					<?php if ( isset($second_font['font-family']) && $second_font['font-family'] ) { ?>
						font-family: <?php echo esc_html( $second_font['font-family'] ) ?>;
					<?php } ?>
					<?php if ( isset($second_font['font-weight']) && $second_font['font-weight'] ) { ?>
						font-weight: <?php echo esc_html( $second_font['font-weight'] ) ?>;
					<?php } ?>
					<?php if ( isset($second_font['font-style']) && $second_font['font-style'] ) { ?>
						font-style: <?php echo esc_html( $second_font['font-style'] ) ?>;
					<?php } ?>
					<?php if ( isset($second_font['font-size']) && $second_font['font-size'] ) { ?>
						font-size: <?php echo esc_html( $second_font['font-size'] ) ?>;
					<?php } ?>
					<?php if ( isset($second_font['line-height']) && $second_font['line-height'] ) { ?>
						line-height: <?php echo esc_html( $second_font['line-height'] ) ?>;
					<?php } ?>
					<?php if ( isset($second_font['color']) && $second_font['color'] ) { ?>
						color: <?php echo esc_html( $second_font['color'] ) ?>;
					<?php } ?>
				}
				
			<?php endif; ?>

			/* H1 */
			<?php
				$h1_font = goral_get_config('h1_font');
				if ( !empty($h1_font) ) :
			?>
				/* seting background main */
				h1
				{
					<?php if ( isset($h1_font['font-family']) && $h1_font['font-family'] ) { ?>
						font-family: <?php echo esc_html( $h1_font['font-family'] ) ?>;
					<?php } ?>
					<?php if ( isset($h1_font['font-weight']) && $h1_font['font-weight'] ) { ?>
						font-weight: <?php echo esc_html( $h1_font['font-weight'] ) ?>;
					<?php } ?>
					<?php if ( isset($h1_font['font-style']) && $h1_font['font-style'] ) { ?>
						font-style: <?php echo esc_html( $h1_font['font-style'] ) ?>;
					<?php } ?>
					<?php if ( isset($h1_font['font-size']) && $h1_font['font-size'] ) { ?>
						font-size: <?php echo esc_html( $h1_font['font-size'] ) ?>;
					<?php } ?>
					<?php if ( isset($h1_font['line-height']) && $h1_font['line-height'] ) { ?>
						line-height: <?php echo esc_html( $h1_font['line-height'] ) ?>;
					<?php } ?>
					<?php if ( isset($h1_font['color']) && $h1_font['color'] ) { ?>
						color: <?php echo esc_html( $h1_font['color'] ) ?>;
					<?php } ?>
				}
			<?php endif; ?>

			/* H2 */
			<?php
				$h2_font = goral_get_config('h2_font');
				if ( !empty($h2_font) ) :
			?>
				/* seting background main */
				h2
				{
					<?php if ( isset($h2_font['font-family']) && $h2_font['font-family'] ) { ?>
						font-family: <?php echo esc_html( $h2_font['font-family'] ) ?>;
					<?php } ?>
					<?php if ( isset($h2_font['font-weight']) && $h2_font['font-weight'] ) { ?>
						font-weight: <?php echo esc_html( $h2_font['font-weight'] ) ?>;
					<?php } ?>
					<?php if ( isset($h2_font['font-style']) && $h2_font['font-style'] ) { ?>
						font-style: <?php echo esc_html( $h2_font['font-style'] ) ?>;
					<?php } ?>
					<?php if ( isset($h2_font['font-size']) && $h2_font['font-size'] ) { ?>
						font-size: <?php echo esc_html( $h2_font['font-size'] ) ?>;
					<?php } ?>
					<?php if ( isset($h2_font['line-height']) && $h2_font['line-height'] ) { ?>
						line-height: <?php echo esc_html( $h2_font['line-height'] ) ?>;
					<?php } ?>
					<?php if ( isset($h2_font['color']) && $h2_font['color'] ) { ?>
						color: <?php echo esc_html( $h2_font['color'] ) ?>;
					<?php } ?>
				}
			<?php endif; ?>

			/* H3 */
			<?php
				$h3_font = goral_get_config('h3_font');
				if ( !empty($h3_font) ) :
			?>
				/* seting background main */
				h3, 
                .widgettitle, .widget-title'
				{
					<?php if ( isset($h3_font['font-family']) && $h3_font['font-family'] ) { ?>
						font-family: <?php echo esc_html( $h3_font['font-family'] ) ?>;
					<?php } ?>
					<?php if ( isset($h3_font['font-weight']) && $h3_font['font-weight'] ) { ?>
						font-weight: <?php echo esc_html( $h3_font['font-weight'] ) ?>;
					<?php } ?>
					<?php if ( isset($h3_font['font-style']) && $h3_font['font-style'] ) { ?>
						font-style: <?php echo esc_html( $h3_font['font-style'] ) ?>;
					<?php } ?>
					<?php if ( isset($h3_font['font-size']) && $h3_font['font-size'] ) { ?>
						font-size: <?php echo esc_html( $h3_font['font-size'] ) ?>;
					<?php } ?>
					<?php if ( isset($h3_font['line-height']) && $h3_font['line-height'] ) { ?>
						line-height: <?php echo esc_html( $h3_font['line-height'] ) ?>;
					<?php } ?>
					<?php if ( isset($h3_font['color']) && $h3_font['color'] ) { ?>
						color: <?php echo esc_html( $h3_font['color'] ) ?>;
					<?php } ?>
				}
			<?php endif; ?>

			/* H4 */
			<?php
				$h4_font = goral_get_config('h4_font');
				if ( !empty($h4_font) ) :
			?>
				/* seting background main */
				h4
				{
					<?php if ( isset($h4_font['font-family']) && $h4_font['font-family'] ) { ?>
						font-family: <?php echo esc_html( $h4_font['font-family'] ) ?>;
					<?php } ?>
					<?php if ( isset($h4_font['font-weight']) && $h4_font['font-weight'] ) { ?>
						font-weight: <?php echo esc_html( $h4_font['font-weight'] ) ?>;
					<?php } ?>
					<?php if ( isset($h4_font['font-style']) && $h4_font['font-style'] ) { ?>
						font-style: <?php echo esc_html( $h4_font['font-style'] ) ?>;
					<?php } ?>
					<?php if ( isset($h4_font['font-size']) && $h4_font['font-size'] ) { ?>
						font-size: <?php echo esc_html( $h4_font['font-size'] ) ?>;
					<?php } ?>
					<?php if ( isset($h4_font['line-height']) && $h4_font['line-height'] ) { ?>
						line-height: <?php echo esc_html( $h4_font['line-height'] ) ?>;
					<?php } ?>
					<?php if ( isset($h4_font['color']) && $h4_font['color'] ) { ?>
						color: <?php echo esc_html( $h4_font['color'] ) ?>;
					<?php } ?>
				}
			<?php endif; ?>

			/* H5 */
			<?php
				$h5_font = goral_get_config('h5_font');
				if ( !empty($h5_font) ) :
			?>
				/* seting background main */
				h5
				{
					<?php if ( isset($h5_font['font-family']) && $h5_font['font-family'] ) { ?>
						font-family: <?php echo esc_html( $h5_font['font-family'] ) ?>;
					<?php } ?>
					<?php if ( isset($h5_font['font-weight']) && $h5_font['font-weight'] ) { ?>
						font-weight: <?php echo esc_html( $h5_font['font-weight'] ) ?>;
					<?php } ?>
					<?php if ( isset($h5_font['font-style']) && $h5_font['font-style'] ) { ?>
						font-style: <?php echo esc_html( $h5_font['font-style'] ) ?>;
					<?php } ?>
					<?php if ( isset($h5_font['font-size']) && $h5_font['font-size'] ) { ?>
						font-size: <?php echo esc_html( $h5_font['font-size'] ) ?>;
					<?php } ?>
					<?php if ( isset($h5_font['line-height']) && $h5_font['line-height'] ) { ?>
						line-height: <?php echo esc_html( $h5_font['line-height'] ) ?>;
					<?php } ?>
					<?php if ( isset($h5_font['color']) && $h5_font['color'] ) { ?>
						color: <?php echo esc_html( $h5_font['color'] ) ?>;
					<?php } ?>
				}
			<?php endif; ?>

			/* H6 */
			<?php
				$h6_font = goral_get_config('h6_font');
				if ( !empty($h6_font) ) :
			?>
				/* seting background main */
				h6
				{
					<?php if ( isset($h6_font['font-family']) && $h6_font['font-family'] ) { ?>
						font-family: <?php echo esc_html( $h6_font['font-family'] ) ?>;
					<?php } ?>
					<?php if ( isset($h6_font['font-weight']) && $h6_font['font-weight'] ) { ?>
						font-weight: <?php echo esc_html( $h6_font['font-weight'] ) ?>;
					<?php } ?>
					<?php if ( isset($h6_font['font-style']) && $h6_font['font-style'] ) { ?>
						font-style: <?php echo esc_html( $h6_font['font-style'] ) ?>;
					<?php } ?>
					<?php if ( isset($h6_font['font-size']) && $h6_font['font-size'] ) { ?>
						font-size: <?php echo esc_html( $h6_font['font-size'] ) ?>;
					<?php } ?>
					<?php if ( isset($h6_font['line-height']) && $h6_font['line-height'] ) { ?>
						line-height: <?php echo esc_html( $h6_font['line-height'] ) ?>;
					<?php } ?>
					<?php if ( isset($h6_font['color']) && $h6_font['color'] ) { ?>
						color: <?php echo esc_html( $h6_font['color'] ) ?>;
					<?php } ?>
				}
			<?php endif; ?>

			/* Custom CSS */
			<?php if ( goral_get_config('custom_css') != "" ) : ?>
				<?php echo goral_get_config('custom_css') ?>
			<?php endif; ?>

		</style>

	<?php
		$content = ob_get_clean();
		$content = str_replace(array("\r\n", "\r"), "\n", $content);
		$lines = explode("\n", $content);
		$new_lines = array();
		foreach ($lines as $i => $line) {
			if (!empty($line)) {
				$new_lines[] = trim($line);
			}
		}
		
		echo implode($new_lines);
	}
}

?>
<?php add_action( 'wp_head', 'goral_custom_styles', 99 ); ?>