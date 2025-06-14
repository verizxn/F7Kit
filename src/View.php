<?php

namespace verizxn\F7Kit;

class View
{
  public string $path;
  public string $url;
  private string $code;

  public function __construct(string $path, callable $code, ?Navbar $navbar = null)
  {
    $this->path = $path;
    $this->url = '/index.php' . $path;
    $this->code = '<div class="page" data-name="about">' . ($navbar ? $navbar->render() : '') .
      '<div class="page-content">' . $code() . '</div></div>';
  }

  public function getCode()
  {
    return $this->code;
  }

}