<?php

namespace App\Models;

use App\Models\Roll;
use App\Models\Module;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;

    public function rolls()
    {
      return $this->belongsToMany(Roll::class);
    }

    public function module()
    {
      return $this->belongsTo(Module::class);
    }
}

