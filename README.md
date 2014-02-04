php ioc container
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

#### Constructor Injections
```php
$i = new Injector($c);
$o = $i->construct('Foo\Bar\Baz');
```

#### Method Injections
```php
$i->method($o, 'biz');
```

#### Inject on class or var name
```php
class Baz {
  public function biz ($injectedInt) {
     echo $injectedInt . ' was injected'; // 20 was injected
  }
}
```
