<?php
$title = $subtitle = $desc = $image = $custom_class = $data_img = $data_title = $data_desc = $data_subtitle = $img_size = $data_socials = $socials = $data_button = '';
$layout = 1;
$wrap_class	= apply_filters( 'kc-el-class', $atts );

extract( $atts );

$wrap_class[] = 'kc-team';
$wrap_class[] = 'kc-team-' . $layout;

if ( !empty( $custom_class ) )
	$wrap_class[] = $custom_class;

if ( $image > 0 ) {

	if ( !in_array($img_size, array('full', 'thumbnail', 'medium', 'large')) ) {
		$img_link = wp_get_attachment_image_src( $image, 'full' );
		$img_link = kc_tools::createImageSize( $img_link[0], $img_size );
	} else {
		$img_link = wp_get_attachment_image_src( $image, 'full' );
		$img_link = $img_link[0];
	}

	$data_img .= '<figure class="content-image">';
		$data_img .= '<img src="'. $img_link .'" alt="">';
	$data_img .= '</figure>';

}
if ( !empty( $subtitle ) ) {

	$data_subtitle .= '<div class="content-subtitle">';
		$data_subtitle .= $subtitle;
	$data_subtitle .= '</div>';

}

if ( !empty( $title ) ) {

	$data_title .= '<div class="content-title">';
		$data_title .= $title;
	$data_title .= '</div>';

}

if ( !empty( $desc ) ) {

	$data_desc .= '<div class="content-desc">';
		$data_desc .= $desc;
	$data_desc .= '</div>';

}


if ( $show_button == 'yes' ) {

	if ( !empty( $button_link ) ) {
		$button_link_text = explode( '|', $button_link );
		$button_link = $button_link_text[0];
	}

	if( empty($button_text) )
		$button_text = __( 'Readmore', 'goral' );

	$data_button .= '<div class="content-button">';
		$data_button .= '<a href="'. $button_link .'">'. $button_text .'</a>';
	$data_button .= '</div>';

}

$social_list = array(
	'facebook',
	'twitter',
	'google_plus',
	'linkedin',
	'pinterest',
	'flickr',
	'instagram',
	'dribbble',
	'reddit',
	'email',
	);

foreach( $social_list as $acc ){

	if( !empty( $atts[$acc]) && $atts[$acc] != '__empty__' ){
		$icon = str_replace( array('_', 'email') , array( '-', 'envelope-o') , $acc);
		$data_socials .= '<a href="' . $atts[$acc] . '" target="_blank"><i class="fa-' . $icon . '"></i></a>';
	}

}

if( !empty( $data_socials) )
	$data_socials = '<div class="content-socials">' . $data_socials . '</div>';

?>

<div class="<?php echo implode( ' ', $wrap_class ); ?>">

	<?php switch ( $layout ) {
		case '2':
			echo trim($data_img);
			echo '<div class="box-right">';
			echo trim($data_title);
			echo trim($data_subtitle);
			echo trim($data_desc);
			echo trim($data_socials);
			echo '</div>';
		break;
		case '3':
			echo trim($data_img);
			echo '<div class="overlay">';
			echo trim($data_subtitle);
			echo trim($data_title);
			echo trim($data_desc);
			echo trim($data_button);
			echo trim($data_socials);
			echo '</div>';
		break;
		default:
			echo trim($data_img);
			echo trim($data_title);
			echo trim($data_subtitle);
			echo trim($data_desc);
			echo trim($data_socials);
			echo trim($data_button);
		break;
	} ?>

</div>
