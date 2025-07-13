<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\AdherantRequest;
use App\Models\Village;
use App\Models\User;
use App\Models\Adherent;
use App\Models\Consomation;

use Illuminate\Support\Facades\DB;

class GestionAdherentController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
       
    
        $this->middleware('responsable');
    }
    

    public function index()
    {
        $villages= Village::all();
   
        return view('responsable.AjouterAdherent',compact('villages'));
}
public function index2(Request $request)
    {
        $villages= Village::all();
        $value = $request->selectvillage ;
        $list = Adherent::where('idVillage',$value)->get() ;
        return view('responsable.modifierAdherant',compact('villages','list'));
}  



public function getadherant()
{

    
   $data = Adherent::All();
    $villages= Village::All();
    return view('responsable.modifierAdherant',compact('data','villages'));

}


// ********  Profil  *****************




    //fonction ajouter adherant 

    public function add_adherent(AdherantRequest $request )
    {
        $adherent = New Adherent();
        $adherent->CIN =$request->NCIN;
        $adherent->Nom = $request->Nnom;
        $adherent->Prenom  =  $request->Nprenom;
        $adherent->Adresse = $request->Nadresse;
        $adherent->Email = $request->Nmail;
        $adherent->Tele = $request->Ntele;
        $adherent->id = $request->Ncontrat;
        $adherent->Ncompteur = $request->Ncomptr;
        $adherent->idVillage = $request->selectvillage;
        $adherent->drConsommation = 0 ;

        if ($request->hasFile('NpvDemande')) {
            $demande = $request->file('NpvDemande');
            $pathDemande = $demande->storeAs('public/archives/' . $request->Ncontrat, 'demande.' . $demande->extension());
            $adherent->pvDemande = "/storage/".$pathDemande;
     
        }
        if ($request->hasFile('NpvContrat')) {
            $contrat = $request->file('NpvContrat');
            $pathcontrat = $contrat->storeAs('public/archives/' .$request->Ncontrat, 'contrat.' . $contrat->extension());
            $adherent->pvContrat = "/storage/".$pathcontrat;
        }  
     
        if ($request->hasFile('NpvInstalation')) {
            $pv = $request->file('NpvInstalation');
            $pathInstallation = $pv->storeAs('public/archives/' . $request->Ncontrat, 'pv_installation.' . $pv->extension());
            $adherent->pvInstalation = "/storage/".$pathInstallation;
            
        }
        if ($request->hasFile('NCINpng')) {
            $cin =$request->file('NCINpng');
            $pathCIN =$cin->storeAs('public/archives/' . $request->Ncontrat, 'cin.' . $cin->extension());
            $adherent->CINpng = "/storage/".$pathCIN;
        }
        $adherent->save();

   


        return redirect('ajouterAdherent')->with('message','Adherent Bien Ajouté .');



      
        
    }

    
    public function update_adherant(Request $req){
        $ch =Adherent::find($req->id);
        $ch->CIN=$req->NCIN;
        $ch->Nom=$req->Nnom;
        $ch->Prenom=$req->Nprenom;
        $ch->Tele=$req->Ntele;
        $ch->idVillage=$req->selectvillage;
        $ch->Ncompteur=$req->Ncomptr;
        $ch->Email	=$req->Nmail;
        $ch->idVillage=$req->selectvillage;

        $ch->save();
        return redirect('modifierAdherant')->with('success','Adherent bien modifié .');
    }

// fonction supprimer adherant
    public function delete_adherant(Request $req){
        $ch = Adherent::find($req->id);
        $ch->delete();
        return redirect('modifierAdherant');
        
    }

   


// fonction profil responsable

public function update_profilResp(Request $req)
{
$ui=Auth::user()->id;
$up=User::find($ui);
$up->name=$req->no;
$up->Prenom=$req->pre;
$up->password = Hash::make($req->pswrd);


$up->save();
return redirect('ProfilResp');

   
}



}