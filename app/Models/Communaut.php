<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Communaut extends Model
{
    use HasFactory , softDeletes;

    protected $primaryKey = 'idCo';

    protected $fillable = [
        'idCo',
        'NoCommunaut',
        'Village',
        'Totalpayment'
    ];


    public function villages()
    {
        return $this->hasMany(Village::class);
    }

  
}
