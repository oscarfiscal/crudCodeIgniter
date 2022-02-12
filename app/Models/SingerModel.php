<?php 
namespace App\Models;
use CodeIgniter\Model;


class SingerModel extends Model
{
    protected $table = 'singers';
    protected $primaryKey = 'id';

  
    protected $allowedFields = ['name', 'date', 'bibliography', 'image', 'gender'];

    protected $validate = [
        'name'=>'required',
        'date'=>'required',
        'bibliography'=>'required',
        'image'=>'required',
        'gender'=>'required',

    ];
    
    protected $skipValidation = false;
}
