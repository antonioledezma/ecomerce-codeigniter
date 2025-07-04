<?php
namespace App\Controllers;

class AdminController extends BaseController {
  
  public function panel(){
    if(!$this->commonService->isAdmin()) {
      return redirect()->to('/session/login');
    }

    $consutaList = $this->consultaModel->findAll();

    $userList = $this->userModel->findAll();
    foreach ($userList as $key => &$user) {
      $cartItems = $this->cartModel->where(['USER_ID' => $user['ID'], 'STATUS' => 'COMPLETED'])->findAll();
      $subTotal = 0;
      foreach ($cartItems as &$item) {
        $product = $this->productModel->where(['ID' => $item['PRODUCT_ID']])->first();
        if($product) {
          $item['product'] = $product;
          $item['subtotal'] = $item['AMOUNT'] * $product['price'];
          $subTotal += $item['subtotal'];
        }
      }
      if (empty($cartItems)) {
        unset($userList[$key]);
        continue;
      }
      $user['subtotal'] = $subTotal;
      $user['cartItems'] = $cartItems;
    }
    $userList = array_values($userList);
  
    $data = [
      'name' => 'admin-panel',
      'productList' => $this->commonService->getProductList(null, null, null),
      'consultaList' => $consutaList,
      'facturaList' => $userList,
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

    $cartItems = $this->cartModel->where(['USER_ID' => $this->commonService->getUserId(), 'STATUS' => 'ACTIVE'])->findAll();
    $subTotal = 0;
    foreach ($cartItems as &$item) {
      $product = $this->productModel->where(['ID' => $item['PRODUCT_ID']])->first();
      if($product) {
        $item['product'] = $product;
        $item['subtotal'] = $item['AMOUNT'] * $product['price'];
        $subTotal += $item['subtotal'];
      }
    }

    $data = [
      'name' => 'cart',
      'cartItems' => $cartItems,
      'subTotal' => $subTotal,
      'breadcrumbs-items' => [
        ['title' => 'Principal', 'url' => '/principal'],
        ['title' => 'Cart', 'url' => '/admin/cart'],
      ]
    ];
    //return json_encode(value: $cartItems);
    return $this->mustache->render('page/admin/cart', array_merge($data, $this->commonService->makeCommonData()));
  }

  public function update($id){
    if(!$this->commonService->isAdmin()) {
      return redirect()->to('/session/login');
    }

    $name = $this->request->getPostGet('name');
    $price = $this->request->getPostGet('price');
    $amount = $this->request->getPostGet('amount');
    $description = $this->request->getPostGet('description');
    $is_new = $this->request->getPostGet('is_new');

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
      $product['DESCRIPTION'] = $description;
      $product['IS_NEW'] = $is_new ? 1 : 0;
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
    $description = $this->request->getPostGet('description');
    $is_new = $this->request->getPostGet('is_new');
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
      'SRC_IMG' => $fileName,
      'DESCRIPTION' => $description,
      'IS_NEW' => $is_new ? 1 : 0
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
      'PRODUCT_ID' => $id,
      'status' => 'ACTIVE'
    ])->first();

    if ($cart) {
      $cart['AMOUNT'] += $quantity;
      $this->cartModel->update($cart['ID'], $cart);
    }
    else {
      $this->cartModel->insert([
        'USER_ID' => $userID,
        'PRODUCT_ID' => $id,
        'AMOUNT' => $quantity,
        'status' => 'ACTIVE'
      ]);
    }
    
    return redirect()->to('/product/' . $id);
  }

  public function cartRemove($id){
    if(!$this->commonService->isLogged()) {
      return redirect()->to('/session/login');
    }

    $this->cartModel->delete($id);
    
    return redirect()->to('/admin/cart');
  }

  public function cartBuy(){
    if(!$this->commonService->isLogged()) {
      return redirect()->to('/session/login');
    }
    
    $userID = $this->commonService->getUserId();

    // carrito
    $cartList = $this->cartModel->where([
      'USER_ID' => $userID,
      'status' => 'ACTIVE'
    ])->findAll();

    foreach ($cartList as $cartItem) {
      // Actualizar el estado del carrito a 'COMPLETED'
      $this->cartModel->update($cartItem['ID'], ['status' => 'COMPLETED']);
    }

    return redirect()->to('/');
  }

}
