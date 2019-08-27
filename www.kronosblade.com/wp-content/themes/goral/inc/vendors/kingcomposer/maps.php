<?php
add_filter( 'apus_themer_kingcomposer_map_element_features_box', 'goral_kingcomposer_map_features_box');
function goral_kingcomposer_map_features_box($args) {
    if ( isset($args['params'][2]['options']) ) {
        $args['params'][2]['options'] = array(
                'default' => esc_html__('Default ', 'goral'),
            );
    }
    return $args;
}
add_filter( 'apus_themer_kingcomposer_map_element_socials_link', 'apustheme_kingcomposer_socials_link');
function apustheme_kingcomposer_socials_link($args) {
    return array(
		'name' => esc_html__( 'Apus Socials Link', 'goral' ),
		'title' => esc_html__( 'Apus Socials Link Settings', 'goral' ),
		'icon' => 'fa fa-newspaper-o',
		'category' => 'Elements',
		'wrapper_class' => 'clearfix',
		'description' => esc_html__( 'Display Socials Link.', 'goral' ),
		'params' => array(
			array(
				"type" => "text",
				"label" => esc_html__("Title", 'goral'),
				"name" => "title",
				"admin_label"	=> true
			),
		    array(
                'type' => 'textarea',
                'label' => esc_html__( 'Description', 'goral' ),
                'name' => 'desc',
                'admin_label' => true,
            ),
            array(
                'type' => 'select',
                'label' => esc_html__( 'Style', 'goral' ),
                'name' => 'style',
                "admin_label"	=> true,
                'options' => array(
                	'' => esc_html__("Default", 'goral'),
                	'style1' => esc_html__("Style Inline", 'goral'),
                )
            ),
			array(
	            'type' => 'group',
	            'label' => __('Social Items', 'goral'),
	            'name' => 'socials',
	            'params' => array(
	            	array(
						"type" => "text",
						"label" => esc_html__("Title", 'goral'),
						"name" => "title",
						"admin_label"	=> true
					),
	            	array(
						"type" => "text",
						"label" => esc_html__("URL", 'goral'),
						"name" => "url",
						"admin_label"	=> true
					),
					array(
						"type" => "icon_picker",
						"label" => esc_html__("Icon Font", 'goral'),
						"name" => "icon"
					),
					array(
						"type" => "attach_image",
						"description" => esc_html__("If you upload an image, icon will not show.", 'goral'),
						"name" => "image",
						'label'	=> esc_html__('Icon Image', 'goral' )
					),
					
	            ),
	        )
		)
    );
}

add_filter( 'apus_themer_kingcomposer_map_element_counter', 'apustheme_kingcomposer_counter');
function apustheme_kingcomposer_counter($args) {
	return array(
		'name' => esc_html__( 'Apus Counter', 'goral' ),
		'title' => esc_html__( 'Apus Counter Settings', 'goral' ),
		'icon' => 'fa fa-newspaper-o',
		'category' => 'Elements',
		'wrapper_class' => 'clearfix',
		'description' => esc_html__( 'Display counter number.', 'goral' ),
		'params' => array(
	        array(
				"type" => "text",
				"label" => esc_html__("Title", 'goral'),
				"name" => "title",
				"admin_label"	=> true
			),
			array(
				"type" => "textarea",
				"label" => esc_html__("Description", 'goral'),
				"name" => "description",
			),
			array(
				"type" => "text",
				"label" => esc_html__("Number", 'goral'),
				"name" => "number",
			),
			array(
				'name'		=> 'show_icon',
				'label'		=> __( 'Display Icon Or Image', 'goral' ),
				'type'		=> 'toggle',
				'value'		=> 'no',
				'relation'	=> array(
					'parent'	=> 'layout',
					'show_when'	=> array( '1','2','4','5' )
				)
			),
			array(
				"type" => "attach_image",
				"description" => esc_html__("If you upload an image, icon will not show.", 'goral'),
				"name" => "image",
				'label'	=> esc_html__('Image', 'goral' ),
				'relation'	=> array(
					'parent'	=> 'show_icon',
					'show_when'	=> 'yes'
				)
			),
			array(
				'name'		=> 'icon',
				'label'		=> __( 'Icon', 'goral' ),
				'type'		=> 'icon_picker',
				'relation'	=> array(
					'parent'	=> 'show_icon',
					'show_when'	=> 'yes'
				)
			),

			array(
				"type" => "color_picker",
				"label" => esc_html__("Text Color", 'goral'),
				"name" => "text_color"
			),
		)
	);
}