<?php
namespace Gram\Project\Test;

use Gram\Middleware\ResponseCreator;
use Gram\Project\App\AppFactory as App;
use Gram\Project\Test\TestClasses\CallableClass;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

abstract class AbstractAppTest extends TestCase
{
	/** @var ServerRequestInterface */
	protected $request;

	/** @var Psr17Factory */
	protected $psr17;

	/** @var \Gram\App\App */
	protected $app;

	protected function setUp(): void
	{
		$this->initApp();

		parent::setUp();
	}

	protected function initApp()
	{
		$this->psr17 = new Psr17Factory();

		$creator = new ServerRequestCreator($this->psr17,$this->psr17,$this->psr17,$this->psr17);

		$this->request = $creator->fromGlobals();

		App::setResponseFactory($this->psr17);
	}

	protected function iniRoutes()
	{
		App::group("/test",function (){
			App::get("/first",function (){
				return "1st";
			});

			App::post("/second[/{param}]",CallableClass::class."@index");

			App::getpost("/getpost",function (){
				return "getpost";
			});

			App::get("/slash",function (){
				return "slash";
			});

			App::delete("/delete",function (){
				return "delete";
			});
		});
	}

	public function testRoutes()
	{
		$this->iniRoutes();

		$this->app = App::asyncStart();

		$uris = [
			'https://jo.com/test/first'=>["1st","GET"],
			'https://jo.com/test/second'=>["false","POST"],
			'https://jo.com/test/second/123'=>["123","POST"],
			'https://jo.com/test/delete'=>["delete","DELETE"]
		];

		foreach ($uris as $uri=>$expect) {
			[$expecting,$method] = $expect;

			$uriInterface = $this->psr17->createUri($uri);
			$request = $this->request->withUri($uriInterface);
			$request = $request->withMethod($method);

			$response = $this->app->handle($request);

			$result = $response->getBody()->__toString();

			self::assertEquals($expecting,$result);
		}
	}

	public function testResponseCreator()
	{
		$creator = App::getResponseCreator();

		self::assertEquals(true,$creator instanceof RequestHandlerInterface);
		self::assertEquals(true,$creator instanceof ResponseCreator);
	}

	public function testRouterOptions()
	{
		App::setRouterOptions([
			'slash_trim'=>false,
		]);

		$this->testRoutes();	//mache den normalen Route test nochmal

		$uriInterface = $this->psr17->createUri('https://jo.com/test/slash/');
		$request = $this->request->withUri($uriInterface);

		$response = $this->app->handle($request);

		$status = $response->getStatusCode();

		self::assertEquals("404",$status);
	}


}