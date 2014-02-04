<?php

class Injector {
	
	public $C;

	public function __construct (Container $c) {
		$this->C = $c;
	}

	public function constructor ($class) {
		$reflection = new ReflectionClass($class);
		return $reflection->newInstanceArgs($this->getParams($reflection->getConstructor()->getParameters()));
	}

	public function method ($obj, $method) {
		$objReflection = new ReflectionObject($obj);
		$methodReflection = new ReflectionMethod($objReflection->getName(), $method);
		return $methodReflection->invokeArgs($obj, $this->getParams($methodReflection->getParameters()));
	}

	protected function getParams (Array $paramRefs) {
		$container = $this->C;
		return array_map(function ($paramRef, $i) use ($container) {

			$class = $paramRef->getClass();
			$hint = isset($class) ? $class->getName() : null;

			if ($class and $hint == 'Container') {
				$param = $container;
			} else {
				if (isset($class)) {
					$param = $container[$hint];
				}

				if (!isset($param)) {
					$param = $container[$paramRef->getName()];
				}
			}

			if ($param !== null) {
				return $param;
			} else {
				throw new \InvalidArgumentException('Failed to inject argument ' . $i);
			}
		}, $paramRefs, range(0, count($paramRefs) - 1));
	}
}
