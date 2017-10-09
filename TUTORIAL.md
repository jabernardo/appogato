# Lollipop-PHP for MVC

## Getting started

```bash
composer create-project jabernardo/lmvc hello_world
```

## Building Docker Image

```bash
docker build -t lmvc .
docker run --name lmvc_test -p 8000:80 lmvc
```

## Routes

All the request should be registered in `app/routes.php`

```php
<?php

// This kind of route will accept all request methods
// and doesn't use cache
$routes['/'] = 'WelcomeController.indexAction';

// or

$routes['/'] = array(
    'callback' => 'WelcomeController.indexAction',
    'method' => '' /*  array('GET', 'POST') */,
    'cache' => true
);

```

## Controllers

All controllers were autoloaded and should be placed in
`app/controller` or you could use `lmvc.sh` to generate one.

```bash
./lmvc create controller HelloController
```

Command will create a Controller `app/controller/HelloController.php`
base from template. All `Actions` from `Controller` should be declared
in `routes`.



## Models

All models are placed in `app/model`, just like `Controllers` 
models can be generated through `lmvc.sh`.

```bash
./lmvc create model Products
```

This will generate a `CRUD` model.

> To use `Model` in `Controller`

```php
<?php

class InventoryController extends BaseController
{
    function __construct() {
        parent::__construct();
        
        $this->load('Products');
    }
    
    public function getAction() {
        return $this->Products->get();
    }
}

```

## Helpers

Defining a new helpers isn't that hard

```php
<?php

class Sort
{
    public function bubble($arr) {
        //...
    }
}

```

also, using it!

```php
<?php

class InventoryController extends BaseController
{
    function __construct() {
        parent::__construct();
        
        $this->load('Products');
        $this->load('Sort');
    }
    
    public function getAction() {
        return $this->Sort->bubble($this->Products->get());
    }
}

```

