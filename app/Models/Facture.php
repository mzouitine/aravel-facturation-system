<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facture extends Model
{
    use HasFactory  , softDeletes;

    protected $primaryKey = 'N_fac';

    protected $fillable = [
        'N_fac',
        'PrixFact',
        'dateFacture',
        'consomation',
        'N_contrat',
        'village' ,
        'payer'
    ];
   
    public function Adherent()
    {
        return $this->hasOne(Adherent::class, 'id','N_contrat');
    }
    public function payment()
    {
        return $this->hasOne(Payment::class, 'N_Facture', 'N_fac');
    }
 
}