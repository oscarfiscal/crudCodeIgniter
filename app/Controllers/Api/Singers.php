<?php

namespace App\Controllers\Api;

use App\Models\SingerModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;




class Singers extends ResourceController
{
    use ResponseTrait;
    public function __construct()
{
    $this->singerModel =new SingerModel();
}

   /*  get */
    public function index()
    { 
         $singers = $this->singerModel->findAll();
        return $this->respond($singers); 
    }
    // created singer 
    public function create() {
        $singerModel =  $this->singerModel;
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
              'success' => 'Singer created',
          ]

      ];
      return $this->respondCreated($response);
    }
    // get singer by id
    public function show($id = null){
        $singerModel = $this->singerModel;
        $data = $singerModel->where('id', $id)->first();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('singer does not exist.');
        }
    }
}
