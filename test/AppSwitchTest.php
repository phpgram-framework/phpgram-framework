<?php
namespace Gram\Project\Test;

use Gram\Project\App\AppFactory;
use Gram\Project\Test\TestClasses\AlternativeApp;

class AppSwitchTest extends AbstractAppTest
{

	protected function setUp(): void
	{
		AppFactory::setApp(new AlternativeApp());

		parent::setUp();
	}
}