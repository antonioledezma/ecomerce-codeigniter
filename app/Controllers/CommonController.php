<?php

namespace App\Controllers;

class CommonController extends BaseController {

  public function principal(){
    $data = [
      'name' => 'principal',
      'breadcrumbs-items' => [
        ['title' => 'Principal', 'url' => '/principal']
      ],
      'productList' => $this->commonService->getProductList(null, null, null)
    ];

    return $this->mustache->render('page/common/principal', array_merge($data, $this->commonService->makeCommonData()));
  }

  public function comercializacion(){
    $data = [
      'name' => 'comercializacion',
      'breadcrumbs-items' => [
        ['title' => 'Principal', 'url' => '/principal'],
        ['title' => 'Comercialización', 'url' => '/comercializacion'],
      ]
    ];
    return $this->mustache->render('page/common/comercializacion', array_merge($data, $this->commonService->makeCommonData()));
  }

  public function informacionDeContacto(){
    $name = $this->request->getPostGet('name');
    $email = $this->request->getPostGet('email');
    $consulta = $this->request->getPostGet('consulta');

    if($name && $email && $consulta) {
      $this->consultaModel->insert([
        'NAME' => $name,
        'EMAIL' => $email,
        'CONSULTA' => $consulta
      ]);
      return redirect()->to('/principal')->with('success', 'Consulta enviada correctamente.');
    }

    $data = [
      'name' => 'informacion-de-contacto',
      'breadcrumbs-items' => [
        ['title' => 'Principal', 'url' => '/principal'],
        ['title' => 'información de contacto', 'url' => '/informacion-de-contacto'],
      ]
    ];
    return $this->mustache->render('page/common/informacion-de-contacto', array_merge($data, $this->commonService->makeCommonData()));
  }

  public function quienesSomos(){
    $data = [
      'name' => 'quienes-somos',
      'breadcrumbs-items' => [
        ['title' => 'Principal', 'url' => '/principal'],
        ['title' => 'Quienes somos', 'url' => '/quienes-somos'],
      ]
    ];
    return $this->mustache->render('page/common/quienes-somos', array_merge($data, $this->commonService->makeCommonData()));
  }

  public function terminosYUso(){
    $data = [
      'name' => 'terminos-y-uso',
      'breadcrumbs-items' => [
        ['title' => 'Principal', 'url' => '/principal'],
        ['title' => 'Términos y uso', 'url' => '/terminos-y-uso'],
      ]
    ];
    return $this->mustache->render('page/common/terminos-y-uso', array_merge($data, $this->commonService->makeCommonData()));
  }

  public function productDetail($id){
    $data = [
      'name' => 'product-detail',
      'product' => $this->productModel->where( ['ID' => $id])->first(),
      'breadcrumbs-items' => [
        ['title' => 'Principal', 'url' => '/principal'],
        ['title' => 'Producto', 'url' => '/product/' . $id],
      ]
    ];
    return $this->mustache->render('page/common/product-detail', array_merge($data, $this->commonService->makeCommonData()));
  }

  public function catalogo(){
    $id = $this->request->getGet('id');
    $name = $this->request->getGet('name');
    $price = $this->request->getGet('price');
    $productList = $this->commonService->getProductList($id, $name, $price);

    $data = [
      'name' => 'catalogo',
      'productList' => $productList == [] ? null : $productList,
      'breadcrumbs-items' => [
        ['title' => 'Principal', 'url' => '/principal'],
        ['title' => 'Catálogo', 'url' => '/catalogo'],
      ]
    ];
    return $this->mustache->render('page/common/catalogo', array_merge($data, $this->commonService->makeCommonData()));
  }

}

