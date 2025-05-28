<?php
namespace App\Controllers;
use App\Models\ProductoModel;

class ProductController extends BaseController {
  private $productoModel;

  public function __construct() {
    $this->productoModel = new ProductoModel();
  }

  public function findAll(){
    $productos = $this->productoModel->findAll();
    return $this->response->setJSON($productos);
  }

  public function findById($id){
    $producto = $this->productoModel->find($id);
    if ($producto) {
      return $this->response->setJSON($producto);
    } else {
      return $this->response->setStatusCode(404, 'Producto no encontrado');
    }
  }

}
