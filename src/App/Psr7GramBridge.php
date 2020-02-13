<?php
/**
 * phpgram project
 *
 * This File is part of the phpgram Framework
 *
 * Web: https://gitlab.com/grammm/php-gram/phpgram-framework
 *
 * @license https://gitlab.com/grammm/php-gram/phpgram/blob/master/LICENSE
 *
 * @author Jörn Heinemann <joernheinemann@gmx.de>
 */

namespace Gram\Project\App;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface Psr7GramBridge
 * @package Gram\Project\App
 *
 * Ein Interface, dass bestimmt welche Psr 17 Factory genutzt werden soll
 *
 * und wie der Psr 7 ServerRequest erstellt wird (from globals)
 */
interface Psr7GramBridge
{
	/**
	 * Gebe die Psr 17 ResponseFactory zurück
	 *
	 * @return ResponseFactoryInterface
	 */
	public function getPsr17ResponseFactory(): ResponseFactoryInterface;

	/**
	 * Erstellt für normale Requests den ServerRequest
	 *
	 * @return ServerRequestInterface
	 */
	public function createPsr7Request(): ServerRequestInterface;
}