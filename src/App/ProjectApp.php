<?php
namespace Gram\Project\App;
use Gram\Strategy\StrategyInterface;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;

use Gram\App\App;
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

		App::setFactory($psr17Factory,$psr17Factory);

		App::app()->start($request);
	}

	public static function init(array $options=[],array $appOptions=[], StrategyInterface $strategy=null)
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

		if(!empty($appOptions)){
			App::setOptions($appOptions);
		}

		if(isset($strategy)){
			App::setStrategy($strategy);
		}

		return self::$_instance;
	}
}