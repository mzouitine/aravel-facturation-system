<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;


use Closure;
use Illuminate\Http\Request;

class role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    
    public function handle(Request $request, Closure $next)
    {
      
        $user = Auth::user();
        if ($user && $user->id_role == 1) {
            return redirect()->route('index1');
        }    
        if (!$user ) {
            return redirect('/login');
        }    
       
     
        if ($user && $user->id_role == 2) {
            return redirect()->route('indextc');
        }

        if ($user && $user->id_role == 3) {
            return redirect('/ajouterAdherent');
        }
        else {
            return  redirect('/404');}
            
        
    
    }
}
