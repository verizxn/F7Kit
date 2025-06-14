<?php

use verizxn\F7Kit\App;
use verizxn\F7Kit\Theme;
use verizxn\F7Kit\View;
use verizxn\F7Kit\Navbar;

require_once __DIR__ . '/../vendor/autoload.php';

$navbar = new Navbar(views: [
  new View(title: 'Home', path: '/', code: fn(): string =>
    <<<HTML
    <p>Hello World</p>
    <p><a href="about" class="link">Go to About</a></p>
    <p><a href="two">Navbar Two</a></p>
  HTML),
  new View(title: 'About', path: '/about', code: fn(): string =>
    <<<HTML
    <p>About Page</p>
    <p><a href="two">Navbar Two</a></p> <!-- Not callable -->
  HTML)
]);

$navbar2 = new Navbar(views: [
  new View(title: 'Home2', path: '/two', code: fn(): string =>
    <<<HTML
    <p><a href="#" class="link back">Back</a></p>
  HTML),
]);

$app = new App(name: 'test', id: 'io.test', views: array_merge($navbar->views, $navbar2->views), theme: Theme::auto);
$app->render(
  cssPath: 'https://cdnjs.cloudflare.com/ajax/libs/framework7/3.6.7/css/framework7.min.css',
  jsPath: 'https://cdnjs.cloudflare.com/ajax/libs/framework7/3.6.7/js/framework7.min.js'
);