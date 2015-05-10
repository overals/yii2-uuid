<?php
namespace p2made\Uuid\Console\Util;

use p2made\Uuid\Console\TestCase;

class ErrorHandlerTest extends TestCase
{
	/**
	 * @covers p2made\Uuid\Console\Util\ErrorHandler::register
	 */
	public function testRegister()
	{
		$expected = array (
			'Rhumsaa\\Uuid\Console\\Util\\ErrorHandler',
			'handle',
		);

		$originalHandler = set_error_handler(function () {});

		ErrorHandler::register();
		$testHandler = set_error_handler(function () {});

		// Set handler back to original
		set_error_handler($originalHandler);

		$this->assertEquals($expected, $testHandler);
	}

	/**
	 * @covers p2made\Uuid\Console\Util\ErrorHandler::handle
	 * @expectedException ErrorException
	 * @expectedExceptionMessage Test exception
	 */
	public function testHandle()
	{
		error_reporting(E_ALL);
		ErrorHandler::handle(1, 'Test exception', __FILE__, __LINE__);
	}

	/**
	 * @covers p2made\Uuid\Console\Util\ErrorHandler::handle
	 */
	public function testHandleNoException()
	{
		error_reporting(0);

		$this->assertEmpty(ErrorHandler::handle(1, 'Test exception', __FILE__, __LINE__));
	}
}
