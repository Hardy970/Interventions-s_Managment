<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Equipe;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ConsultantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.consultant.index',['consultants'=>User::all()->except(Auth::user()->id),'consultant'=>new User(),'equipes'=>Equipe::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.consultant.form',['equipes'=>Equipe::all(),'consultant'=>new User(),'roles'=>Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'role_id'=>['required','exists:roles,id'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
            'equipe_id'=>['required']
        ],$this->messages());

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role_id'=> $request->role_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'equipe_id'=>$request->equipe_id,
        ]);
        return redirect()->route('admin.consultant.index')->with('success','Consultant ajouté avec succès');
    }
    public function messages(): array
    {
        return [
            'first_name.required' => 'Ce champ est requis.',
            'last_name.required' => 'Ce champ est requis.',
            'email.required' => 'Ce champ est requis.',
            'email.email' => 'Entrez une adresse email valide',
            'first_name.string' => 'Ce champ doit être une chaîne de caractères.',
            'equipe_id.required' => 'Veuillez choisir une équipe',
            'role_id.required' => 'Veuillez choisir un rôle',
            'role_id.exists' => 'Ce rôle n\'existe pas',
            'password.required' => 'Ce champ est requis',
            'email.unique' => 'Cette adresse email est déjà utilisé par un autre utilisateur',
            'password.min'=>'Le mot de passe doit contenir au moins 8 caractères'
        ];
    }

    /**
     * Display the specified resource.
     */
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $consultant)
    {
        return view('admin.consultant.form',['equipes'=>Equipe::all(),'consultant'=>$consultant,'roles'=>Role::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $consultant)
    {
        $request->validate([
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string'],
            'role_id'=>['required','exists:roles,id'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($consultant->id)],
            'equipe_id'=>['required','exists:equipes,id'],
        ],$this->messages());
        $consultant->update($request->all());
        return redirect()->route('admin.consultant.index')->with('success','Consultant mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $consultant)
    {
        $consultant->delete();
        return redirect()->route('admin.consultant.index')->with('success','Consultant supprimé avec succès');
    }
    public function block(User $consultant)
    {
        $consultant->update(['actived'=>false]);
        return redirect()->route('admin.consultant.index')->with('success','Consultant bloqué avec succès');
    }
    public function unblock(User $consultant)
    {
        $consultant->update(['actived'=>true]);
        return redirect()->route('admin.consultant.index')->with('success','Consultant débloqué avec succès');
    }
}
