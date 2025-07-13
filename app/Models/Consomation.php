<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consomation extends Model
{
    use HasFactory  , softDeletes;

    protected $primaryKey = 'N_con';

    protected $fillable = [
        'N_con',
        'consomation_Total',
        'consomation_Tranch',
        'montant',
        'dateTour',
        'N_contrat'
    ];

    public function Adherents()
    {
        return $this->belongsTo(Adherent::class, 'N_contrat', 'N_Co');
    }

    public function factures()
    {
        return $this->hasOne(Facture::class, 'consomation', 'N_con');
    }
}