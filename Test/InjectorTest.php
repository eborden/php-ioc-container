<?php

namespace Test;

use \Container,
    \Injector;

class InjectorTest extends \PHPUnit_Framework_TestCase {

	protected $C;
	protected $I;

	public function setup () {
		$this->C = new Container();
		$this->C->register(new MockObject());
		$this->C['randomInt'] = 20;
		$this->C->register($this->C); // Meta
		$this->I = new Injector($this->C, 1);
	}

	public function testConstruct () {
		$o = $this->I->construct('Test\MockInjectionObject');

		$this->assertTrue($o->O instanceof MockObject);
		$this->assertTrue($o->C instanceof Container);

		return $o;
	}

	public function testConstructDepth () {
		$o = $this->I->construct('Test\MockUnknownObject');

		$this->assertTrue($o instanceof MockUnknownObject);
		$this->assertTrue($o->O instanceof MockObject);

		return $o;
	}

	/**
	 * @depends testConstruct
	 */
	public function testMethod (MockInjectionObject $o) {
		$this->I->method($o, 'doStuff');

		$this->assertTrue($o->O2 instanceof MockObject);
		$this->assertEquals($o->Int, 20);
		
	}

	/**
	 * @depends testConstruct
	 */
	public function testMethodDepth (MockInjectionObject $o) {
		$this->I->method($o, 'doUnknownDep');

		$this->assertTrue($o->O3 instanceof MockUnknownObject);
	}
	
	/**
	 * @depends testConstruct
	 */
	public function testFailure (MockInjectionObject $o) {
		$this->setExpectedException('InvalidArgumentException', 'Failed to inject argument 1');
		$this->I->method($o, 'doOtherStuff');

		$this->setExpectedException('InvalidArgumentException', 'Failed to inject argument 0');
		$this->I->method($o, 'doMorerStuff');
	}
}
