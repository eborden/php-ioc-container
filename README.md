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
