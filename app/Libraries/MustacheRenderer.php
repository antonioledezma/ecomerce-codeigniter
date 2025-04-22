<?php namespace App\Libraries;

use Mustache_Engine;
use Mustache_Loader_FilesystemLoader;

class MustacheRenderer{
  protected $mustache;

  public function __construct(array $config = null){
    $template_dir = APPPATH . 'Views/templates';
    $options = [
      'loader' => new Mustache_Loader_FilesystemLoader($template_dir),
      'partials_loader' => new Mustache_Loader_FilesystemLoader($template_dir),
    ];

    $this->mustache = new Mustache_Engine($options);
  }

  public function render($template, array $data = []){
    return $this->mustache->render($template, $data);
  }
}
