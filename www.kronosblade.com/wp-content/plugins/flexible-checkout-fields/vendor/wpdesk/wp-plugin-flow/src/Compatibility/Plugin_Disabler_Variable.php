<?php

if ( ! interface_exists( 'WPDesk_Plugin_Disabler' ) ) {
	require_once dirname( __FILE__ ) . '/Plugin_Disabler.php';
}

/**
 * Can remember is wanted to disable certain plugin
 */
class WPDesk_Plugin_Disabler_Variable implements WPDesk_Plugin_Disabler {
	const HOOK_ADMIN_NOTICES_ACTION = 'admin_notices';

	/** @var string */
	private $plugin_name;

	/** @var bool Tried to disable? */
	private $set_disabled = false;

	/**
	 * @param string $plugin_name
	 */
	public function __construct( $plugin_name ) {
		$this->plugin_name = $plugin_name;
	}

	/**
	 * @return void
	 */
	public function disable() {
		$this->set_disabled = true;
		add_action( self::HOOK_ADMIN_NOTICES_ACTION,
			function () {
				$this->render_notice();
			} );
	}

	private function render_notice() {
		echo '<div class="error"><p>' . sprintf( __( 'The &#8220;%s&#8221; plugin cannot start as there is a dependency conflict with other existing plugin. Please upgrade all plugins to the most recent version.',
				'wpdesk-plugin-flow' ),
				esc_html( $this->plugin_name ) ) . '</p></div>';
	}

	/**
	 * @return bool
	 */
	public function get_disable() {
		return $this->set_disabled;
	}
}