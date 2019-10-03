<?php
/**
 * phpgram project
 *
 * This File is part of the phpgram Mvc Framework
 *
 * Web: https://gitlab.com/grammm/php-gram/phpgram-framework
 *
 * @license https://gitlab.com/grammm/php-gram/phpgram/blob/master/LICENSE
 *
 * @author Jörn Heinemann <joernheinemann@gmx.de>
 */

namespace Gram\Project\App;

use Gram\App\App;
use Gram\ResolverCreator\ResolverCreatorInterface;
use Gram\Strategy\StrategyInterface;
use Psr\Container\ContainerInterface;

/**
 * Trait AppFactoryTrait
 * @package Gram\Project\App
 *
 * Ein Hilfstrait für alle App Factories
 */
trait AppFactoryTrait
{
	public static function setRouteOptons(array $routeOptions=[])
	{
		App::app()->setOptions($routeOptions);
	}

	public static function setResolverCreator(ResolverCreatorInterface $creator=null)
	{
		App::app()->setResolverCreator($creator);
	}

	public static function setContainer(ContainerInterface $container)
	{
		App::app()->setContainer($container);
	}

	public static function setStrategy(StrategyInterface $strategy=null)
	{
		App::app()->setStrategy($strategy);
	}

	public static function addGroup($prefix, callable $callback)
	{
		return App::app()->addGroup($prefix,$callback);
	}

	public static function add($route,$controller,$method)
	{
		return App::app()->add($route,$controller,$method);
	}

	public static function get($route,$controller)
	{
		return App::app()->get($route,$controller);
	}

	public static function post($route,$controller)
	{
		return App::app()->post($route,$controller);
	}

	public static function getpost($route,$controller)
	{
		return App::app()->getpost($route,$controller);
	}

	public static function delete($route,$controller)
	{
		return App::app()->delete($route,$controller);
	}

	public static function put($route,$controller)
	{
		return App::app()->put($route,$controller);
	}

	public static function patch($route,$controller)
	{
		return App::app()->patch($route,$controller);
	}

	public static function options($route,$controller)
	{
		return App::app()->options($route,$controller);
	}

	public static function any($route,$controller)
	{
		return App::app()->any($route,$controller);
	}

	public static function setBase(string $base)
	{
		App::app()->setBase($base);
	}

	public static function notFound($controller)
	{
		App::app()->set404($controller);
	}

	public static function notAllowed($controller)
	{
		App::app()->set405($controller);
	}
}