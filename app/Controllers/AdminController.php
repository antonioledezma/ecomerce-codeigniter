<?php
namespace App\Controllers;

class AdminController extends BaseController {
  
  public function panel(){
    if(!$this->commonService->isAdmin()) {
      return redirect()->to('/session/login');
    }

    $data = [
      'name' => 'admin-panel',
      'productList' => $this->commonService->getProductList(null, null),
      'breadcrumbs-items' => [
        ['title' => 'Principal', 'url' => '/principal'],
        ['title' => 'Login', 'url' => '/admin/panel'],
      ]
    ];
    
    return $this->mustache->render('page/admin/panel', array_merge($data, $this->commonService->makeCommonData()));
  }

  public function update($id){
    if(!$this->commonService->isAdmin()) {
      return redirect()->to('/session/login');
    }

    $name = $this->request->getPostGet('name');
    $price = $this->request->getPostGet('price');
    $amount = $this->request->getPostGet('amount');

    $product = $this->productModel->where([
      'ID' => $id,
    ])->first();
    
    if ($product) {
      $product['NAME'] = $name;
      $product['PRICE'] = $price;
      $product['AMOUNT'] = $amount;

      $this->productModel->update($id, $product);
    } else {
      // Handle the case where the product does not exist
      return redirect()->to('/admin/panel')->with('error', 'Product not found.');
    }
    
    return redirect()->to('/admin/panel');
  }

  public function delete($id){
    if(!$this->commonService->isAdmin()) {
      return redirect()->to('/session/login');
    }

    $product = $this->productModel->delete($id);
    
    return redirect()->to('/admin/panel');
  }
  
  public function create(){
    if(!$this->commonService->isAdmin()) {
      return redirect()->to('/session/login');
    }

    $name = $this->request->getPost('name');
    $price = $this->request->getPost('price');
    $amount = $this->request->getPost('amount');

    $this->productModel->insert([
      'NAME' => $name,
      'PRICE' => $price,
      'AMOUNT' => $amount,
      'IS_NEW' => true
    ]);
    
    return redirect()->to('/admin/panel');
  }

}
