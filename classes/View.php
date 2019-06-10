<?php


class View
{
  private static $instance;
  private static $twig;

  public static function initializeTwig()
  {
    if (!isset(self::$instance)) {
      self::$instance = new View();
      self::$instance->initTwig();
    }
    return self::$instance;
  }

  private function initTwig()
  {
    $loader = new Twig_Loader_Filesystem(__DIR__ . '\..\views');
    self::$twig = new Twig_Environment($loader, ['debug' => true]);
    self::$twig->addExtension(new \Twig\Extension\DebugExtension());
  }

  public static function getTwig()
  {
    if (empty(self::$instance)) {
      throw new Exception("Please init View");
    }
    return self::$twig;
  }
}
