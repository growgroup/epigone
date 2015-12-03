<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

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

		if ( ! defined( 'EPIGONE_DEBUG' ) ) {
			return false;
		}

		static::$path   = get_template_directory() . '/logs/debug.log';
		static::$logger = new Logger( 'wptheme' );
		$output         = "[%datetime%] %level_name%: %message% %context% %extra%\n";
		$formatter      = new LineFormatter( $output );

		$stream = new StreamHandler( static::$path, Logger::DEBUG );
		$stream->setFormatter( $formatter );
		static::$logger->pushHandler( $stream );

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
	 * 静的メソッドをコールした時の動作
	 * @param $name
	 * @param $args
	 */
	static function __callStatic( $name, $args ) {

		ob_start();
		var_dump( $args[0] );
		$content = ob_get_contents();
		ob_clean();
		static::$logger->$name( $content );
	}

}

WPLogger::get_instance();
