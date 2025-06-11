<?php
namespace App\Controllers;
use App\Models\ProductoModel;

class ProductController extends BaseController {
  private $productoModel;

  public function __construct() {
    $this->productoModel = new ProductoModel();
  }

  public function find(){
    $name = $this->request->getGet('name');
    $id = $this->request->getGet('id');
    $producto = null;

    if($name){
       $producto = $this->productoModel->where('name', $name)->first();
    } elseif($id){
       $producto = $this->productoModel->find($id);
    } else {
       $producto = $this->productoModel->findAll();
    }

    if ($producto) {
      return $this->response->setJSON($producto);
    } else {
      return $this->response->setStatusCode(404, 'Producto no encontrado');
    }
  }

}
