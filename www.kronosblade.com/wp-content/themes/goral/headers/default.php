<div id="searchverlay"></div>
<header id="apus-header" class="site-header apus-header header-default hidden-sm hidden-xs <?php echo (goral_get_config('keep_header') ? 'main-sticky-header' : ''); ?>" role="banner">
    <div class="header-main clearfix">
        <div class="container">
            <div class="header-inner">
                    <div class="row">
                    <!-- LOGO -->
                        <div class="col-md-2">
                            <div class="logo-in-theme pull-left">
                                <?php get_template_part( 'page-templates/parts/logo' ); ?>
                            </div>
                        </div>
                        <div class="col-md-10 p-static">
                            <!-- //LOGO -->
                            <div class="heading-right pull-right hidden-sm hidden-xs">

                                <div class="pull-right  header-setting">

                                    <?php if ( defined('GORAL_WOOCOMMERCE_ACTIVED') && GORAL_WOOCOMMERCE_ACTIVED ): ?>
                                        <div class="pull-right">
                                            <!-- Setting -->
                                            <div class="top-cart hidden-xs">
                                                <?php get_template_part( 'woocommerce/cart/mini-cart-button' ); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ( has_nav_menu( 'topmenu' ) ) { ?>
                                        <div class="setting-popup pull-right">
                                            <div class="dropdown">
                                                <button class="dropdown-toggle button-setting" type="button" data-toggle="dropdown"><span class="mn-icon-39"></span></button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <div class="pull-left">
                                                        <?php
                                                            $args = array(
                                                                'theme_location'  => 'topmenu',
                                                                'container_class' => '',
                                                                'menu_class'      => 'menu-topbar'
                                                            );
                                                            wp_nav_menu($args);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                     
                                    <?php if ( goral_get_config('show_searchform') ): ?>
                                        <div class="apus-search pull-right">
                                           <button type="button" class="button-show-search button-setting"><i class="mn-icon-52"></i></button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if ( has_nav_menu( 'primary' ) ) : ?>
                                <div class="main-menu  pull-left">
                                    <nav 
                                     data-duration="400" class="hidden-xs hidden-sm apus-megamenu slide animate navbar" role="navigation">
                                    <?php   $args = array(
                                            'theme_location' => 'primary',
                                            'container_class' => 'collapse navbar-collapse',
                                            'menu_class' => 'nav navbar-nav megamenu',
                                            'fallback_cb' => '',
                                            'menu_id' => 'primary-menu',
                                            'walker' => new Goral_Nav_Menu()
                                        );
                                        wp_nav_menu($args);
                                    ?>
                                    </nav>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
            </div>
        </div>
        <div class="full-top-search-form">
            <?php get_template_part( 'page-templates/parts/productsearchform-popup' ); ?>
        </div>
    </div>
</header>