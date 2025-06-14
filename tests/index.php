<?php

use verizxn\F7Kit\App;
use verizxn\F7Kit\Theme;
use verizxn\F7Kit\View;
use verizxn\F7Kit\Navbar;

require_once __DIR__ . '/../vendor/autoload.php';

$home = new View('/', function () {
  return <<<HTML
    <p>Hello World</p>
    <p><a href="about" class="link">Go to About</a></p>
  HTML;
}, new Navbar('Home'));

$about = new View('/about', function () {
  return <<<HTML
    <p>About Page</p>
  HTML;
}, new Navbar('About', true));

$app = new App('test', 'io.test', [$home, $about], Theme::auto);
$app->render(
  'https://cdnjs.cloudflare.com/ajax/libs/framework7/3.6.7/css/framework7.min.css',
  'https://cdnjs.cloudflare.com/ajax/libs/framework7/3.6.7/js/framework7.min.js'
);