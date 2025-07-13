<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdherantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'NCIN' => 'required|string|min:6|max:50|',
            'Ncontrat' => 'required|integer|',
            'Nnom' => 'required|string|min:3|max:50',
            'Nprenom' => 'required|string|min:3|max:50',
            'Nadresse' => 'required|string|max:255',
            'Ntele' =>  ['required', 'regex:/^(06|07)[\d]{8}$/'],
            'Nmail' => 'required|email|max:255',
            'Ncomptr' => 'required|integer',
            // 'pvDemande' => 'required|mimes:png,jpg,jpeg|max:2048',
            // 'pvContrat' => 'required|mimes:png,jpg,jpeg|max:2048',
            // 'pvInstalation' => 'required|mimes:png,jpg,jpeg|max:2048',
            // 'CINpng' => 'required|mimes:png,jpg,jpeg|max:2048',
            'selectvillage' => 'required|not_in:0',
        ];
    }
    public function messages(){
    return [ 
    'NCIN.required' => 'Le champ CIN est obligatoire.',
    'NCIN.string' => 'Le champ CIN doit être une chaîne de caractères.',
    'NCIN.max' => 'Le champ CIN ne doit pas dépasser :max caractères.',
    'NCIN.min' => 'Le champ CIN  doit  dépasser 6 caractères.',
    //contrat
    'Ncontrat.required' => 'Le champ numero de contrat est obligatoire.',
    'Ncontrat.integer' => 'Le champ Numero de contrat doit être un entier.',
    'Ncontrat.unique' => 'Le champ Numero de contrat doit être unique dans la table des adhérents.',
    'Ncontrat.unique' => 'Adherent est deja existe.',
    //nom
    'Nnom.required' => 'Le champ nom est obligatoire.',
    'Nnom.string' => 'Le champ nom doit être une chaîne de caractères.',
    'Nnom.max' => 'Le champ nom ne doit pas dépasser :max caractères.',
    'Nnom.min' => 'Le champ nom ne doit pas dépasser :min caractères.',
    //prenom
    'Nprenom.required' => 'Le champ Prénom est obligatoire.',
    'Nprenom.string' => 'Le champ Prénom doit être une chaîne de caractères.',
    'Nprenom.max' => 'Le champ Prénom ne doit pas dépasser :max caractères.',
    'Nprenom.min' => 'Le champ Prénom ne doit pas dépasser :min caractères.',
    //adresse
    'Nadresse.required' => 'Le champ Adresse est obligatoire.',
    'Nadresse.string' => 'Le champ Adresse doit être une chaîne de caractères.',
    'Nadresse.max' => 'Le champ Adresse ne doit pas dépasser :max caractères.',
    //tele
    'Ntele.required' => 'Le champ Télé est obligatoire.',
    'Ntele.integer' => 'Le champ Télé doit être un entier.',
    // village
    'selectvillage.required' => "s'il vous plait selectionner un choix ",
    'selectvillage.not_in' => "s'il vous plait selectionner un choix ",
    //email
    'Nmail.required' => 'Le champ Email est obligatoire.',
    'Nmail.email' => 'Le champ Email doit être une adresse email valide.',
    'Nmail.max' => 'Le champ Email ne doit pas dépasser :max caractères.',
    //num de compteur
    'Ncomptr.required' => 'Le champ Numero de compteur est obligatoire.',
    'Ncomptr.integer' => 'Le champ Numero de compteur doit être un entier.',
    'pvDemande.required'=> "Le champ de téléchargement de la demande de PV est requis.",

'pvDemande.mimes'=> "Le champ de téléchargement de la demande de demande doit être un fichier de type PNG, JPG ou JPEG.",

'pvDemande.max'=> "Le champ de téléchargement de la demande de demande doit être d'une taille maximale de 2048 kilo-octets.",

'pvContrat.required'=>" Le champ de téléchargement du contrat  est requis.",

'pvContrat.mimes'=> "Le champ de téléchargement du contrat  doit être un fichier de type PNG, JPG ou JPEG.",

'pvContrat.max'=> "Le champ de téléchargement du contrat  doit être d'une taille maximale de 2048 kilo-octets.",

'pvInstallation.required'=> "Le champ de téléchargement de document l'installation  est requis.",

'pvInstallation.mimes' => "Le champ de téléchargement de document l'installation PV doit être un fichier de type PNG, JPG ou JPEG.",

'pvInstallation.max'=> "Le champ de téléchargement de document  l'installation PV doit être d'une taille maximale de 2048 kilo-octets.",

'CINpng.required'=>"Le champ de téléchargement du fichier CIN est requis.",

'CINpng.mimes'=> "Le champ de téléchargement du fichier CIN doit être un fichier de type PNG, JPG ou JPEG.",

'CINpng.max'=>"Le champ de téléchargement du fichier CIN doit être d'une taille maximale de 2048 kilo-octets.",

];
    }
}
