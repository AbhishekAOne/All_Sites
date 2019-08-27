<?php

/**
 * Class tries to check used composer.lock files for major incompatibilities between plugins
 */
class WPDesk_Plugin_Compatibility_Checker {

	const COMPOSER_KEY_VERSION = 'version';
	const COMPOSER_KEY_NAME = 'name';
	const COMPOSER_KEY_PACKAGES = 'packages';

	const VERSION_DELIMITER = '.';

	/**
	 * Checks if two versions are compatible.
	 * 3.1.1 and 3.3.1 are compatible.
	 * 3.1.1 and 4.0.0 are not compatible.
	 *
	 * @param string $version1
	 * @param string $version2
	 *
	 * @return bool
	 */
	private function is_versions_compatible( $version1, $version2 ) {
		return explode( self::VERSION_DELIMITER, $version1 )[0] === explode( self::VERSION_DELIMITER, $version2 )[0];
	}

	/**
	 * Checks if currently loading libs are compatible with already loaded
	 *
	 * @param array $currently_loading_libs Libs in format from get_plugin_libs_versions()
	 * @param array $already_loaded_libs    Libs in format from get_plugin_libs_versions()
	 *
	 * @return bool
	 */
	private function is_compatible( array $currently_loading_libs, array $already_loaded_libs ) {
		foreach ( $currently_loading_libs as $name => $needed_version ) {
			$lib_versions = isset( $already_loaded_libs[ $name ] ) ? $already_loaded_libs[ $name ] : [ $needed_version ];

			foreach ( $lib_versions as $version ) {
				if ( ! $this->is_versions_compatible( $needed_version, $version ) ) {
					error_log( "Library {$name} is in {$version} but {$needed_version} is required" );

					return false;
				}
			}
		}

		return true;
	}

	/**
	 * Get libs version for given plugin
	 *
	 * @param string $plugin_name like 'some-dir/plugin-file.php'
	 *
	 * @return array versions in format [lib name][]
	 */
	private function get_plugin_libs_versions( $plugin_name ) {
		$plugin_dir                = str_replace( basename( $plugin_name ), '', $plugin_name );
		$plugin_composer_lock_path = WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . $plugin_dir . 'composer.lock';
		if ( ! file_exists( $plugin_composer_lock_path ) || ! is_readable( $plugin_composer_lock_path ) ) {
			return [];
		}

		try {
			$composer_lock_data = json_decode( file_get_contents( $plugin_composer_lock_path ), true );

			$library_versions = array_reduce( $composer_lock_data[ self::COMPOSER_KEY_PACKAGES ],
				static function ( $carry, $package_info ) {
					$carry[ $package_info[ self::COMPOSER_KEY_NAME ] ] = $package_info[ self::COMPOSER_KEY_VERSION ];

					return $carry;
				},
				[] );
		} catch ( \Exception $e ) {
			error_log( "Could not load libraries for plugin {$plugin_name} from {$plugin_composer_lock_path} file." );

			return [];
		}


		return is_array( $library_versions ) ? $library_versions : [];
	}

	/**
	 * Get libs versions for loaded plugins.
	 *
	 * @param string[] $loaded_plugins Paths(array) like 'some-dir/plugin-file.php'
	 *
	 * @return array versions in format [lib name][]
	 */
	private function get_already_loaded_libs_versions( $loaded_plugins ) {
		$array_of_libs = [];
		foreach ( $loaded_plugins as $loaded_plugin ) {
			foreach ( $this->get_plugin_libs_versions( $loaded_plugin ) as $library_name => $version ) {
				$array_of_libs[ $library_name ] = array_merge( isset( $array_of_libs[ $library_name ] ) ? $array_of_libs[ $library_name ] : [],
					[ $version ] );
			}
		}

		return $array_of_libs;
	}

	/**
	 * Checks if given plugin to load is compatible with already loaded
	 *
	 * @param string   $plugin_to_load_path Path like 'some-dir/plugin-file.php'
	 * @param string[] $loaded_plugins      Paths(array) like like 'some-dir/plugin-file.php'
	 *
	 * @return bool
	 */
	public function is_plugin_compatible( $plugin_to_load_path, array $loaded_plugins ) {
		return $this->is_compatible(
			$this->get_plugin_libs_versions( $plugin_to_load_path ),
			$this->get_already_loaded_libs_versions( $loaded_plugins )
		);
	}
}