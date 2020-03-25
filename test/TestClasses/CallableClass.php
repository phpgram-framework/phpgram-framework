<?php
namespace Gram\Project\Test\TestClasses;

use Gram\Middleware\Classes\ClassInterface;
use Gram\Middleware\Classes\ClassTrait;

class CallableClass implements ClassInterface
{
	use ClassTrait;

	public function index($param = null)
	{
		return $param ?? "false";
	}
}