<?php

namespace verizxn\F7Kit;

class View
{
  public string $path;
  private string $title;
  public string $url;
  private string $code;
  public ?Navbar $navbar;

  public function __construct(string $title, string $path, callable|string $code)
  {
    $this->navbar = null;
    $this->path = $path;
    $this->title = $title;
    $this->url = '/index.php' . $path;

    if (is_string($code)) {
      if (!file_exists($code))
        throw new \Exception('File was not found.');
      $this->code = $code;
    } else {
      $this->code = $code();
    }
  }

  public function getCode()
  {
    $twig = new \Twig\Environment(Templates::getTemplate('view'));
    return $twig->render('view', [
      'name' => $this->path,
      'navbar' => $this->navbar ? $this->navbar->render($this->title) : '',
      'code' => $this->code,
    ]);
  }

}