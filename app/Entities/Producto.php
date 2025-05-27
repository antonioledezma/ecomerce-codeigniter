<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Producto extends Entity
{
  protected $id;
  protected $name;
  protected $description;
  protected $price;
  protected $amount;
  protected $srcImg;
  protected $isNew;

  protected $datamap = [
    'srcImg' => 'src_img',
    'isNew' => 'IS_NEW',
  ];

  protected $casts = [
    'price' => 'float',
    'amount' => 'int',
  ];
}
