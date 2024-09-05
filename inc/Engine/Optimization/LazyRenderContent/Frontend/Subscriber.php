<?php
declare(strict_types=1);

namespace WP_Rocket\Engine\Optimization\LazyRenderContent\Frontend;

use WP_Rocket\Event_Management\Subscriber_Interface;

class Subscriber implements Subscriber_Interface {
	/**
	 * LazyRenderContent controller.
	 *
	 * @var Controller
	 */
	private $controller;

	/**
	 * Subscriber constructor.
	 *
	 * @param Controller $controller LazyRenderContent controller.
	 */
	public function __construct( Controller $controller ) {
		$this->controller = $controller;
	}

	/**
	 * Returns an array of events that this subscriber wants to listen to.
	 *
	 * @return array
	 */
	public static function get_subscribed_events(): array {
		return [
			'rocket_buffer'                   => [ 'add_hashes', 16 ],
			'rocket_performance_hints_buffer' => [
				[ 'add_hashes', 16 ],
				[ 'add_hashes_query_string', 16 ],
			],
		];
	}

	/**
	 * Add hashes to the HTML elements
	 *
	 * @param string $html The HTML content.
	 *
	 * @return string
	 */
	public function add_hashes( $html ) {
		return $this->controller->add_hashes( $html );
	}

	/**
	 * Add hashes to the HTML elements
	 *
	 * @param string $buffer The HTML content.
	 *
	 * @return string
	 */
	public function add_hashes_query_string( $buffer ) {
		if ( empty( $_GET['wpr_lazyrendercontent'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			return $buffer;
		}

		return $this->controller->add_hashes( $buffer );
	}
}
