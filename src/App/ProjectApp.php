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

		App::init($psr17Factory,$psr17Factory)->start($request);
	}

	public static function init(array $options=array()) {
		if(!isset(self::$_instance)) {
			self::$_instance = new self();
		}

		//setze default werte
		$options += array(
			'routing'=>array(
				'namespace'=>array(
					'controller'=>"",
					'middle'=>""
				)
			),
			'view'=>array(
				'templates'=>"",
				'viewCache'=>""
			),
			'db'=>array(
				'host'=>"",
				'dbname'=>"",
				'charset'=>"",
				'user'=>"",
				'pw'=>""
			),
			'lang'=>array(
				'textpath'=>"",
			),
			'cookie'=>array(
				'cookieExp'=>strtotime('+30 days')
			)
		);

		self::$options=$options;

		return self::$_instance;
	}
}