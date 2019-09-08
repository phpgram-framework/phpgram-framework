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

use Gram\Project\App\ProjectApp;
use Gram\App\App;

/**
 * Class RouteCollector
 * @package Gram\Project\Route\Collector
 *
 * Fügt neue Routes zu phpgram hinzu
 *
 * Fügt auch noch den Namespace Controller Namespace hinzu
 */
class RouteCollector
{
	public static function add($route,$controller,$method=['get'])
	{
		return App::app()->add($route,ProjectApp::$options['routing']['namespace']['controller'].$controller,$method);
	}

	public static function addGroup($prefix, callable $callback)
	{
		return App::app()->addGroup($prefix,$callback);
	}

	public static function notFound($controller)
	{
		App::app()->set404(ProjectApp::$options['routing']['namespace']['controller'].$controller);
	}

	public static function notAllowed($controller)
	{
		App::app()->set405(ProjectApp::$options['routing']['namespace']['controller'].$controller);
	}
}