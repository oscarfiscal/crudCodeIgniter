<?php

namespace App\Controllers\Api;

use App\Models\SingerModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;


class Singers extends ResourceController
{
    use ResponseTrait;

   /*  get */
    public function index()
    { 
        $singerModel = new SingerModel();
        $singers = $singerModel->findAll();
        return $this->respond($singers);
      
     
    }
    public function create() {
        $singerModel =  new SingerModel();
        $singerModel->save([
            'name'=>$this->request->getVar('nombre'),
            'date'=>$this->request->getVar('fechanacimiento'),
            'biography'=>$this->request->getVar('biografia'),
            'image'=>$this->request->getVar('imagen'),
            'gender'=>$this->request->getVar('genero'),
        ]);
     
      
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
