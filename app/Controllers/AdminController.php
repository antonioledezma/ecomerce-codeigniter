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

  public function edit($id){
    if(!$this->commonService->isAdmin()) {
      return redirect()->to('/session/login');
    }
    
    return redirect()->to('/admin/panel');
  }

  public function delete($id){
    if(!$this->commonService->isAdmin()) {
      return redirect()->to('/session/login');
    }
    
    return redirect()->to('/admin/panel');
  }
  
  public function create(){
    if(!$this->commonService->isAdmin()) {
      return redirect()->to('/session/login');
    }
    
    return redirect()->to('/admin/panel');
  }

}
