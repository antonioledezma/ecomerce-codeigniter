<?php

namespace App\Controllers;
use App\Libraries\MustacheRenderer;
use Mustache_Engine;
use App\Models\ProductoModel;

class PageController extends BaseController {
  private $mustacheRenderer;
  private $productoModel;

  public function __construct() {
    $this->mustacheRenderer = new MustacheRenderer();
    $this->productoModel = new ProductoModel();
  }

  public function principal(){
    $data = [
      'title' => 'Principal',
      'breadcrumbs-items' => [
        ['title' => 'Principal', 'url' => '/principal']
      ],
      'productList' => $this->productoModel->findAll()
    ];
    echo $this->mustacheRenderer->render('page/principal', $data);
  }

  public function comercializacion(){
    $data = [
      'title' => 'Principal',
      'breadcrumbs-items' => [
        ['title' => 'Principal', 'url' => '/principal'],
        ['title' => 'Comercialización', 'url' => '/comercializacion'],
      ]
    ];
    echo $this->mustacheRenderer->render('page/comercializacion', $data);
  }

  public function informacionDeContacto(){
    $data = [
      'title' => 'información de contacto',
      'breadcrumbs-items' => [
        ['title' => 'Principal', 'url' => '/principal'],
        ['title' => 'información de contacto', 'url' => '/informacion-de-contacto'],
      ]
    ];
    echo $this->mustacheRenderer->render('page/informacion-de-contacto', $data);
  }

  public function quienesSomos(){
    $data = [
      'title' => 'Quienes somos',
      'breadcrumbs-items' => [
        ['title' => 'Principal', 'url' => '/principal'],
        ['title' => 'Quienes somos', 'url' => '/quienes-somos'],
      ]
    ];
    echo $this->mustacheRenderer->render('page/quienes-somos', $data);
  }

  public function terminosYUso(){
    $data = [
      'title' => 'Términos y uso',
      'breadcrumbs-items' => [
        ['title' => 'Principal', 'url' => '/principal'],
        ['title' => 'Términos y uso', 'url' => '/terminos-y-uso'],
      ]
    ];
    echo $this->mustacheRenderer->render('page/terminos-y-uso', $data);
  }

  public function productDetail(){
    $data = [
      'title' => 'Producto',
      'breadcrumbs-items' => [
        ['title' => 'Principal', 'url' => '/principal'],
        ['title' => 'Producto', 'url' => '/product-detail'],
      ]
    ];
    echo $this->mustacheRenderer->render('page/product-detail', $data);
  }

  public function catalogo(){
    $data = [
      'title' => 'Catálogo',
      'breadcrumbs-items' => [
        ['title' => 'Principal', 'url' => '/principal'],
        ['title' => 'Catálogo', 'url' => '/catalogo'],
      ]
    ];
    echo $this->mustacheRenderer->render('page/catalogo', $data);
  }

}

