<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Class WPLogger
 */
class WPLogger {


	public static $path;

	public static $logger = null;

	public static $instance = null;


	/**
	 * WPLogger constructor.
	 * インスタンスの初期化
	 */
	private function __construct() {

		static::$path   = get_template_directory() . '/logs/debug.log';
		static::$logger = new Logger( 'wptheme' );
		static::$logger->pushHandler( new StreamHandler( static::$path, Logger::INFO ) );
		static::$logger->addDebug( "ishiara" );

	}

	/**
	 * インスタンスを取得
	 */
	public function get_instance() {

		if ( static::$instance === null ) {
			static::$instance = new self();
		}

		return static::$instance;
	}

	/**
	 * デバッグ情報
	 *
	 * @param $data
	 */
	public static function debug( $data ) {
		static::$logger->addDebug( var_export( $data, true ) );
	}

	/**
	 * デバッグ情報
	 *
	 * @param $data
	 */
	public static function warning( $data ) {

		static::$logger->addWarning(var_export( $data, true ));

	}

	public static function error( $data ) {

		static::$logger->addError( var_export( $data, true ) );

	}

	public static function info( $data ) {

		static::$logger->addInfo( var_export( $data, true ) );

	}

}

WPLogger::get_instance();
