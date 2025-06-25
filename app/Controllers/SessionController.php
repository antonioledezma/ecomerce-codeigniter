<?php
namespace App\Controllers;

class SessionController extends BaseController {

  public function login() {
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    // Buscar el usuario por email y otra condición (por ejemplo, activo)
    $user = $this->userModel->where([
      'EMAIL' => $email,
    ])->first();
      

    if (isset($user) && password_verify($password, $user["PASSWORD"])) {
      session()->set('USER', $user);
      return redirect()->to('/principal');
    } else {
      return redirect()->to('/session/login');
    }
  }

  public function logout() {
    session()->set('USER', null);
    return redirect()->to('/principal');
  }

  public function register(){
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');
    $email = $this->request->getPost('email');
    $user = [
      'USERNAME' => $username,
      'PASSWORD' => password_hash($password, PASSWORD_BCRYPT),
      'EMAIL'    => $email,
      'ROLE'     => 'USER'
    ];

    $this->userModel->save($user);
    session()->set('USER', $user);

    return redirect()->to('/principal');
  }

  
  public function loginPage(){
    $data = [
      'name' => 'login',
      'breadcrumbs-items' => [
        ['title' => 'Principal', 'url' => '/principal'],
        ['title' => 'Login', 'url' => '/session/login'],
      ]
    ];
    return $this->mustache->render('page/session/login', array_merge($data, $this->commonService->makeCommonData()));
  }

  public function registerPage(){
    $data = [
      'name' => 'register',
      'breadcrumbs-items' => [
        ['title' => 'Principal', 'url' => '/principal'],
        ['title' => 'Register', 'url' => '/session/register'],
      ]
    ];
    return $this->mustache->render('page/session/register', array_merge($data, $this->commonService->makeCommonData()));
  }

}
