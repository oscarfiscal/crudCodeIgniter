<?php

namespace App\Controllers\Api;

use App\Models\SingerModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;




class Singers extends ResourceController
{

    protected $modelName = 'App\Models\SingerModel';
    protected $format = 'json';
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
    // update singer
    public function update($id = null){

            //model
            $singer = $this->singerModel;

            if ($this->request)
            {
                //get request 
                if($this->request->getJSON()) {
                
                    $json = $this->request->getJSON();
                    
                    $singer->update($json->id, [
                       
                        'name'=>$json->name,
                        'date'=>$json->date,
                        'biography'=>$json->biography,
                        'image'=>$json->image,
                        'gender'=>$json->gender,
                    ]);
    
                } else {
    
                    //update
                    $data = $this->request->getRawInput();
                    $singer->update($id, $data);
                }
    
                return $this->respond([
                    'statusCode' => 200,
                    'message'    => 'singer updated',
                ], 200);
            }
        
  
    
      
      
    }
       

    
    
}
