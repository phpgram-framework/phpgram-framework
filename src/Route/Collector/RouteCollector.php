<?php
namespace Gram\Project\Route\Collector;
use Gram\Project\App\ProjectApp;
use Gram\App\App;

class RouteCollector
{
	private static $_instance,$_collector;

	public static function add($route,$controller,$method=['get']){
		return self::route()->add($route,ProjectApp::$options['routing']['namespace']['controller'].$controller,$method);
	}

	public static function addGroup($prefix, callable $callback){
		return self::route()->addGroup($prefix,$callback);
	}

	public static function notFound($controller){
		return self::route()->set404(ProjectApp::$options['routing']['namespace']['controller'].$controller);
	}

	public static function notAllowed($controller){
		return self::route()->set405(ProjectApp::$options['routing']['namespace']['controller'].$controller);
	}

	/**
	 * Gibt das aktuelle Objekt zurück
	 */
	public static function route() {
		if(!isset(self::$_collector)) {
			self::$_collector=App::init()->getRouter()->getCollector();
		}

		return self::$_collector;
	}
}