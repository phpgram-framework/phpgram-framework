<?php
namespace Gram\Project\Route\Collector;
use Gram\Project\App\ProjectApp;
use Gram\App\App;
class MiddlewareCollector
{
	private static $_collector;

	public static function add($middleware)
	{
		return self::middle()->addStd($middleware);
	}

	public static function middle()
	{
		if(!isset(self::$_collector)) {
			self::$_collector=App::app()->getMWCollector();
		}

		return self::$_collector;
	}
}