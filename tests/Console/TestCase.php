<?php
namespace p2made\Uuid\Console;

use p2made\Uuid\TestCase as UuidTestCase;

class TestCase extends UuidTestCase
{
	protected function setUp()
	{
		$this->skipIfNoSymfonyConsole();
		$this->skipIfNoMoontoastMath();
	}
}
