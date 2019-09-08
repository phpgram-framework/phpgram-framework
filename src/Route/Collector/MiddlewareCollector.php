<?php
/**
 * phpgram project
 *
 * This File is part of the phpgram Mvc Frmaework
 *
 * Web: https://gitlab.com/grammm/php-gram/phpgram-framework
 *
 * @license https://gitlab.com/grammm/php-gram/phpgram/blob/master/LICENSE
 *
 * @author Jörn Heinemann <j.heinemann1@web.de>
 */

namespace Gram\Project\Route\Collector;

use Gram\App\App;

/**
 * Class MiddlewareCollector
 * @package Gram\Project\Route\Collector
 *
 * Bietet die Möglichkeit Middleware zu phpgram hinzu zufügen
 */
class MiddlewareCollector
{
	public static function add($middleware)
	{
		return App::app()->addMiddle($middleware);
	}
}