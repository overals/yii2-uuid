<?php
namespace p2made\Uuid\Console;

class ApplicationTest extends TestCase
{
	/**
	 * @covers p2made\Uuid\Console\Application::__construct
	 */
	public function testConstructor()
	{
		$app = new Application();

		// Reset the error handler, since the constructor sets it
		restore_error_handler();

		$this->assertInstanceOf('Rhumsaa\\Uuid\\Console\\Application', $app);
		$this->assertEquals('uuid', $app->getName());
		$this->assertEquals(\p2made\Uuid\Uuid::VERSION, $app->getVersion());
	}
}
