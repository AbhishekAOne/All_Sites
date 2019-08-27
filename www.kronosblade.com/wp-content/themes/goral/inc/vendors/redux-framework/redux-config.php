<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if (!class_exists('Goral_Redux_Framework_Config')) {

    class Goral_Redux_Framework_Config
    {
        public $args = array();
        public $sections = array();
        public $ReduxFramework;

        public function __construct()
        {
            if (!class_exists('ReduxFramework')) {
                return;
            }
            add_action('init', array($this, 'initSettings'), 10);
        }

        public function initSettings()
        {
            // Set the default arguments
            $this->setArguments();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        public function setSections()
        {
            global $wp_registered_sidebars;
            $sidebars = array();

            if ( !empty($wp_registered_sidebars) ) {
                foreach ($wp_registered_sidebars as $sidebar) {
                    $sidebars[$sidebar['id']] = $sidebar['name'];
                }
            }
            $columns = array( '1' => esc_html__('1 Column', 'goral'),
                '2' => esc_html__('2 Columns', 'goral'),
                '3' => esc_html__('3 Columns', 'goral'),
                '4' => esc_html__('4 Columns', 'goral'),
                '5' => esc_html__('5 Columns', 'goral'),
                '6' => esc_html__('6 Columns', 'goral')
            );
            
            $general_fields = array();
            if ( !function_exists( 'wp_site_icon' ) ) {
                $general_fields[] = array(
                    'id' => 'media-favicon',
                    'type' => 'media',
                    'title' => esc_html__('Favicon Upload', 'goral'),
                    'desc' => esc_html__('', 'goral'),
                    'subtitle' => esc_html__('Upload a 16px x 16px .png or .gif image that will be your favicon.', 'goral'),
                );
            }
            $general_fields[] = array(
                'id' => 'preload',
                'type' => 'switch',
                'title' => esc_html__('Preload Website', 'goral'),
                'default' => true,
            );
            $general_fields[] = array(
                'id' => 'image_lazy_loading',
                'type' => 'switch',
                'title' => esc_html__('Image Lazy Loading', 'goral'),
                'default' => true,
            );
            // General Settings Tab
            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'title' => esc_html__('General', 'goral'),
                'fields' => $general_fields
            );
            // Header
            $this->sections[] = array(
                'icon' => 'el el-website',
                'title' => esc_html__('Header', 'goral'),
                'fields' => array(
                    array(
                        'id' => 'media-logo',
                        'type' => 'media',
                        'title' => esc_html__('Logo Upload', 'goral'),
                        'subtitle' => esc_html__('Upload a .png or .gif image that will be your logo.', 'goral'),
                    ),
                    array(
                        'id' => 'media-mobile-logo',
                        'type' => 'media',
                        'title' => esc_html__('Mobile Logo Upload', 'goral'),
                        'subtitle' => esc_html__('Upload a .png or .gif image that will be your logo.', 'goral'),
                    ),
                    array(
                        'id' => 'header_type',
                        'type' => 'select',
                        'title' => esc_html__('Header Layout Type', 'goral'),
                        'subtitle' => esc_html__('Choose a header for your website.', 'goral'),
                        'options' => goral_get_header_layouts()
                    ),
                    array(
                        'id' => 'keep_header',
                        'type' => 'switch',
                        'title' => esc_html__('Keep Header When Scroll Mouse', 'goral'),
                        'default' => false
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Search Form', 'goral'),
                'fields' => array(
                    array(
                        'id'=>'show_searchform',
                        'type' => 'switch',
                        'title' => esc_html__('Show Search Form', 'goral'),
                        'default' => true,
                        'on' => esc_html__('Yes', 'goral'),
                        'off' => esc_html__('No', 'goral'),
                    ),
                    array(
                        'id'=>'search_type',
                        'type' => 'button_set',
                        'title' => esc_html__('Search Content Type', 'goral'),
                        'required' => array('show_searchform','equals',true),
                        'options' => array('all' => esc_html__('All', 'goral'), 'post' => esc_html__('Post', 'goral'), 'product' => esc_html__('Product', 'goral')),
                        'default' => 'all'
                    ),
                    array(
                        'id'=>'search_category',
                        'type' => 'switch',
                        'title' => esc_html__('Show Categories', 'goral'),
                        'required' => array('search_type', 'equals', array('post', 'product')),
                        'default' => false,
                        'on' => esc_html__('Yes', 'goral'),
                        'off' => esc_html__('No', 'goral'),
                    ),
                    array(
                        'id' => 'autocomplete_search',
                        'type' => 'switch',
                        'title' => esc_html__('Autocomplete search?', 'goral'),
                        'required' => array('show_searchform','equals',true),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_search_product_image',
                        'type' => 'switch',
                        'title' => esc_html__('Show Search Result Image', 'goral'),
                        'required' => array('autocomplete_search', '=', '1'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_search_product_price',
                        'type' => 'switch',
                        'title' => esc_html__('Show Search Result Price', 'goral'),
                        'required' => array(array('autocomplete_search', '=', '1'), array('search_type', '=', 'product')),
                        'default' => 1
                    ),
                )
            );
            // Footer
            $this->sections[] = array(
                'icon' => 'el el-website',
                'title' => esc_html__('Footer', 'goral'),
                'fields' => array(
                    array(
                        'id' => 'footer_type',
                        'type' => 'select',
                        'title' => esc_html__('Footer Layout Type', 'goral'),
                        'subtitle' => esc_html__('Choose a footer for your website.', 'goral'),
                        'options' => goral_get_footer_layouts()
                    ),
                    array(
                        'id' => 'back_to_top',
                        'type' => 'switch',
                        'title' => esc_html__('Back To Top Button', 'goral'),
                        'subtitle' => esc_html__('Toggle whether or not to enable a back to top button on your pages.', 'goral'),
                        'default' => true,
                    ),
                )
            );

            // Blog settings
            $this->sections[] = array(
                'icon' => 'el el-pencil',
                'title' => esc_html__('Blog', 'goral'),
                'fields' => array(
                    array(
                        'id' => 'show_blog_breadcrumbs',
                        'type' => 'switch',
                        'title' => esc_html__('Breadcrumbs', 'goral'),
                        'default' => 1
                    ),
                    array (
                        'title' => esc_html__('Breadcrumbs Background Color', 'goral'),
                        'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'goral').'</em>',
                        'id' => 'blog_breadcrumb_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'blog_breadcrumb_image',
                        'type' => 'media',
                        'title' => esc_html__('Breadcrumbs Background', 'goral'),
                        'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'goral'),
                    ),
                )
            );
            // Archive Blogs settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Blog & Post Archives', 'goral'),
                'fields' => array(
                    array(
                        'id' => 'blog_archive_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Sidebar position', 'goral'),
                        'subtitle' => esc_html__('Select the variation you want to apply on your store.', 'goral'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Only', 'goral'),
                                'alt' => esc_html__('Main Only', 'goral'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left - Main Sidebar', 'goral'),
                                'alt' => esc_html__('Left - Main Sidebar', 'goral'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main - Right Sidebar', 'goral'),
                                'alt' => esc_html__('Main - Right Sidebar', 'goral'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left - Main - Right Sidebar', 'goral'),
                                'alt' => esc_html__('Left - Main - Right Sidebar', 'goral'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'blog_archive_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'goral'),
                        'default' => false
                    ),
                    array(
                        'id' => 'blog_archive_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Left Sidebar', 'goral'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'goral'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'blog_archive_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Right Sidebar', 'goral'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'goral'),
                        'options' => $sidebars
                        
                    ),
                    array(
                        'id' => 'blog_display_mode',
                        'type' => 'select',
                        'title' => esc_html__('Display Mode', 'goral'),
                        'options' => array(
                            'grid' => esc_html__('Grid Layout', 'goral'),
                            'mansory' => esc_html__('Mansory Layout', 'goral'),
                            'list' => esc_html__('List Layout', 'goral'),
                            'chess' => esc_html__('Chess Layout', 'goral'),
                            'timeline' => esc_html__('Timeline Layout', 'goral'),
                        ),
                        'default' => 'grid'
                    ),
                    array(
                        'id' => 'blog_columns',
                        'type' => 'select',
                        'title' => esc_html__('Blog Columns', 'goral'),
                        'options' => $columns,
                        'default' => 4
                    ),
                    array(
                        'id' => 'blog_item_style',
                        'type' => 'select',
                        'title' => esc_html__('Blog Item Style', 'goral'),
                        'options' => array(
                            'grid' => esc_html__('Grid', 'goral'),
                            'list' => esc_html__('List', 'goral')
                        ),
                        'default' => 'grid'
                    ),
                    array(
                        'id' => 'blog_item_thumbsize',
                        'type' => 'text',
                        'title' => esc_html__('Thumbnail Size', 'goral'),
                        'desc' => esc_html__('Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme.', 'goral'),
                    ),

                )
            );
            // Single Blogs settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Blog', 'goral'),
                'fields' => array(
                    
                    array(
                        'id' => 'blog_single_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Sidebar position', 'goral'),
                        'subtitle' => esc_html__('Select the variation you want to apply on your store.', 'goral'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Only', 'goral'),
                                'alt' => esc_html__('Main Only', 'goral'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left - Main Sidebar', 'goral'),
                                'alt' => esc_html__('Left - Main Sidebar', 'goral'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main - Right Sidebar', 'goral'),
                                'alt' => esc_html__('Main - Right Sidebar', 'goral'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left - Main - Right Sidebar', 'goral'),
                                'alt' => esc_html__('Left - Main - Right Sidebar', 'goral'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'blog_single_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'goral'),
                        'default' => false
                    ),
                    array(
                        'id' => 'blog_single_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Blog Left Sidebar', 'goral'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'goral'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'blog_single_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Blog Right Sidebar', 'goral'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'goral'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'show_blog_social_share',
                        'type' => 'switch',
                        'title' => esc_html__('Show Social Share', 'goral'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_blog_releated',
                        'type' => 'switch',
                        'title' => esc_html__('Show Releated Posts', 'goral'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'number_blog_releated',
                        'type' => 'text',
                        'title' => esc_html__('Number of related posts to show', 'goral'),
                        'required' => array('show_blog_releated', '=', '1'),
                        'default' => 4,
                        'min' => '1',
                        'step' => '1',
                        'max' => '20',
                        'type' => 'slider'
                    ),
                    array(
                        'id' => 'releated_blog_columns',
                        'type' => 'select',
                        'title' => esc_html__('Releated Blogs Columns', 'goral'),
                        'required' => array('show_blog_releated', '=', '1'),
                        'options' => $columns,
                        'default' => 4
                    ),

                )
            );
            // Woocommerce
            $this->sections[] = array(
                'icon' => 'el el-shopping-cart',
                'title' => esc_html__('Woocommerce', 'goral'),
                'fields' => array(
                    array(
                        'id' => 'show_product_breadcrumbs',
                        'type' => 'switch',
                        'title' => esc_html__('Breadcrumbs', 'goral'),
                        'default' => 1
                    ),
                    array (
                        'title' => esc_html__('Breadcrumbs Background Color', 'goral'),
                        'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'goral').'</em>',
                        'id' => 'woo_breadcrumb_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'woo_breadcrumb_image',
                        'type' => 'media',
                        'title' => esc_html__('Breadcrumbs Background', 'goral'),
                        'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'goral'),
                    )
                )
            );
            // Archive settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Product Archives', 'goral'),
                'fields' => array(
                    array(
                        'id' => 'product_archive_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Sidebar position', 'goral'),
                        'subtitle' => esc_html__('Select the layout you want to apply on your archive product page.', 'goral'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Content', 'goral'),
                                'alt' => esc_html__('Main Content', 'goral'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left Sidebar - Main Content', 'goral'),
                                'alt' => esc_html__('Left Sidebar - Main Content', 'goral'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main Content - Right Sidebar', 'goral'),
                                'alt' => esc_html__('Main Content - Right Sidebar', 'goral'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left Sidebar - Main Content - Right Sidebar', 'goral'),
                                'alt' => esc_html__('Left Sidebar - Main Content - Right Sidebar', 'goral'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'product_archive_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'goral'),
                        'default' => false
                    ),
                    array(
                        'id' => 'product_archive_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Left Sidebar', 'goral'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'goral'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'product_archive_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Right Sidebar', 'goral'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'goral'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'product_display_mode',
                        'type' => 'select',
                        'title' => esc_html__('Display Mode', 'goral'),
                        'subtitle' => esc_html__('Choose a default layout archive product.', 'goral'),
                        'options' => array('grid' => esc_html__('Grid', 'goral'), 'list' => esc_html__('List', 'goral')),
                        'default' => 'grid'
                    ),
                    array(
                        'id' => 'number_products_per_page',
                        'type' => 'text',
                        'title' => esc_html__('Number of Products Per Page', 'goral'),
                        'default' => 12,
                        'min' => '1',
                        'step' => '1',
                        'max' => '100',
                        'type' => 'slider'
                    ),
                    array(
                        'id' => 'product_columns',
                        'type' => 'select',
                        'title' => esc_html__('Product Columns', 'goral'),
                        'options' => $columns,
                        'default' => 4
                    ),
                    array(
                        'id' => 'show_quickview',
                        'type' => 'switch',
                        'title' => esc_html__('Show Quick View', 'goral'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_swap_image',
                        'type' => 'switch',
                        'title' => esc_html__('Show Second Image (Hover)', 'goral'),
                        'default' => 1
                    ),
                )
            );
            // Product Page
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Single Product', 'goral'),
                'fields' => array(
                    array(
                        'id' => 'product_single_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Sidebar position', 'goral'),
                        'subtitle' => esc_html__('Select the layout you want to apply on your Single Product Page.', 'goral'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Only', 'goral'),
                                'alt' => esc_html__('Main Only', 'goral'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left - Main Sidebar', 'goral'),
                                'alt' => esc_html__('Left - Main Sidebar', 'goral'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main - Right Sidebar', 'goral'),
                                'alt' => esc_html__('Main - Right Sidebar', 'goral'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left - Main - Right Sidebar', 'goral'),
                                'alt' => esc_html__('Left - Main - Right Sidebar', 'goral'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'product_single_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'goral'),
                        'default' => false
                    ),
                    array(
                        'id' => 'product_single_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Product Left Sidebar', 'goral'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'goral'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'product_single_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Product Right Sidebar', 'goral'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'goral'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'show_product_social_share',
                        'type' => 'switch',
                        'title' => esc_html__('Show Social Share', 'goral'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_product_review_tab',
                        'type' => 'switch',
                        'title' => esc_html__('Show Product Review Tab', 'goral'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_product_releated',
                        'type' => 'switch',
                        'title' => esc_html__('Show Products Releated', 'goral'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_product_upsells',
                        'type' => 'switch',
                        'title' => esc_html__('Show Products upsells', 'goral'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'number_product_releated',
                        'title' => esc_html__('Number of related/upsells products to show', 'goral'),
                        'default' => 4,
                        'min' => '1',
                        'step' => '1',
                        'max' => '20',
                        'type' => 'slider'
                    ),
                    array(
                        'id' => 'releated_product_columns',
                        'type' => 'select',
                        'title' => esc_html__('Releated Products Columns', 'goral'),
                        'options' => $columns,
                        'default' => 4
                    ),
                    array(
                        'id' => 'show_product_accessory',
                        'type' => 'switch',
                        'title' => esc_html__('Show Products Accessory', 'goral'),
                        'default' => 1
                    ),
                )
            );
            // 404 Page
            $this->sections[] = array(
                'icon' => 'el el-shopping-cart',
                'title' => esc_html__('404 Page', 'goral'),
                'fields' => array(
                    array(
                        'id' => '404_title',
                        'type' => 'text',
                        'title' => esc_html__('Title', 'goral'),
                        'default' => 'Page not found'
                    ),
                    array(
                        'id' => '404_description',
                        'type' => 'textarea',
                        'title' => esc_html__('Desciption', 'goral'),
                        'default' => 'We are sorry, but we can not find the page you were looking for'
                    ),
                )
            );
            // Style
            $this->sections[] = array(
                'icon' => 'el el-icon-css',
                'title' => esc_html__('Style', 'goral'),
                'fields' => array(
                    array (
                        'id' => 'main_font_info',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3 style="margin: 0;"> '.esc_html__('Content', 'goral').'</h3>',
                    ),
                    array (
                        'title' => esc_html__('Main Theme Color', 'goral'),
                        'subtitle' => esc_html__('The main color of the site.', 'goral'),
                        'id' => 'main_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                    array (
                        'title' => esc_html__('Second Theme Color', 'goral'),
                        'subtitle' => esc_html__('The Second color of the site.', 'goral'),
                        'id' => 'second_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                    array (
                        'id' => 'site_background',
                        'type' => 'background',
                        'title' => esc_html__('Site Background', 'goral'),
                        'output' => 'body'
                    ),
                    array (
                        'id' => 'container_bg',
                        'type' => 'color_rgba',
                        'title' => esc_html__('Container Background Color', 'goral'),
                        'output' => array(
                            'background-color' =>'#apus-main-content,.wrapper-shop,.single-product .wrapper-shop, .detail-post #comments::before,.detail-post #comments::after,.detail-post #comments
                            .widget.upsells::before, .widget.upsells::after, .widget.related::before, .widget.related::after,.widget.related
                            '
                        )
                    ),
                    array (
                        'id' => 'forms_inputs_bg',
                        'type' => 'color_rgba',
                        'title' => esc_html__('Forms inputs Color', 'goral'),
                        'output' => array(
                            'background-color' =>'.form-control, select, input[type="text"], input[type="email"], input[type="password"], input[type="tel"], textarea, textarea.form-control'
                        )
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Typography', 'goral'),
                'fields' => array(
                    
                    array (
                        'id' => 'main_font_info',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3 style="margin: 0;"> '.esc_html__('Body Font', 'goral').'</h3>',
                    ),
                    // Standard + Google Webfonts
                    array (
                        'title' => esc_html__('Font Face', 'goral'),
                        'subtitle' => '<em>'.esc_html__('Pick the Main Font for your site.', 'goral').'</em>',
                        'id' => 'main_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true
                    ),
                    array (
                        'title' => esc_html__('Font Face Second', 'goral'),
                        'subtitle' => '<em>'.esc_html__('Pick the Second Font for your site( Heading).', 'goral').'</em>',
                        'id' => 'second_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true
                    ),
                    
                    // Header
                    array (
                        'id' => 'secondary_font_info',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3 style="margin: 0;"> '.esc_html__('Heading', 'goral').'</h3>',
                    ),
                    array (
                        'title' => esc_html__('H1 Font', 'goral'),
                        'subtitle' => '<em>'.esc_html__('Pick the H1 Font for your site.', 'goral').'</em>',
                        'id' => 'h1_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true
                    ),
                    array (
                        'title' => esc_html__('H2 Font', 'goral'),
                        'subtitle' => '<em>'.esc_html__('Pick the H2 Font for your site.', 'goral').'</em>',
                        'id' => 'h2_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true
                    ),
                    array (
                        'title' => esc_html__('H3 Font', 'goral'),
                        'subtitle' => '<em>'.esc_html__('Pick the H3 Font for your site.', 'goral').'</em>',
                        'id' => 'h3_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true
                    ),
                    array (
                        'title' => esc_html__('H4 Font', 'goral'),
                        'subtitle' => '<em>'.esc_html__('Pick the H4 Font for your site.', 'goral').'</em>',
                        'id' => 'h4_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true
                    ),
                    array (
                        'title' => esc_html__('H5 Font', 'goral'),
                        'subtitle' => '<em>'.esc_html__('Pick the H5 Font for your site.', 'goral').'</em>',
                        'id' => 'h5_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true
                    ),
                    array (
                        'title' => esc_html__('H6 Font', 'goral'),
                        'subtitle' => '<em>'.esc_html__('Pick the H6 Font for your site.', 'goral').'</em>',
                        'id' => 'h6_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Top Bar', 'goral'),
                'fields' => array(
                    array(
                        'id'=>'topbar_bg',
                        'type' => 'background',
                        'title' => esc_html__('Background', 'goral'),
                        'output' => '#apus-header.header-v3 .apus-topbar, #apus-header.header-v4 .apus-topbar, #apus-header.header-v5 .apus-topbar, #apus-header.header-v6 .apus-topbar'
                    ),
                    array(
                        'title' => esc_html__('Text Color', 'goral'),
                        'id' => 'topbar_text_color',
                        'type' => 'color_rgba',
                        'output' => array(
                            'color' =>'#apus-topbar, .contact-topbar-1 .textwidget .media .media-body .phone-info'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color', 'goral'),
                        'id' => 'topbar_link_color',
                        'type' => 'color_rgba',
                        'output' => array(
                            'color' =>'#apus-topbar a'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color When Hover', 'goral'),
                        'id' => 'topbar_link_color_hover',
                        'type' => 'color_rgba',
                        'output' => array(
                            'color' =>'#apus-topbar a:hover'
                        )
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Header', 'goral'),
                'fields' => array(
                    array(
                        'id'=>'header_bg',
                        'type' => 'background',
                        'title' => esc_html__('Background', 'goral'),
                        'output' => '#apus-header'
                    ),
                    array(
                        'title' => esc_html__('Text Color', 'goral'),
                        'id' => 'header_text_color',
                        'type' => 'color',
                        'output' => array(
                            'color' =>'#apus-header'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color', 'goral'),
                        'id' => 'header_link_color',
                        'type' => 'color',
                        'output' => array(
                            'color' =>'#apus-header a'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color Active', 'goral'),
                        'id' => 'header_link_color_active',
                        'type' => 'color',
                        'output' => array(
                            'color' =>'#apus-header .active > a, #apus-header a:active, #apus-header a:hover'
                        )
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Main Menu', 'goral'),
                'fields' => array(
                    array(
                        'title' => esc_html__('Link Color', 'goral'),
                        'id' => 'main_menu_link_color',
                        'type' => 'color',
                        'output' => array(
                            'color' =>'#apus-header .navbar-nav.megamenu > li > a'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color Active', 'goral'),
                        'id' => 'main_menu_link_color_active',
                        'type' => 'color',
                        'output' => array(
                            'color' =>'#apus-header .navbar-nav.megamenu > li.active > a,#apus-header .navbar-nav.megamenu > li:hover > a,#apus-header .navbar-nav.megamenu > li:active > a'
                        )
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Footer', 'goral'),
                'fields' => array(
                    array(
                        'id'=>'footer_bg',
                        'type' => 'background',
                        'title' => esc_html__('Background', 'goral'),
                        'output' => '.apus-footer .dark'
                    ),
                    array(
                        'title' => esc_html__('Heading Color', 'goral'),
                        'id' => 'footer_heading_color',
                        'type' => 'color',
                        'output' => array(
                            'color' => '#apus-footer .widgettitle ,#apus-footer .widget-title'
                        )
                    ),
                    array(
                        'title' => esc_html__('Text Color', 'goral'),
                        'id' => 'footer_text_color',
                        'type' => 'color',
                        'output' => array(
                            'color' => '#apus-footer, .apus-footer .contact-info, .apus-copyright'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color', 'goral'),
                        'id' => 'footer_link_color',
                        'type' => 'color',
                        'output' => array(
                            'color' => '#apus-footer a'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color Hover', 'goral'),
                        'id' => 'footer_link_color_hover',
                        'type' => 'color',
                        'output' => array(
                            'color' => '#apus-footer a:hover'
                        )
                    ),
                )
            );
            
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Copyright', 'goral'),
                'fields' => array(
                    array(
                        'id'=>'copyright_bg',
                        'type' => 'background',
                        'title' => esc_html__('Background', 'goral'),
                        'output' => '.apus-copyright'
                    ),
                    array(
                        'title' => esc_html__('Text Color', 'goral'),
                        'id' => 'copyright_text_color',
                        'type' => 'color',
                        'output' => array(
                            'color' => '.apus-copyright'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color', 'goral'),
                        'id' => 'copyright_link_color',
                        'type' => 'color',
                        'output' => array(
                            'color' => '.apus-copyright a, .apus-copyright a i'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color Hover', 'goral'),
                        'id' => 'copyright_link_color_hover',
                        'type' => 'color',
                        'output' => array(
                            'color' => '.apus-copyright a:hover .apus-copyright a i:hover'
                        )
                    ),
                )
            );

            // Social Media
            $this->sections[] = array(
                'icon' => 'el el-file',
                'title' => esc_html__('Social Media', 'goral'),
                'fields' => array(
                    array(
                        'id' => 'facebook_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Facebook Share', 'goral'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'twitter_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable twitter Share', 'goral'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'linkedin_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable linkedin Share', 'goral'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'tumblr_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable tumblr Share', 'goral'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'google_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable google plus Share', 'goral'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'pinterest_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable pinterest Share', 'goral'),
                        'default' => 1
                    )
                )
            );
            // Custom Code
            $this->sections[] = array(
                'icon' => 'el-icon-css',
                'title' => esc_html__('Custom CSS/JS', 'goral'),
                'fields' => array(
                    array (
                        'title' => esc_html__('Custom CSS', 'goral'),
                        'subtitle' => esc_html__('Paste your custom CSS code here.', 'goral'),
                        'id' => 'custom_css',
                        'type' => 'ace_editor',
                        'mode' => 'css',
                    ),
                    
                    array (
                        'title' => esc_html__('Header JavaScript Code', 'goral'),
                        'subtitle' => esc_html__('Paste your custom JS code here. The code will be added to the header of your site.', 'goral'),
                        'id' => 'header_js',
                        'type' => 'ace_editor',
                        'mode' => 'javascript',
                    ),
                    
                    array (
                        'title' => esc_html__('Footer JavaScript Code', 'goral'),
                        'subtitle' => esc_html__('Here is the place to paste your Google Analytics code or any other JS code you might want to add to be loaded in the footer of your website.', 'goral'),
                        'id' => 'footer_js',
                        'type' => 'ace_editor',
                        'mode' => 'javascript',
                    ),
                )
            );
            $this->sections[] = array(
                'title' => esc_html__('Import / Export', 'goral'),
                'desc' => esc_html__('Import and Export your Redux Framework settings from file, text or URL.', 'goral'),
                'icon' => 'el-icon-refresh',
                'fields' => array(
                    array(
                        'id' => 'opt-import-export',
                        'type' => 'import_export',
                        'title' => esc_html__('Import Export', 'goral'),
                        'subtitle' => esc_html__('Save and restore your Redux options', 'goral'),
                        'full_width' => false,
                    ),
                ),
            );

            $this->sections[] = array(
                'type' => 'divide',
            );
        }

        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments()
        {
            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $preset = goral_get_demo_preset();
            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'goral_theme_options'.$preset,
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'),
                // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'),
                // Version that appears at the top of your panel
                'menu_type' => 'menu',
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true,
                // Show the sections below the admin menu item or not
                'menu_title' => esc_html__('Theme Options', 'goral'),
                'page_title' => esc_html__('Theme Options', 'goral'),

                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '',
                // Set it you want google fonts to update weekly. A google_api_key value is required.
                'google_update_weekly' => false,
                // Must be defined to add google fonts to the typography module
                'async_typography' => true,
                // Use a asynchronous font on the front end or font string
                //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                'admin_bar' => true,
                // Show the panel pages on the admin bar
                'admin_bar_icon' => 'dashicons-portfolio',
                // Choose an icon for the admin bar menu
                'admin_bar_priority' => 50,
                // Choose an priority for the admin bar menu
                'global_variable' => 'goral_options',
                // Set a different name for your global variable other than the opt_name
                'dev_mode' => false,
                // Show the time the page took to load, etc
                'update_notice' => true,
                // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                'customizer' => true,
                // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority' => null,
                // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php',
                // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options',
                // Permissions needed to access the options panel.
                'menu_icon' => '',
                // Specify a custom URL to an icon
                'last_tab' => '',
                // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes',
                // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options',
                // Page slug used to denote the panel
                'save_defaults' => true,
                // On load save the defaults to DB before user clicks save or not
                'default_show' => false,
                // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '',
                // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,
                // Shows the Import/Export panel when not used as a field.

                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true,
                // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true,
                // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '',
                // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info' => false,
                // REMOVE
                'use_cdn' => true
            );

            return $this->args;
        }

    }

    global $reduxConfig;
    $reduxConfig = new Goral_Redux_Framework_Config();
}