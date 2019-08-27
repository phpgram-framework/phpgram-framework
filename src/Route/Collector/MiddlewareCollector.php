<?php
namespace Gram\Project\Route\Collector;
use Gram\Project\App\ProjectApp as App;
class MiddlewareCollector
{
	private static $typ;

	public static function add($route,array $stack){

		$stack=array_map(array("\Gram\Project\Route\Collector\MiddlewareCollector","namespaceMiddle"),$stack);

		self::middle()->add($route,$stack);
	}

	public static function addStd(array $stack){
		$stack=array_map(array("\Gram\Project\Route\Collector\MiddlewareCollector","namespaceMiddle"),$stack);

		self::middle()->addStd($stack);
	}

	public static function namespaceMiddle($item){
		return App::$options['routing']['namespace']['middle'].$item;
	}

	public static function middle($typ="") {
		if($typ!=""){
			self::$typ=$typ;
		}

		return \Gram\Route\Collector\MiddlewareCollector::middle($typ);
	}
}