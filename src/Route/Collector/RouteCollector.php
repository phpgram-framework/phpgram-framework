<?php
namespace Gram\Project\Route\Collector;
use Gram\Project\App\ProjectApp as App;

class RouteCollector
{
	private static $_instance,$_collector;

	public static function add($route,$controller,$method='get'){
		return self::route()->add($route,App::$options['routing']['namespace']['controller'].$controller,$method);
	}

	public static function api($route,$controller,$method='get'){
		return self::route()->api($route,App::$options['routing']['namespace']['controller'].$controller,$method);
	}

	public static function addGroup($prefix, callable $callback){
		return self::route()->setGroup($prefix,$callback);
	}

	public static function notFound($controller,$function=""){
		return self::route()->notFound(App::$options['routing']['namespace']['controller'].$controller,$function);
	}

	public static function notAllowed($controller,$function=""){
		return self::route()->notAllowed(App::$options['routing']['namespace']['controller'].$controller,$function);
	}

	/**
	 * Gibt das aktuelle Objekt zurück
	 */
	public static function route() {
		if(!isset(self::$_instance)) {
			self::$_instance = new self();
			self::$_collector=\Gram\Route\Collector\RouteCollector::route();
		}

		return self::$_collector;
	}
}