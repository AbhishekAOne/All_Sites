<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Goral
 * @since Goral 1.0
 */
/*

*Template Name: 404 Page
*/
get_header();
$sidebar_configs = goral_get_page_layout_configs();

?>
<section class="page-404">
<section id="main-container" class="<?php echo apply_filters('goral_page_content_class', 'container');?> inner">
	<div class="row">
		<?php if ( isset($sidebar_configs['left']) ) : ?>
			<div class="<?php echo esc_attr($sidebar_configs['left']['class']) ;?>">
			  	<aside class="sidebar sidebar-left" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			  		<?php if ( is_active_sidebar( $sidebar_configs['left']['sidebar'] ) ): ?>
			   			<?php dynamic_sidebar( $sidebar_configs['left']['sidebar'] ); ?>
			   		<?php endif; ?>
			  	</aside>
			</div>
		<?php endif; ?>
		<div id="main-content" class="main-page <?php echo esc_attr($sidebar_configs['main']['class']); ?>">

			<section class="error-404 not-found text-center clearfix">
				<div class="inner-content">
					<h1 class="page-title"><?php echo trim(goral_get_config( '404_title', 'Page not found' )); ?></h1>
					<p class="sub-title"><?php echo trim(goral_get_config( '404_title', 'We are sorry, but we can not find the page you were looking for' )); ?></p>
				</div>
				<div class="page-content">
					<form class="search-form">
						  <div class="input-group"> 
							  <input type="text" class="form-control" id="exampleInputEmail2" placeholder="Search">
							  <span class="input-group-btn"> 
							  	<button type="submit" class="btn btn-dark"><?php echo esc_html_e('SEARCH','goral') ?></button>
							  </span> 
						  </div>
					</form>
					<a class="btn btn-primary radius-0" href="<?php echo esc_url( home_url( '/' ) ); ?>"> <i class="mn-icon-172"></i> <?php esc_html_e('back to homepage', 'goral'); ?></a>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</div><!-- .content-area -->
		<?php if ( isset($sidebar_configs['right']) ) : ?>
			<div class="<?php echo esc_attr($sidebar_configs['right']['class']) ;?>">
			  	<aside class="sidebar sidebar-right" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			  		<?php if ( is_active_sidebar( $sidebar_configs['right']['sidebar'] ) ): ?>
				   		<?php dynamic_sidebar( $sidebar_configs['right']['sidebar'] ); ?>
				   	<?php endif; ?>
			  	</aside>
			</div>
		<?php endif; ?>
	</div>
</section>
</section>
<?php get_footer(); ?>