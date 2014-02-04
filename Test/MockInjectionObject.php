<?php

namespace Test;

use \Container;

class MockInjectionObject {

	public $O;
	public $O2;
	public $O3;
	public $Int;
	public $C;

	public function __construct (MockObject $o, Container $c) {
		$this->O = $o;
		$this->C = $c;
	}

	public function doStuff (MockObject $o, $randomInt) {
		$this->O2 = $o;
		$this->Int = $randomInt;
	}

	public function doUnknownDep (MockUnknownObject $o) {
		$this->O3 = $o;
	}

	public function doOtherStuff (MockObject $o, $foo) {
	}

	public function doMorerStuff ($bar) {
	}
}
