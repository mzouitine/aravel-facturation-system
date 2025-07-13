<?php

namespace App\Http\Controllers;
use App\Models\Village;
use App\Models\Adherent;
use App\Models\Consomation;
use App\Models\Facture;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class PayerFactureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware(['role:responsable']);
    
        $this->middleware('responsable');
    }
    public function index(){
        $villages = Village::all();
        $dateF= Facture::all();
        return view('index2',compact('villages','dateF'));

    }
    public function index1()
{
        $consulter= Adherent::All();
    return view('responsable.consulterfacturead',compact('consulter')); 


}  
    public function index2(){
        $villages = Village::all();
        $dateF= Facture::all();
        return view('responsable.payerFacture',compact('villages','dateF'));


        
    }
  
    public function rechercherdatefacture(Request $request){
       
      
       
        

        if ($request->has('Recherchef')){
            $Ncntr = $request->input('nctr');
            $contrat = $request->input('Ncontrat');
            $selectvlg = $request->input('selectvillage');
            
        //$adherant = Adherent::where('id',$contrat)->where('idVillage',$select)->get();
       
        $datefacture=DB::table('factures')->select('dateFacture')
        ->where('N_contrat',$contrat)
        ->where('village',$selectvlg)->where('payer','non payer')->get();    

        $villages= Village::all();

        session()->put('contrat_search_value', $request->input('Ncontrat'));
       // session()->put('village_search_value', $request->input('selectvillage'));

     //return redirect('payerFacture' )->with(['Ncontrat'=> $contrat ,'villages'=>$villages,'datefacture'=>$datefacture ]);
       return view('responsable.payerFacture',compact('villages','datefacture'));

        
        }
   
   
        if ($request->has('RecherchedateF')){

            $selectvlg = $request->input('selectvillage');
            $selectDATEfact = $request->input('selectdateF');
            $contrat = $request->input('Ncontrat');
            

            $adherant = DB::table('factures as f')
            ->join('adherents as a', 'f.N_contrat', '=', 'a.id')
            ->select('f.*', 'a.*')
            ->where('f.N_contrat', $contrat)
            ->where('f.dateFacture', $selectDATEfact)
            ->get();
            $villages= Village::all();

            return view('responsable.payerFacture',compact('villages','adherant'));

        }
      
        if ($request->has('py')){
            $contrat = $request->input('Ncontrat');
            $datefc = $request->input('dtf');
            
            Facture::where('N_contrat', $contrat )->where('dateFacture',$datefc)->update([
                'payer' =>  'payer',]);
            //$idvlg=Facture::select('N_facture')->where('Village',$vlge)->get();
            $payment = New Payment();
            $payment->datepayement= $request->date;
            $payment->N_facture  =$request->nfctr;
            
            $payment->save();
           
    
        return redirect('payerFacture')->with('message','facture bien payer .');

    
            
                     }
    }

    // fonction profil responsable py


    
}
