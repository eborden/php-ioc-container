Pockmark
=================

A simple IoC layer on top of pimple.

#### Register objects
```php
$c = new Container();
$c->register(new Foo\Bar\Baz);
```

#### Or add keys the pimple way
```php
$c['injectedInt'] = 20;
```

#### Constructor Injection
```php
$i = new Injector($c);
$o = $i->construct('SomeClass');
```

#### Method Injection
```php
$i->method($o, 'biz');
```

#### Inject on class or var name
```php
class SomeClass {

  public $Baz;

  public function __construct (Foo\Bar\Baz $o) {
    $this->Baz = $o;
  }
  
  public function biz ($injectedInt) {
     echo $injectedInt . ' was injected'; // 20 was injected
  }
}
```

####Optimistic Construction
When requested to inject an object that does not exist within the container pockmark will attempt to analyze its dependencies and build it if all dependencies are within the container. This is configurable to a certain depth.

```
new Injector($c, 2); // depth of 2
new Injector($c, 0); // disabled
```
