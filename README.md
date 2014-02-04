php ioc container
=================

A simple IoC layer on top of pimple.

++ Register objects
```
$c = new Container();
$c->register(new Foo\Bar\Baz);
```

++ Constructor Injections
```
$i = new Injector($c);
$o = $i->construct('Foo\Bar\Baz');
```

++ Method Injections
```
$i->method($o, 'biz');
```
