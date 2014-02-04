php ioc container
=================

A simple IoC layer on top of pimple.

#### Register objects
```
$c = new Container();
$c->register(new Foo\Bar\Baz);
```

#### Or add keys the pimple way
```
$c['injectedInt'] = 20;
```

#### Constructor Injections
```
$i = new Injector($c);
$o = $i->construct('Foo\Bar\Baz');
```

#### Method Injections
```
$i->method($o, 'biz');
```

#### Inject on class or key
class Baz {
  public function biz ($injectedInt) {
     echo $injectedInt . ' was injected'; // 20 was injected
  }
}
