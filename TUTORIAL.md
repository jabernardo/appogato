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
./lmvc create controller Hello
```

Command will create a Controller `app/controller/Hello.php`
base from template. All `Actions` from `Controller` should be declared
in `routes`.

> All controllers must be declared with namespace `LMVC\Controller`


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

namespace LMVC\Controller;

class Inventory extends \LMVC\Controller\Core\Base
{
    function __construct() {
        parent::__construct();
        
        $this->products = new \LMVC\Model\Products();
    }
    
    public function getAction() {
        return $this->products->get();
    }
}

```

> All model must be declared with namespace `LMVC\Model`


## Helpers

Defining a new helpers isn't that hard

```php
<?php

namespace LMVC\Helper;

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

namespace LMVC\Controller;

class Inventory extends \LMVC\Controller\Core\Base
{
    function __construct() {
        parent::__construct();
        
        $this->products = new \LMVC\Model\Products();
        $this->sort = new \LMVC\Helper\Sort();
    }
    
    public function getAction() {
        return $this->sort->bubble($this->products->get());
    }
}

```

> All controllers must be declared with namespace `LMVC\Helper`

## Views

Rendering a `view` on `app/view`.

```php
<?php

namespace LMVC\Controller;

class Welcome extends \LMVC\Controller\Core\Base
{
    function __construct() {
        parent::__construct();
    }

    function indexAction() {
        // Passing variable to view
        $this->view->welcome_message = 'Hello World!';
        
        return $this->render('welcome');
    }
}
```

`$this->render` was declared in `\LMVC\Controller\Core\Base`.
Here's what it looks like on `LMVC's Welcome Page`.

```php
<!DOCTYPE>
<html>
    <head>
        <?php include('default/meta.php') ?>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1><?= $welcome_message ?></h1>
                <p>Thank you for using <a href="https://github.com/jabernardo/lmvc">Lollipop for MVC</a>. Don't forget to give a star!</p>
            </div>
        </div>
        <?php include('default/css.php') ?>
        <?php include('default/js.php') ?>
    </body>
</html>
```

Forms...

`Lollipop\CsrfToken` are checked on form submission by default.
Please note to include `CSRF` token in forms.

```php
<form action="" method="POST" enctype="multipart/form-data">
    <?= $form->anti_csrf_input ?>
    ...
    <input type="submit" />
</form>

```

## Application logs

All application logs are saved into a text file in `app/logs`.

You could tail logs using `lmvc.sh`

```bash
./lmvc log tail
```

Purging of logs...

```bash
./lmvc log purge
```


## Cache Control

By default, all cache are stored in `filesystem` in `app/cache`.

Clearing cache through `lmvc.sh`.

```bash
./lmvc cache purge
```

Removing change by key

```bash
./lmvc cache remove key1 key2 ...
```

Getting cache content

```bash
./lmvc cache get key1 key2 ...
```
