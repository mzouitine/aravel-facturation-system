<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Village;
use App\Models\Adherent;
use App\Models\Consomation;
use App\Models\Facture;
use App\Models\Tranche;
use Illuminate\Support\Facades\DB;






class DeposerConsommationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware(['role:Technicien']);
       
        $this->middleware('technicien');
    }



    
    public function rechercherAdh(Request $request){
        
       

        if ($request->has('Recherche')){
        $select = $request->input('selectvillage');
        $compteur = $request->input('Ncompteur');
        $adherant = Adherent::where('Ncompteur',$compteur)->where('idVillage',$select)->get();
        $vlg=Village::where('id',$select)->get();
        $villages= Village::all();
        return view('technicien.deposerConsommation',compact('adherant','villages'));  

                 }
                 
                 if ($request->has('disposer')){
                    $vlge = $request->input('village');
                  
                    $drCnsomation = $request->input('drcns');
                    $newConsomation= $request->input('newConsomation');
                    $contrat = $request->input('nctr');
                    $drcons=($newConsomation-$drCnsomation);
                    //value prix des tranches
                    $t1 = Tranche::select('prix_tranche')->where('num_Tranche', 1)->value('prix_tranche');
                    $t2 = Tranche::select('prix_tranche')->where('num_Tranche', 2)->value('prix_tranche');
                    $t3 = Tranche::select('prix_tranche')->where('num_Tranche', 3)->value('prix_tranche');
                    $t4 = Tranche::select('prix_tranche')->where('num_Tranche', 4)->value('prix_tranche');
                    $t5 = Tranche::select('prix_tranche')->where('num_Tranche', 5)->value('prix_tranche');
                   Adherent::where('id', $contrat )->update([
                    'drConsommation' =>  $newConsomation  ,
                    
                ]);
               
                   //ADD CONSOMMATION 
                    $consomation = New Consomation();
                    
                    $consomation->consomation_Total = $drcons;
                    $consomation->N_contrat  = $request->nctr;
                    $consomation->dateTour  = $request->date;

                    // ADD FACTURE
                    $facture = New Facture();
                    $facture->N_contrat  = $request->nctr;
                    $facture->dateFacture  = $request->date;
                    $facture->consomation  =$drcons;
                    $facture->village  =$vlge;
                    
                    

                     if ($drcons <= 1000) {
                        $consomation->consomation_Tranch  = 1;
                        $consomation->montant  =$drcons*$t1 ;
                        //FACTURE
                        $facture->PrixFact  = $drcons*$t1;
                    } elseif ($drcons <= 4000) {
                        $consomation->consomation_Tranch  = 2;
                        $consomation->montant  =$drcons*$t2 ;
                        //FACTURE
                        $facture->PrixFact  = $drcons*$t2;
                    } elseif ($drcons <= 8000) {
                        $consomation->consomation_Tranch  = 3;
                        $consomation->montant  =$drcons*$t3 ;
                        //FACTURE
                        $facture->PrixFact  = $drcons*$t3;
                    }elseif ($drcons <= 10000) {
                        $consomation->consomation_Tranch  = 4;
                        $consomation->montant  =$drcons*$t4 ;
                        //FACTURE
                       $facture->PrixFact  = $drcons*$t4;
                            
                    }else {
                        $consomation->consomation_Tranch  = 5;
                        $consomation->montant  =$drcons*$t5 ;
                        //FACTURE
                        $facture->PrixFact  = $drcons*$t5;}

                    $facture->save();

                    $consomation->save();
                   
            
                return redirect('deposerConsommation')->with('message','Consomation bien ajouté .');

            
                    
                             }
        }

public function indextc(){
    $villages = Village::all();
    return view('technicien.deposerConsommation',compact('villages'));
}
public function index4(){
    
    return view('technicien.modifierCompteur');
}

public function index(Request $request){
    $select = $request->input('selectvillage');
        $compteur = $request->input('Ncompteur');
        $adherant = Adherent::where('Ncompteur',$compteur)->where('idVillage',$select)->get();
        $vlg=Village::where('id',$select)->get();
        $villages= Village::all();
    $dateF= Facture::all();
    return view('technicien.modifierCompteur',compact('adherant','villages','dateF'));  
    
}
public function index01(){
  
        $villages= Village::all();
    $dateF= Facture::all();
    return view('technicien.modifierCompteur',compact('villages','dateF'));  
    
}


public function update_ProfilTec(Request $req)
{
$ui=Auth::user()->id;
$up=User::find($ui);
$up->name=$req->no;
$up->Prenom=$req->pre;
$up->password = Hash::make($req->pswrd);


$up->save();
return redirect('ProfilTec');

   
}

public function updateCmptr(Request $Req){
    
    Consomation::where('Ncompteur ', $Req->input('Ncompteur') )->update([
        'drConsommation' =>  $request->newConsomation ,]);
    
    Consomation::where('Ncompteur ', $Req->input('Ncompteur') )->update([
        'drConsommation' =>  $request->newConsomation ,]);

}

}


