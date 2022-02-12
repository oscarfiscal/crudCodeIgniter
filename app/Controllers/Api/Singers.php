<?php

namespace App\Controllers\Api;

use App\Models\SingerModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;


class Singers extends ResourceController
{
    use ResponseTrait;

    public function index()
    { 
        $singerModel = new SingerModel();
        $data = $singerModel->orderBy('id', 'DESC')->findAll();
        return $this->respond($data);
      
     
    }
   
}
