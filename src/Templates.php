<?php

namespace verizxn\F7Kit;

class Templates
{
  public static function getTemplate(string $name)
  {
    $path = __DIR__ . '/html/' . $name . '.twig';
    if (!file_exists($path))
      throw new \Exception('Template file not found.');

    return new \Twig\Loader\ArrayLoader([
      $name => file_get_contents(__DIR__ . '/html/' . $name . '.twig'),
    ]);
  }
}