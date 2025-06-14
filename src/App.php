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

    $html = '<!DOCTYPE html><html lang="it"><head><meta charset="utf-8">' .
      '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui, viewport-fit=cover">' .
      '<meta name="apple-mobile-web-app-capable" content="yes"><meta name="theme-color" content="#2196f3">' .
      '<title>' . $this->name . '</title><link rel="stylesheet" href="' . $cssPath . '"></head>' .
      '<body><div id="app"><div class="statusbar"></div><div class="view view-main">' . $page . '</div></div>' .
      '<script src="' . $jsPath . '"></script><script>' .
      'var app=new Framework7({root:"#app",name:"' . $this->name . '",id:"' . $this->id . '",theme:"' . $this->theme->value .
      '",panel:{swipe:"left"},routes:[';
    foreach ($this->views as $view)
      $html .= "{path: '{$view->path}',url: '{$view->url}'},";
    $html .= ']}),mainView=app.views.create(".view-main");</script></body></html>';
    die($html);
  }

}