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

/** @version 2.0.0 */

namespace Gram\Project\App;

use Gram\App\App;
use Gram\ResolverCreator\ResolverCreatorInterface;
use Gram\Strategy\StrategyInterface;
use Psr\Container\ContainerInterface;

/**
 * Class AppFactory
 * @package Gram\Project\App
 *
 * Factory für phpgram App
 *
 * Hier kann auch eine andere App Class verwendet werden
 */
class AppFactory
{
	private static $_instance;

	/** @var App */
	protected static $gram;

	/** @var Psr7GramBridge */
	private static $bridge;

	/**
	 * Startet die App für normale Requests
	 *
	 * @return void
	 */
	public function start()
	{
		self::app()->setFactory(self::$bridge->getPsr17ResponseFactory());

		self::app()->start(self::$bridge->createPsr7Request());
	}

	/**
	 * Bereitet den Start der App vor für Async Requests
	 *
	 * @return App
	 */
	public function asyncStart(): App
	{
		self::app()->setFactory(self::$bridge->getPsr17ResponseFactory());
		self::app()->build();

		return self::app();
	}

	/**
	 * Setze die App der die Einstellungen zugerechnet werden sollen
	 *
	 * @param App $app
	 */
	public static function setApp(App $app)
	{
		self::$gram = $app;
	}

	protected static function app(): App
	{
		if(self::$gram==null){
			self::$gram = App::app();
		}

		return self::$gram;
	}

	public static function init()
	{
		if(!isset(self::$_instance)) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Bestimmte wie Psr 7 Requests erstellt werden
	 *
	 * und welche Psr 17 Factory genutzt werden soll
	 *
	 * @param Psr7GramBridge $bridge
	 */
	public static function setPsrBridge(Psr7GramBridge $bridge)
	{
		self::$bridge = $bridge;
	}

	/**
	 * Gebe den ResponseCreator der aktuell genutzten App zurück
	 *
	 * @return \Psr\Http\Server\RequestHandlerInterface
	 */
	public static function getResponseCreator()
	{
		return self::app()->getResponseCreator();
	}

	/**
	 * Setze Router Options
	 *
	 * @param array $routeOptions
	 */
	public static function setRouterOptions(array $routeOptions=[])
	{
		self::app()->setRouterOptions($routeOptions);
	}

	/**
	 * Setze den Resolver Creator der den Resolver aus der gematchten
	 * Route erstellt
	 *
	 * @param ResolverCreatorInterface|null $creator
	 */
	public static function setResolverCreator(ResolverCreatorInterface $creator=null)
	{
		self::app()->setResolverCreator($creator);
	}

	/**
	 * Setze den Psr 11 Container
	 *
	 * @param ContainerInterface $container
	 */
	public static function setContainer(ContainerInterface $container)
	{
		self::app()->setContainer($container);
	}

	/**
	 * Setze die Strategy die immer ausgeführt werden soll
	 *
	 * @param StrategyInterface $strategy
	 */
	public static function setStrategy(StrategyInterface $strategy)
	{
		self::app()->setStrategy($strategy);
	}

	/**
	 * Bestimmte den Debug Mode
	 *
	 * true = Exceptions anzeigen
	 * false = keine Exceptions zeigen
	 *
	 * @param bool $type
	 */
	public static function debugMode($type = true)
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

	/**
	 * Fügt eine Route group hinzu
	 *
	 * @param $prefix
	 * @param callable $callback
	 * @return \Gram\Route\RouteGroup
	 */
	public static function group($prefix, callable $callback)
	{
		return self::app()->group($prefix,$callback);
	}

	/**
	 * Fügt eine Route mit beliebiger Method hinzu
	 *
	 * @param string $route
	 * @param $controller
	 * @param array $method
	 * @return \Gram\Route\Route
	 */
	public static function add(string $route,$controller,array $method)
	{
		return self::app()->add($route,$controller,$method);
	}

	/**
	 * Fügt eine GET Route hinzu
	 *
	 * @param string $route
	 * @param $controller
	 * @return \Gram\Route\Route
	 */
	public static function get(string $route,$controller)
	{
		return self::app()->get($route,$controller);
	}

	/**
	 * Fügt eine POST Route hinzu
	 *
	 * @param string $route
	 * @param $controller
	 * @return \Gram\Route\Route
	 */
	public static function post(string $route,$controller)
	{
		return self::app()->post($route,$controller);
	}

	/**
	 * Fügt eine Route die sowohl GET oder POST sein kann hinzu
	 *
	 * @param string $route
	 * @param $controller
	 * @return \Gram\Route\Route
	 */
	public static function getpost(string $route,$controller)
	{
		return self::app()->getpost($route,$controller);
	}

	/**
	 * Fügt eine DELETE Route hinzu
	 *
	 * @param string $route
	 * @param $controller
	 * @return \Gram\Route\Route
	 */
	public static function delete(string $route,$controller)
	{
		return self::app()->delete($route,$controller);
	}

	/**
	 * Fügt eine PUT Route hinzu
	 *
	 * @param string $route
	 * @param $controller
	 * @return \Gram\Route\Route
	 */
	public static function put(string $route,$controller)
	{
		return self::app()->put($route,$controller);
	}

	/**
	 * Fügt eine Patch Route hinzu
	 *
	 * @param string $route
	 * @param $controller
	 * @return \Gram\Route\Route
	 */
	public static function patch(string $route,$controller)
	{
		return self::app()->patch($route,$controller);
	}

	/**
	 * Fügt eine HEAD Route hinzu
	 *
	 * @param string $route
	 * @param $controller
	 * @return \Gram\Route\Route
	 */
	public static function head(string $route,$controller)
	{
		return self::app()->head($route,$controller);
	}

	/**
	 * Fügt eine Options Route hinzu
	 *
	 * @param string $route
	 * @param $controller
	 * @return \Gram\Route\Route
	 */
	public static function options(string $route,$controller)
	{
		return self::app()->options($route,$controller);
	}

	/**
	 * Fügt eine Route hinzu die bei allen Http Methods gematcht wird
	 *
	 * @param string $route
	 * @param $controller
	 * @return \Gram\Route\Route
	 */
	public static function any(string $route,$controller)
	{
		return self::app()->any($route,$controller);
	}

	/**
	 * Setze den Base Path
	 *
	 * @param string $base
	 */
	public static function setBase(string $base)
	{
		self::app()->setBase($base);
	}

	/**
	 * Bestimmte was bei 404 Fehlern ausgeführt werden soll
	 *
	 * @param $controller
	 */
	public static function notFound($controller)
	{
		self::app()->set404($controller);
	}

	/**
	 * Bestimmte was bei 405 Fehlern ausgeführt werden soll
	 *
	 * @param $controller
	 */
	public static function notAllowed($controller)
	{
		self::app()->set405($controller);
	}

	/**
	 * Setze Middleware die unabhänig der gematchten Route
	 * ausgeführt wird
	 *
	 * @param $middleware
	 */
	public static function stdMiddleware($middleware)
	{
		self::app()->addMiddleware($middleware);
	}
}