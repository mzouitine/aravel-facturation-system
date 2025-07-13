<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tranche;
use App\Models\Adherent;
use App\Models\Consomation;
use App\Models\Facture;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class GerantController extends Controller
{

    public function __construct(){
        $this->middleware('auth');        
        $this->middleware('gerant');
        


}
    
    public function index()
    {
        
        return view('gerant.index4');      
}

public function index1()
{
        $consulter= Adherent::All();
    return view('gerant.consulterFacture',compact('consulter')); 


}    

public function Tranche()
{
    $tranche = Tranche::all();
    return view('gerant.gererTranche',compact('tranche')); 
}

// public function getFacture($id)
// {
        
//         $facture = DB::table('factures')
//         ->select('N_fac','PrixFact','dateFacture','payer')
//         ->where('N_contrat',$id);
//          return $facture;
    
   
// }  
public function getTranche()
{
        
    $entries= Tranche::select([
       
        DB::raw('prix_tranche as prix_tranche') ,
       
    ])
   
    // ->whereYear('created_at', 2023)
    ->groupBy([
        'prix_tranche'
       
    ])
    ->orderBy('prix_tranche')
    ->get();
   

    $prix_tranche = [] ;

    foreach($entries as $entry){
        $prix_tranche[$entry->prix_tranche] = $entry->prix_tranche;
          
    }

   
    ksort($prix_tranche);
    
    return [
        
        'datasets' => [
            [
                'label' => 'prixTranche' ,
                'data'  =>   array_values($prix_tranche) 
            ]
        
           
        ],

    ];
   
}  

public function orderschart($id)
{
   
    $entries= Consomation::select([
        DB::raw('MONTH(created_at) as month') ,
        DB::raw('consomation_Total as consomation_Total') ,
        DB::raw('COUNT(*) as count') ,
    ])
    ->where('N_contrat',$id)
    ->whereYear('created_at', 2023)
    ->groupBy([
        'month',
        'consomation_Total'
    ])
    ->orderBy('month')
    ->get();
    
    $labels = [
        1=> 'Janvier', 'fevrier', 'mars', 'avril', 'mai', 'juin', 'juillet','aout','septembre','octobre','novembre','decembre'
    ];

    $consomation_Total=$count = [] ;

    foreach($entries as $entry){
        $consomation_Total[$entry->month] = $entry->consomation_Total;
        $count[$entry->month] = $entry->count;   
    }

    foreach($labels as $month => $name){

        if (!array_key_exists($month,$consomation_Total)){
            $consomation_Total[$month] = 0;
        }
        if (!array_key_exists($month,$count)){
            $count[$month] = 0;
        }
    }
    ksort($consomation_Total);
    ksort($count);
    return [
        'labels' =>array_values( $labels),
        'datasets' => [
            [
                'label' => 'consomation' ,
                'data'  =>   array_values($consomation_Total) 
            ]
         ,
         [
            'label' => 'count' ,
            'data'  =>   array_values($count)
         ]
           
        ],

    ];

   
}  

public function afficher($id){
    $listm= Facture::select('N_fac','PrixFact','dateFacture','payer')
    ->where('N_contrat',$id)
    
    ->orderBy('dateFacture')
    ->get();
    return $listm ;
 

}

    public function show($id)
    {
        // Fetch facture data based on $id from your database or API
        $factureData = Facture::find('N_fac',$id); // Example: assuming Facture is a model representing facture data
        return response()->json($factureData); // Return facture data as JSON
    }

public function ModifierTranche(Request $request)
{


    
    Tranche::where('id', 1 )->update([
            'prix_tranche' =>  $request->t1 ,]);
    Tranche::where('id', 2 )->update([
            'prix_tranche' =>  $request->t2  ,]);
    Tranche::where('id', 3 )->update([
            'prix_tranche' =>  $request->t3  ,]);
    Tranche::where('id', 4 )->update([
            'prix_tranche' =>  $request->t4  ,]);
    Tranche::where('id', 5 )->update([
            'prix_tranche' =>  $request->t5  ,]);
   
    return redirect('gererTranche')->with('message','Tranches Bien Modifier .');
    
}  

public function update_Profil(Request $req)
{
$ui=Auth::user()->id;
$up=User::find($ui);
$up->name=$req->no;
$up->Prenom=$req->pre;
$up->password = Hash::make($req->pswrd);
$up->save();
return redirect('profilGerant');

   
}






/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        $roles = Role::pluck('name','name')->all();
        return view('gerant.users',compact('data','roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function destroy(Request $request)
    {
        User::find($request->id)->delete();
        return redirect()->route('users.index')
            ->with('success','User deleted successfully');
    }
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('gerant.addusers',compact('roles'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'Prenom'=>'required',
            'roles' => 'required'
        ]);
// $name=$request->input('roles');
        $user = new User ;

        // $id_rol=DB::table('roles')->select('id')->where('name',$name);
               $user->name = $request->input('nom');
               $user->email = $request->input('email');
               $user->password = Hash::make($request->input('password'));
               $user->Prenom = $request->input('Prenom');
        $user->assignRole($request->input('roles'));
        $user->id_role = 3;

        $user->save();
        return redirect()->route('users.index')
            ->with('success','User created successfully');
    }


    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
        $user = User::find($request->id);
        if(!empty($request->password)){ 
          $user->password = Hash::make($request->password);
        }else{
            $user->password = $user->password;    
        }
    
        // User::where('id', $request->id)->update([
        //     'name' =>  $request->input('name'),]);
        // User::where('id', $request->id)->update([
        //     'Prenom' =>  $request->Prenom,]); 
        // User::where('id', $request->id)->update([
        //     'email' =>  $request->input('email'),]);

        $user->name = $request->input('name') ;
        $user->Prenom = $request->Prenom;
        $user->email = $request->input('email');

        DB::table('model_has_roles')->where('model_id',$request->id)->delete();
    
        $user->assignRole($request->roles);

        $user->save();
    
        return redirect()->route('users.index')
                        ->with('success','User modifie avec succes');
                
    }
}
