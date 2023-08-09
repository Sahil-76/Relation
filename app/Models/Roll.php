<?php

namespace App\Models;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Roll extends Model
{
    use HasFactory;
    public function users()
    {
      return $this->belongsToMany(User::class);
    }
    public function permissions()
    {
      return $this->belongsToMany(Permission::class);
    }
 

}
