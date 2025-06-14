<?php

namespace verizxn\F7Kit;

class App
{
  public string $name;
  public string $id;
  private array $views;
  public Theme $theme;

  public function __construct(string $name, string $id, array $views = [], Theme $theme = Theme::auto)
  {
    if (!empty($views))
      foreach ($views as $view)
        if (!$view instanceof View)
          throw new \InvalidArgumentException('Invalid views.');

    $this->name = $name;
    $this->id = $id;
    $this->views = $views;
    $this->theme = $theme;
  }

  public function render(string $cssPath, string $jsPath)
  {
    $path = $_SERVER['PATH_INFO'] ?? '/';
    $page = '';
    foreach ($this->views as $view)
      if ($view->path === $path)
        $page = $view->getCode();

    $views = '';
    foreach ($this->views as $view)
      $views .= "{path: '{$view->path}', url: '{$view->url}'},";

    $twig = new \Twig\Environment(Templates::getTemplate('index'));
    die($twig->render('index', [
      'name' => $this->name,
      'id' => $this->id,
      'theme' => $this->theme->value,
      'cssPath' => $cssPath,
      'jsPath' => $jsPath,
      'page' => $page,
      'views' => $views
    ]));
  }
}