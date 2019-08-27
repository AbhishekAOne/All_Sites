<?php

if ( !function_exists( 'goral_product_metaboxes' ) ) {
	function goral_product_metaboxes(array $metaboxes) {
		$prefix = 'apus_product_';
	    $fields = array(
	    	array(
				'name' => esc_html__( 'Review Video', 'goral' ),
				'id'   => $prefix.'review_video',
				'type' => 'text',
				'description' => esc_html__( 'You can enter a video youtube or vimeo', 'goral' ),
			),
			array(
			    'name' => esc_html__( 'User Photo', 'goral' ),
			    'id'   => $prefix.'user_photo',
			    'type' => 'file_list'
			),
			array(
				'name' => esc_html__( 'Features', 'goral' ),
				'id'   => $prefix.'features',
				'type' => 'wysiwyg'
			),
    	);
		
	    $metaboxes[$prefix . 'display_setting'] = array(
			'id'                        => $prefix . 'display_setting',
			'title'                     => esc_html__( 'More Information', 'goral' ),
			'object_types'              => array( 'product' ),
			'context'                   => 'normal',
			'priority'                  => 'low',
			'show_names'                => true,
			'fields'                    => $fields
		);

	    return $metaboxes;
	}
}
add_filter( 'cmb2_meta_boxes', 'goral_product_metaboxes' );
