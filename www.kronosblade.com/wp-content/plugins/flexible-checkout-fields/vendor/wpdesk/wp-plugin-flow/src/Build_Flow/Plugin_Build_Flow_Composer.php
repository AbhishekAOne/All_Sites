<?php

use WPDesk\Helper\HelperAsLibrary;
use WPDesk\Helper\HelperRemover;
use WPDesk\License\PluginRegistrator;
use WPDesk\PluginBuilder\BuildDirector\LegacyBuildDirector;
use WPDesk\PluginBuilder\Builder\InfoBuilder;

if ( ! class_exists( 'WPDesk_Plugin_Build_Flow' ) ) {
	require_once dirname( __FILE__ ) . '/Plugin_Build_Flow.php';
}

/**
 * Plugin is built. Class autoloading through composer.
 */
class WPDesk_Plugin_Build_Flow_Composer implements WPDesk_Plugin_Build_Flow {
	/** @var WPDesk_Plugin_Info */
	protected $plugin_info;

	public function __construct( WPDesk_Plugin_Info $plugin_info ) {
		$this->plugin_info = $plugin_info;
	}

	public function run() {
		$this->register_plugin();
		$this->init_helper();

		if ( $this->is_plugin_compatible() ) {
			$builder        = new InfoBuilder( $this->plugin_info );
			$build_director = new LegacyBuildDirector( $builder );
			$build_director->build_plugin();
		}
	}

	/**
	 * Is starting plugin compatible with others
	 *
	 * @return bool
	 */
	private function is_plugin_compatible() {
		if ( method_exists( $this->plugin_info, 'get_plugin_name' ) ) {
			$plugin_name = $this->plugin_info->get_plugin_name();
		}
		if ( empty( $plugin_name ) ) {
			$plugin_name = $this->plugin_info->get_plugin_file_name();
		}

		$disabler = new WPDesk_Plugin_Disabler_Variable( $plugin_name );
		$guard    = new WPDesk_Plugin_Compatibility_Guard(
			$this->plugin_info->get_plugin_file_name(),
			new WPDesk_Plugin_Compatibility_Checker(),
			$disabler
		);
		$guard->guard_compatibility();

		return ! $disabler->get_disable();
	}

	/**
	 * Register plugin for subscriptions and updates
	 *
	 * NOTE: @return PluginRegistrator|null
	 *
	 * @see init_helper note
	 *
	 */
	private function register_plugin() {
		if ( class_exists( PluginRegistrator::class ) ) {
			$registrator = new PluginRegistrator( $this->plugin_info );
			$registrator->add_plugin_to_installed_plugins();

			return $registrator;
		}

		return null;
	}

	/**
	 * Helper is a component that gives:
	 * - activation interface
	 * - automatic updates
	 * - logs
	 * - some other feats
	 *
	 * NOTE:
	 *
	 * It's possible for this method to not found classes embedded here.
	 * OTHER plugin in unlikely scenario that THIS plugin is disabled
	 * can use this class and do not have this library dependencies as
	 * these are loaded using composer.
	 *
	 * @return HelperAsLibrary|null
	 */
	private function init_helper() {
		if ( class_exists( HelperRemover::class ) ) {
			( new HelperRemover() )->hooks();
		}
		if ( class_exists( HelperAsLibrary::class ) ) {
			$helper = new HelperAsLibrary();
			$helper->hooks();

			return $helper;
		}

		return null;
	}
}