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

/** @version 1.2.3 */

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
	private static $_instance;

	/** @var App */
	protected static $gram;

	/**
	 * Setze die App der die Einstellungen zugerechnet werden sollen
	 *
	 * @param App $app
	 */
	public static function setApp(App $app)
	{
		self::$gram = $app;
	}

	protected static function app():App
	{
		if(self::$gram==null){
			self::$gram = App::app();
		}

		return self::$gram;
	}

	/**
	 * Startet die App für normale Requests
	 *
	 * @return mixed
	 */
	abstract function start();

	/**
	 * Bereitet den Start der App vor für Async Requests
	 *
	 * @return App
	 */
	abstract function asyncStart():App;

	public static function init()
	{
		if(!isset(self::$_instance)) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public static function getResponseCreator()
	{
		return self::app()->getResponseCreator();
	}

	public static function setRouterOptions(array $routeOptions=[])
	{
		self::app()->setRouterOptions($routeOptions);
	}

	public static function setResolverCreator(ResolverCreatorInterface $creator=null)
	{
		self::app()->setResolverCreator($creator);
	}

	public static function setContainer(ContainerInterface $container)
	{
		self::app()->setContainer($container);
	}

	public static function setStrategy(StrategyInterface $strategy=null)
	{
		self::app()->setStrategy($strategy);
	}

	public static function debugMode($type = 0)
	{
		self::app()->debugMode($type);
	}

	/**
	 * @deprecated Legacy Way use @see group() instead
	 *
	 * @param $prefix
	 * @param callable $callback
	 * @return mixed
	 */
	public static function addGroup($prefix, callable $callback)
	{
		return self::app()->group($prefix,$callback);
	}

	public static function group($prefix, callable $callback)
	{
		return self::app()->group($prefix,$callback);
	}

	public static function add($route,$controller,$method)
	{
		return self::app()->add($route,$controller,$method);
	}

	public static function get($route,$controller)
	{
		return self::app()->get($route,$controller);
	}

	public static function post($route,$controller)
	{
		return self::app()->post($route,$controller);
	}

	public static function getpost($route,$controller)
	{
		return self::app()->getpost($route,$controller);
	}

	public static function delete($route,$controller)
	{
		return self::app()->delete($route,$controller);
	}

	public static function put($route,$controller)
	{
		return self::app()->put($route,$controller);
	}

	public static function patch($route,$controller)
	{
		return self::app()->patch($route,$controller);
	}

	public static function head($route,$controller)
	{
		return self::app()->head($route,$controller);
	}

	public static function options($route,$controller)
	{
		return self::app()->options($route,$controller);
	}

	public static function any($route,$controller)
	{
		return self::app()->any($route,$controller);
	}

	public static function setBase(string $base)
	{
		self::app()->setBase($base);
	}

	public static function notFound($controller)
	{
		self::app()->set404($controller);
	}

	public static function notAllowed($controller)
	{
		self::app()->set405($controller);
	}

	public static function stdMiddleware($middleware)
	{
		self::app()->addMiddleware($middleware);
	}
}