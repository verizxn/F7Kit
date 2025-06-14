<?php

namespace verizxn\F7Kit;

class Navbar
{
  public string $title;
  private bool $backButton;

  public function __construct(string $title, bool $backButton = false)
  {
    $this->title = $title;
    $this->backButton = $backButton;
  }

  public function render()
  {
    return '
    <div class="navbar"><div class="navbar-inner">' .
      ($this->backButton ?
        '<div class="left"><a class="link back"><i class="icon icon-back"></i><span class="ios-only">Back</span></a></div>'
        : '') .
      '<div class="title">' . $this->title . '</div></div></div>';
  }
}