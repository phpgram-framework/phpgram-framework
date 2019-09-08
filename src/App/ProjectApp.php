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

namespace Gram\Project\App;

use Gram\Strategy\StrategyInterface;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;

use Gram\App\App;

/**
 * Class ProjectApp
 * @package Gram\Project\App
 *
 * Startet die App und setzt Optionen
 */
class ProjectApp
{
	public static $options;
	private static $_instance;

	public function start()
	{
		//psr 7
		$psr17Factory=new Psr17Factory();

		$request=new ServerRequestCreator($psr17Factory,$psr17Factory,$psr17Factory,$psr17Factory);
		$request=$request->fromGlobals();

		App::app()->setFactory($psr17Factory,$psr17Factory);

		App::app()->start($request);
	}

	public static function init(array $options=[])
	{
		if(!isset(self::$_instance)) {
			self::$_instance = new self();
		}

		if(!empty($options)){
			//setze default werte
			$options += [
				'routing'=>[
					'namespace'=>[
						'controller'=>"",
						'middle'=>""
					]
				],
				'view'=>[
					'templates'=>"",
					'viewCache'=>""
				],
				'db'=>[
					'host'=>"",
					'dbname'=>"",
					'charset'=>"",
					'user'=>"",
					'pw'=>""
				],
				'lang'=>[
					'textpath'=>"",
				],
				'cookie'=>[
					'cookieExp'=>strtotime('+30 days')
				]
			];

			self::$options=$options;
		}

		return self::$_instance;
	}

	public static function setRouteOptons(array $routeOptions=[])
	{
		App::app()->setOptions($routeOptions);
	}

	public static function setStrategy(StrategyInterface $strategy=null)
	{
		App::app()->setStrategy($strategy);
	}
}