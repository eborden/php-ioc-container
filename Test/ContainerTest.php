<?php

namespace Test;

use \Container;

class ContainterTest extends \PHPUnit_Framework_TestCase {

	protected $C;

	public function setup () {
		$this->C = new Container();
	}

	public function testRegister () {
		$this->C->register(new MockObject());
		$this->assertTrue($this->C['Test\MockObject'] instanceof MockObject);
	}
}
