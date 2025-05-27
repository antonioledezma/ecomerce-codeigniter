<?php
namespace App\Controllers;
use App\Models\ProductoModel;

class PageController extends BaseController {
  private $productoModel;

  public function __construct() {
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
  
}
