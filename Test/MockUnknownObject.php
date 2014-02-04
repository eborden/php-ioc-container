<?php

namespace Test;

class MockUnknownObject {

	public $O;

	public function __construct (MockObject $o) {
		$this->O = $o;
	}
}
