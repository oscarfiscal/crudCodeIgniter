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
     

      $rules =[
          'name'=>'required',
          'date'=>'required',
          'biography'=>'required',
            'image'=>'uploaded[image]|max_size[image,1024]|is_image[image]',
            'gender'=>'required',
      
      ];
       //save image 
      if(!$this->validate($rules)){
          return $this->fail($this->validator->getErrors());
      }else{


        $picture = $this->request->getFile('image');
        if(!$picture->isValid())
        
            return $this->fail($picture->getErrorString());
            $picture->move('./uploads/');
                
          $data= [
            'name'=>$this->request->getVar('name'),
            'date'=>$this->request->getVar('date'),
            'biography'=>$this->request->getVar('biography'),
            'image' => $picture->getName(),
            'gender'=>$this->request->getVar('gender'),
          ];
        $save = $this->singerModel->insert($data);
        $data['save']=$save;
          return $this->respondCreated($data);
      } 

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
    // delete singer
    public function delete($id = null){
        $singerModel = $this->singerModel;
        $data = $singerModel->where('id', $id)->first();
        if($data){
            $singerModel->delete($id);
            return $this->respond([
                'statusCode' => 200,
                'message'    => 'singer deleted',
            ], 200);
        }else{
            return $this->failNotFound('singer does not exist.');
        }
    }
       

    
    
}
