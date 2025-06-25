<?php

namespace App\Service;

use App\Models\UserModel;
use App\Models\ProductoModel;
use CodeIgniter\Config\Services;

class CommonService extends Services{

  private $userModel;
  private $productoModel;

  public function __construct() {
    $this->userModel = new UserModel();
    $this->productoModel = new ProductoModel();
  }

  public function isAdmin() : bool {
    $user = session()->get("USER");
    return isset($user) && isset($user["ROLE"]) && $user["ROLE"] == "ADMIN";
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

  public function getProductList($id, $name) {
    /* Para filtros de busqueda. */
    $productoList = [];

    if($name){
       $productoList = [$this->productoModel->where('name', $name)->first()];
    } elseif($id){
       $productoList = [$this->productoModel->find($id)];
    } else {
       $productoList = $this->productoModel->findAll();
    }

    return $productoList;
  }
  
}
