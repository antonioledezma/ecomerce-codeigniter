<?php

namespace App\Service;

use App\Models\UserModel;
use App\Models\ProductModel;
use CodeIgniter\Config\Services;

class CommonService extends Services{

  private $userModel;
  private $productModel;

  public function __construct() {
    $this->userModel = new UserModel();
    $this->productModel = new ProductModel();
  }

  public function isAdmin() : bool {
    $user = session()->get("USER");
    return isset($user) && isset($user["ROLE"]) && $user["ROLE"] == "ADMIN";
  }

  public function isLogged() : bool {
    $user = session()->get("USER");
    return isset($user);
  }

  public function makeCommonData() : array {
    $user = session()->get("USER");
    
    return [
      'isLoggedIn' => isset($user),
      'isAdmin' => isset($user) && isset($user["ROLE"]) ? $user["ROLE"] == "ADMIN" : false,
      'isUser' => isset($user) && isset($user["ROLE"]) ? $user["ROLE"] == "USER" : false,
      'username' => isset($user) && isset($user["USERNAME"])  ? $user["USERNAME"] : "",
      'email' => isset($user) && isset($user["EMAIL"])  ? $user["EMAIL"] : ""
    ];
  }

  public function getUserId() : int {
    $user = session()->get("USER");
    if(isset($user) && isset($user["ID"])){
      return $user["ID"];
    }
    return 0;
  }

  public function getProductList($id, $name, $price) {
    /* Para filtros de busqueda. */
    $productoList = null;

    if($name){
       $productoList = [$this->productModel->where('name', $name)->first()];
    } elseif($id){
       $productoList = [$this->productModel->find($id)];
    }elseif($price){
       $productoList = $this->productModel->where('price', $price)->findAll();
    } else {
       $productoList = $this->productModel->findAll();
    }

    if($productoList == null) {
      $productoList = [];
    }

    return $productoList;
  }
  
}
