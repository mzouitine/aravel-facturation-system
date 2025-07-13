<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory  , softDeletes;
    protected $fillable = [
        'N_Payment',
        'date_payment',
        'N_facture'
    ];

    public $timestamps = false;

    public function factures()
    {
        return $this->hasMany(Facture::class);
    }
}