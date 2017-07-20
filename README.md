## baseApp

### Setup

- Start by cloning this repo
- Run `composer install`
- Add  your controllers/views
- Define some routes in `config/routes.php`

### Controllers

Controllers are currently extremely basic with some basic methods, you should always extend the `Controller_Base` class

### Views

Put them in `views/` -- for example, `views/homepage.html`

You can then display this view from your controller with `$this->view('homepage');`

Or you can do
```php
$this->view('homepage', [
    'title' => 'My App'
]);
```
which makes the `$title` var available in the view.

### Routing

Routing uses `AltoRouter` which is more or less `klein.php` 

Define routes in `config/routes.php` ie, 
```php
$router->map('GET|POST', '/my-route', 'Controller@Action');
```

### Models

Models currently don't exist within baseApp
