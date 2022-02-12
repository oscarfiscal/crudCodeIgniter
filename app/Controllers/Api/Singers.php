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
    public function create() {
        $singerModel =  new SingerModel();
        $data = [
            'name' => $this->request->getVar('nombre'),
           'date' => $this->request->getVar('fechanacimiento'),
              'biography' => $this->request->getVar('biografia'),
                'image' => $this->request->getVar('imagen'),
                'gender' => $this->request->getVar('genero'),
        ];
        $singerModel->insert($data);
        $response = [
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => 'Singer created'
          ]
      ];
      return $this->respondCreated($response);
    }
   
}
