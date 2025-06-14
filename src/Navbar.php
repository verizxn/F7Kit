<?php

namespace verizxn\F7Kit;

class Navbar
{
  public array $views;

  public function __construct(array $views)
  {
    foreach ($views as $view)
      if (!$view instanceof View)
        throw new \InvalidArgumentException('Invalid views.');
    $this->views = $views;

    foreach ($views as $view)
      $view->navbar = $this;
  }

  public function render(string $title)
  {
    $path = $_SERVER['PATH_INFO'] ?? '/';
    $twig = new \Twig\Environment(Templates::getTemplate('navbar'));
    return $twig->render('navbar', [
      'title' => $title,
      'backButton' => $this->views[0]->path !== $path
    ]);
  }
}