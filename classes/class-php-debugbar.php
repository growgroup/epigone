<?php

use DebugBar\StandardDebugBar;


/**
 * Class WPLogger
 */
class PHPDebugBar {

	public $debugbar = null;

	static $instance = null;

	/**
	 * PHPDebugBar constructor.
	 * 初期化
	 */
	public function __construct() {

		if ( ! is_user_logged_in() || ! defined( 'EPIGONE_DEBUG' ) ) {
			return false;
		}

		global $wpdb;

		$this->debugbar = new StandardDebugBar();

		$debugbarRenderer = $this->debugbar->getJavascriptRenderer()
		                                   ->setBaseUrl( get_template_directory_uri() . '/vendor/maximebf/debugbar/src/DebugBar/Resources' )
		                                   ->setEnableJqueryNoConflict( false );

		$collector = new WordpressDatabaseCollector( $wpdb );

		$this->debugbar->addCollector( $collector );

		$this->debugbar->addCollector( new DebugBar\Bridge\MonologCollector( WPLogger::$logger ) );

		add_action( 'wp_head', function () use ( $debugbarRenderer ) {
			echo $debugbarRenderer->renderHead();
		} );

		add_action( 'wp_footer', function () use ( $debugbarRenderer ) {
			echo $debugbarRenderer->render();
		} );

	}

	public static function get_instance() {

		if ( static::$instance === null ) {
			static::$instance = new self();
		}

		return static::$instance;

	}

}

$debugbar = PHPDebugBar::get_instance();

