<div id="apus-header-mobile" class="header-mobile hidden-lg hidden-md clearfix">
    <div class="container">
        <div class="row">
            <div class="col-xs-5">
                <?php
                    $logo = goral_get_config('media-mobile-logo');
                ?>

                <?php if( isset($logo['url']) && !empty($logo['url']) ): ?>
                    <div class="logo">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
                            <img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>">
                        </a>
                    </div>
                <?php else: ?>
                    <div class="logo logo-theme">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
                            <img src="<?php echo esc_url_raw( get_template_directory_uri().'/images/logo.png'); ?>" alt="<?php bloginfo( 'name' ); ?>">
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-xs-7">
                <div class="action-right clearfix">
                    <div class="active-mobile pull-right">
                        <button data-toggle="offcanvas" class="btn btn-sm btn-danger btn-offcanvas btn-toggle-canvas offcanvas" type="button">
                            <?php esc_html_e( 'MENU', 'goral' ); ?>
                           <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <div class="active-mobile top-cart pull-right">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-primary btn-outline dropdown-toggle" type="button" data-toggle="dropdown"><i class="mn-icon-913"></i></button>
                            <div class="dropdown-menu">
                                <div class="widget_shopping_cart_content"></div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>