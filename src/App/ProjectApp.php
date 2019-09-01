<?php
namespace Gram\Project\App;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;

use Gram\App\App;
class ProjectApp
{
	public static $options;
	private static $_instance;

	public function start(){
		//psr 7
		$psr17Factory=new Psr17Factory();

		$request=new ServerRequestCreator($psr17Factory,$psr17Factory,$psr17Factory,$psr17Factory);
		$request=$request->fromGlobals();

		App::setFactory($psr17Factory,$psr17Factory);

		App::init()->start($request);
	}

	public static function init(array $options=[]) {
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
}