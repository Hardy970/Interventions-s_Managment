<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Equipe;
use App\Models\Societe;
use App\Charts\SampleChart;
use App\Models\Intervention;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\Charts;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nombreInterventions = Intervention::count();
    $nombreClientsTraites = Societe::count();
    $nombreConsultants = User::count();
    $nombreEquipes = Equipe::count();

    return view('admin.dashboard', compact('nombreInterventions', 'nombreClientsTraites', 'nombreConsultants', 'nombreEquipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
