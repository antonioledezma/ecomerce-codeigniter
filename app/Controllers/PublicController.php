<?php

namespace App\Controllers;
use App\Libraries\MustacheRenderer;
use Mustache_Engine;
use App\Models\ProductoModel;

class PublicController extends BaseController {
  private $mustacheRenderer;
  private $productoModel;

  public function __construct() {
    $this->mustacheRenderer = new MustacheRenderer();
    $this->productoModel = new ProductoModel();
  }

  public function principal(){
    $data = [
      'title' => 'Principal',
      'productList' => $this->productoModel->findAll()
    ];
    echo $this->mustacheRenderer->render('page/principal', $data);
  }

  public function comercializacion(){
    $data = [
      'title' => 'Principal'
    ];
    echo $this->mustacheRenderer->render('page/comercializacion', $data);
  }

  public function informacionDeContacto(){
    $data = [
      'title' => 'información de contacto'
    ];
    echo $this->mustacheRenderer->render('page/informacion-de-contacto', $data);
  }

  public function quienesSomos(){
    $data = [
      'title' => 'Quienes somos'
    ];
    echo $this->mustacheRenderer->render('page/quienes-somos', $data);
  }

  public function terminosYUso(){
    $data = [
      'title' => 'Términos y uso'
    ];
    echo $this->mustacheRenderer->render('page/terminos-y-uso', $data);
  }

  public function productDetail(){
    $data = [
      'title' => 'Producto'
    ];
    echo $this->mustacheRenderer->render('page/product-detail', $data);
  }

}

