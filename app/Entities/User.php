<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;

class User extends Entity {
  
  protected $id;
  protected $username;
  protected $password;
  protected $email;
  protected $role;

  protected $datamap = [];
  protected $casts = [];

}
