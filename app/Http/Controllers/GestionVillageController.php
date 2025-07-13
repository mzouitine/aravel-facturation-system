<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Village;

class GestionVillageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
      
        $this->middleware('responsable');
    }

    public function all()
    {
        $villages= Village::all();
        return view('responsable.ajouterVillage',compact("villages"));
} 


    //fonction ajouter village
    public function add_Village(Request $req )
    {
        
        $ch=new Village();
        $ch->Village=$req->nomvillage;
        $ch->idComun=1;
        $ch->save();
        return redirect('ajouterVillage')->with('message','village ajouté avec succée');
    }

    // fonction modifier village 

    public function update_Village(Request $req){
        $ch = Village::find($req->idm);
        $ch->Village=$req->nomvillage;
        
        $ch->save();
        return redirect('ajouterVillage');
    }

// fonction supprimer village
    public function delete_Village(Request $req){
        $ch = Village::find($req->id);
        $ch->delete();
        return redirect('ajouterVillage');
        
    }

}
