<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Village extends Model
{
    use HasFactory  , softDeletes;

    public function commune()
    {
        return $this->hasOne(Communaut::class);
    }
    public function Adherants()
    {
        return $this->hasMany(Adherent::class);
    }
}
