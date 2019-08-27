<?php

namespace WPDesk\PluginBuilder\Storage;

use WPDesk\PluginBuilder\Plugin\AbstractPlugin;

class StaticStorage implements PluginStorage {
	protected static $instances = [];

	/**
	 * @param string $class
	 * @param AbstractPlugin $object
	 */
	public function add_to_storage( $class, $object ) {
		if ( isset( self::$instances[ $class ] ) ) {
			throw new Exception\ClassAlreadyExists( "Class {$class} already exists" );
		}
		self::$instances[ $class ] = $object;
	}

	/**
	 * @param string $class
	 *
	 * @return AbstractPlugin
	 */
	public function get_from_storage( $class ) {
		if ( isset( self::$instances[ $class ] ) ) {
			return self::$instances[ $class ];
		} else {
			throw new Exception\ClassNotExists( "Class {$class} not exists in storage" );
		}
	}
}

