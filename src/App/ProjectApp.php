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

/** @version 1.0.6 */

namespace Gram\Project\App;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Gram\App\App;

/**
 * Class ProjectApp
 * @package Gram\Project\App
 *
 * Factory für phpgram App
 *
 * Erstellt Request from globals mit Nyholm Psr
 *
 * Setzt zudem noch Mvc Options wenn die phpgram/framework-lib ebenfalls
 * verwendet werden soll
 */
class ProjectApp
{
	use AppFactoryTrait;

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

	public static function init()
	{
		if(!isset(self::$_instance)) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public static function setMvcOptions(array $options=[])
	{
		if(!empty($options)){
			//setze default werte
			$options += [
				'lang'=>[
					'textpath'=>"",
				],
				'cookie'=>[
					'cookieExp'=>strtotime('+30 days')
				]
			];

			self::$options=$options;
		}
	}
}