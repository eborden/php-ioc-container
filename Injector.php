<?php

class Injector {
	
	protected $C;
	protected $Depth;

	public function __construct (Container $c, $depth = 1) {
		$this->C = $c;
		$this->Depth = 1;
	}

	public function construct ($class) {
		return $this->_construct($class, $this->Depth);
	}

	protected function _construct ($class, $depth) {
		$reflection = new ReflectionClass($class);
		return $reflection->newInstanceArgs($this->getParams($reflection->getConstructor()->getParameters(), $depth));
	}

	public function method ($obj, $method) {
		$objReflection = new ReflectionObject($obj);
		$methodReflection = new ReflectionMethod($objReflection->getName(), $method);
		return $methodReflection->invokeArgs($obj, $this->getParams($methodReflection->getParameters(), $this->Depth));
	}

	protected function getParams (Array $paramRefs, $depth) {

		$params = array();

		foreach ($paramRefs as $i => $paramRef) {

			$class = $paramRef->getClass();
			$hint = isset($class) ? $class->getName() : null;


			if (isset($class) and $this->C->offsetExists($hint)) {
				$param = $this->C[$hint];
			}

			$name = $paramRef->getName();
			if (!isset($param) and $this->C->offsetExists($name)) {
				$param = $this->C[$name];
			}

			if (isset($param)) {
				$params[] = $param;
			} else {

				$error = new \InvalidArgumentException('Failed to inject argument ' . $i);

				// If this is a class try to build it from known dependencies
				if (isset($class) and $depth > 0) {
					try {
						$params[] = $this->_construct($class->getName(), --$depth);
					} catch (\InvalidArgumentException $e) {
						throw $error;
					}
				} else {
					throw $error;
				}
			}
			unset($param, $class, $hint);
		}
		return $params;
	}
}
