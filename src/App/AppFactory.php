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

/** @version 1.1.0 */

namespace Gram\Project\App;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;

/**
 * Class AppFactory
 * @package Gram\Project\App
 *
 * Factory für phpgram App
 *
 * Erstellt Request from globals mit Nyholm Psr
 *
 * Setzt zudem noch Mvc Options wenn die phpgram/framework-lib ebenfalls
 * verwendet werden soll
 */
class AppFactory
{
	use AppFactoryTrait;

	public function start()
	{
		//psr 7
		$psr17Factory=new Psr17Factory();

		$request=new ServerRequestCreator($psr17Factory,$psr17Factory,$psr17Factory,$psr17Factory);
		$request=$request->fromGlobals();

		self::app()->setFactory($psr17Factory,$psr17Factory);

		self::app()->start($request);
	}
}