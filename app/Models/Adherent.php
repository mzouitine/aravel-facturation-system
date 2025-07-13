<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Adherent extends Model
{
    use HasFactory , softDeletes;

    protected $primaryKey = 'id';

    protected $fillable = [
        'CIN',
        'id',
        'drConsommation',
        'Nom',
        'Prenom',
        'Adresse',
        'Tele',
        'credit',
        'Email',
        'Ncompteur',
        'pvDemande',
        'pvContrat',
        'pvInstalation',
        'CINpng',
        'idVillage'
        
    ];

    public function consomations()
    {
        return $this->hasMany(Consomation::class, 'id','N_contrat' );
    }

    public function factures()
    {
        return $this->hasMany(Facture::class,'id' ,'N_contrat' );
    }
    public function village()
    {
        return $this->hasOne(Village::class,'id','idVillage');
    }
}
