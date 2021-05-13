<?php

namespace Mubangizi\Core;

use Mubangizi\Core\Widget\Widget;
use Twig\Extension\EscaperExtension;

class View
{

  public $views;
  public $layout;

  public function __construct($layout = 'main')
  {
    $this->layout = $layout;
    $this->views = Application::$ROOT_DIR . '/views';
  }

  public function render($view, $params = [])
  {
    static $twig = null;

    if ($twig === null) {
      $loader = new \Twig\Loader\FilesystemLoader();
      $loader->setPaths([$this->views, "{$this->views}/layouts"]);

      $twig = new \Twig\Environment($loader);

      /** @var EscaperExtension */
      $escaper = $twig->getExtension(EscaperExtension::class);
      $escaper->addSafeClass(Widget::class, ['html']);
    }

    return $twig->render("$view.twig", $params);
  }
}
