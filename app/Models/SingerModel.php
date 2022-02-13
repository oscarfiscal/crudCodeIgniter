<?php 
namespace App\Models;
use CodeIgniter\Model;


class SingerModel extends Model
{
    protected $table = 'singers';
    protected $primaryKey = 'id';
   
    protected $allowedFields = ['name', 'date', 'biography', 'image', 'gender'];


}
