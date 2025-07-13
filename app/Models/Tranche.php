<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tranche extends Model
{
    use HasFactory  , softDeletes;

    protected $primaryKey = 'id';
    protected $fillable = [
       
        'num_Tranche ',
        'prix_tranche	',
    ];
    public function consomation()
    {
        return $this->hasOne(Consomation::class,);
    }
}
