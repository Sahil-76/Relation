<?php

namespace App\Models;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;


    public function permissions()
    {
      return $this->hasMany(Permission::class);

      /* TODO:- a model class and 
      defines a one to many relationship between 
      the current model and the permissions model*/
    }
}
