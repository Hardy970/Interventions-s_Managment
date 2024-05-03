<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Equipe;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ConsultantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.consultant.index',['consultants'=>User::all(),'consultant'=>new User(),'equipes'=>Equipe::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.consultant.form',['equipes'=>Equipe::all(),'consultant'=>new User()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
            'equipe_id'=>['required']
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'equipe_id'=>$request->equipe_id,
        ]);
        return redirect()->route('admin.consultant.index')->with('success','Consultant ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $consultant)
    {
        return view('admin.consultant.form',['equipes'=>Equipe::all(),'consultant'=>$consultant]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $consultant)
    {
        $request->validate([
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($consultant->id)],
            'equipe_id'=>['required','exists:equipes,id'],
        ]);
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
}
