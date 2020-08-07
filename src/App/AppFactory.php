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

/** @version 2.1.0 */

namespace Gram\Project\App;

use Gram\App\App;
use Gram\Route\Route;
use Gram\Route\RouteGroup;
use Gram\ResolverCreator\ResolverCreatorInterface;
use Gram\Strategy\StrategyInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AppFactory
 * @package Gram\Project\App
 *
 * Singleton factory für phpgram App
 *
 * Hier kann auch eine andere App Class verwendet werden
 */
class AppFactory
{
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

	protected static function app(): App
	{
		if(!isset(self::$gram)){
			self::$gram = App::app();
		}

		return self::$gram;
	}

	/**
	 * Starte die App
	 *
	 * @param ServerRequestInterface $request
	 */
	public static function start(ServerRequestInterface $request)
	{
		/** @var \Psr\Http\Message\ResponseInterface $response */
		$response = self::app()->start($request);

		$emitter = new Emitter();

		$emitter->emit($response);
	}

	/**
	 * Bereite die App auf Async Requests vor
	 *
	 * @return App
	 */
	public static function asyncStart(): App
	{
		self::app()->build();

		return self::app();
	}

	/**
	 * Bestimmte wie Psr 7 Response erstellt werden
	 *
	 * @param ResponseFactoryInterface $responseFactory
	 */
	public static function setResponseFactory(ResponseFactoryInterface $responseFactory)
	{
		self::app()->setFactory($responseFactory);
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
	public static function debugMode(bool $type = true)
	{
		self::app()->debugMode($type);
	}

	/**
	 * @deprecated Legacy Way use @see group() instead
	 *
	 * @param $prefix
	 * @param callable $callback
	 * @return RouteGroup
	 */
	public static function addGroup($prefix, callable $callback): RouteGroup
	{
		return self::app()->group($prefix,$callback);
	}

	/**
	 * Fügt eine Route group hinzu
	 *
	 * @param $prefix
	 * @param callable $callback
	 * @return RouteGroup
	 */
	public static function group($prefix, callable $callback): RouteGroup
	{
		return self::app()->group($prefix,$callback);
	}

	/**
	 * Fügt eine Route mit beliebiger Method hinzu
	 *
	 * @param string $route
	 * @param $controller
	 * @param array $method
	 * @return Route
	 */
	public static function add(string $route,$controller,array $method): Route
	{
		return self::app()->add($route,$controller,$method);
	}

	/**
	 * Fügt eine GET Route hinzu
	 *
	 * @param string $route
	 * @param $controller
	 * @return Route
	 */
	public static function get(string $route,$controller): Route
	{
		return self::app()->get($route,$controller);
	}

	/**
	 * Fügt eine POST Route hinzu
	 *
	 * @param string $route
	 * @param $controller
	 * @return Route
	 */
	public static function post(string $route,$controller): Route
	{
		return self::app()->post($route,$controller);
	}

	/**
	 * Fügt eine Route die sowohl GET oder POST sein kann hinzu
	 *
	 * @param string $route
	 * @param $controller
	 * @return Route
	 */
	public static function getpost(string $route,$controller): Route
	{
		return self::app()->getpost($route,$controller);
	}

	/**
	 * Fügt eine DELETE Route hinzu
	 *
	 * @param string $route
	 * @param $controller
	 * @return Route
	 */
	public static function delete(string $route,$controller): Route
	{
		return self::app()->delete($route,$controller);
	}

	/**
	 * Fügt eine PUT Route hinzu
	 *
	 * @param string $route
	 * @param $controller
	 * @return Route
	 */
	public static function put(string $route,$controller): Route
	{
		return self::app()->put($route,$controller);
	}

	/**
	 * Fügt eine Patch Route hinzu
	 *
	 * @param string $route
	 * @param $controller
	 * @return Route
	 */
	public static function patch(string $route,$controller): Route
	{
		return self::app()->patch($route,$controller);
	}

	/**
	 * Fügt eine HEAD Route hinzu
	 *
	 * @param string $route
	 * @param $controller
	 * @return Route
	 */
	public static function head(string $route,$controller): Route
	{
		return self::app()->head($route,$controller);
	}

	/**
	 * Fügt eine Options Route hinzu
	 *
	 * @param string $route
	 * @param $controller
	 * @return Route
	 */
	public static function options(string $route,$controller): Route
	{
		return self::app()->options($route,$controller);
	}

	/**
	 * Fügt eine Route hinzu die bei allen Http Methods gematcht wird
	 *
	 * @param string $route
	 * @param $controller
	 * @return Route
	 */
	public static function any(string $route,$controller): Route
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
	 * @deprecated
	 * use @see addMiddleware instead
	 *
	 * Setze Middleware die unabhänig der gematchten Route
	 * ausgeführt wird
	 *
	 * @param mixed $middleware
	 * @return App
	 */
	public static function stdMiddleware($middleware)
	{
		return self::app()->addMiddleware($middleware);
	}

	/**
	 * Setze Middleware die unabhänig der gematchten Route
	 * ausgeführt wird
	 *
	 * @param mixed $middleware
	 * @return App
	 */
	public static function addMiddleware($middleware)
	{
		return self::app()->addMiddleware($middleware);
	}
}