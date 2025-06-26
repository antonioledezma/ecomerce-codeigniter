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

  public function cartPage(){
    if(!$this->commonService->isLogged()) {
      return redirect()->to('/session/login');
    }

    $cartItems = $this->cartModel->where('USER_ID', $this->commonService->getUserId())->findAll();
    $productList = [];
    foreach ($cartItems as &$item) {
      $product = $this->productModel->find($item['PRODUCT_ID']);
      $productList = array_merge($productList, $product);
    }

    $data = [
      'name' => 'cart',
      'cartItems' => $productList,
      'breadcrumbs-items' => [
        ['title' => 'Principal', 'url' => '/principal'],
        ['title' => 'Cart', 'url' => '/admin/cart'],
      ]
    ];
    
    return $this->mustache->render('page/admin/cart', array_merge($data, $this->commonService->makeCommonData()));
  }

  public function update($id){
    if(!$this->commonService->isAdmin()) {
      return redirect()->to('/session/login');
    }

    $name = $this->request->getPostGet('name');
    $price = $this->request->getPostGet('price');
    $amount = $this->request->getPostGet('amount');
    $file = $this->request->getFile('file');
    $fileName = null;

    if ($file && $file->isValid() && !$file->hasMoved()) {
      $newName = $file->getRandomName();
      $file->move(FCPATH . 'assets/img/product', $newName);
      // Puedes guardar el nombre del archivo en la base de datos si lo necesitas
      $fileName = $newName;
    }

    $product = $this->productModel->where([
      'ID' => $id,
    ])->first();
    
    if ($product) {
      $product['NAME'] = $name;
      $product['PRICE'] = $price;
      $product['AMOUNT'] = $amount;
      if ($fileName) {
        $product['SRC_IMG'] = $fileName;
      }

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
    $file = $this->request->getFile('file');
    $fileName = null;

    if ($file && $file->isValid() && !$file->hasMoved()) {
      $newName = $file->getRandomName();
      $file->move(FCPATH . 'assets/img/product', $newName);
      // Puedes guardar el nombre del archivo en la base de datos si lo necesitas
      $fileName = $newName;
    }

    $this->productModel->insert([
      'NAME' => $name,
      'PRICE' => $price,
      'AMOUNT' => $amount,
      'IS_NEW' => true,
      'SRC_IMG' => $fileName,
    ]);
    
    return redirect()->to('/admin/panel');
  }

  public function addToCart($id){
    if(!$this->commonService->isLogged()) {
      return redirect()->to('/session/login');
    }
    
    $userID = $this->commonService->getUserId();
    $quantity = $this->request->getPost('quantity');

    $product = $this->productModel->where(['ID' => $id])->first();
    if ($product) {
        $product['amount'] -= $quantity;
        $this->productModel->update($id, $product);
    }

    // carrito
    $cart = $this->cartModel->where([
      'USER_ID' => $userID,
      'PRODUCT_ID' => $id
    ])->first();

    if ($cart) {
      $cart['AMOUNT'] += $quantity;
      $this->cartModel->update($cart['ID'], $cart);
    }
    else {
      $this->cartModel->insert([
        'USER_ID' => $userID,
        'PRODUCT_ID' => $id,
        'AMOUNT' => $quantity
      ]);
    }
    
    return redirect()->to('/product/' . $id);
  }

}
