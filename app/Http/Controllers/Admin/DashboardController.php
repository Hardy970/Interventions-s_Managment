<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Equipe;
use App\Models\Societe;
use App\Models\Demandeur;
use App\Models\Intervention;
use Illuminate\Http\Request;
use App\Charts\InterventionByType;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Charts\InterventionByConsultant;
use App\Charts\InterventionByEquipe;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function getInterventionsByConsultant()
     {
         // Récupérer les données avec une jointure sur la table pivot
         $interventionsParConsultant = DB::table('intervention_user')
             ->rightJoin('users', 'intervention_user.user_id', '=', 'users.id')
             ->select('users.id', DB::raw('CONCAT(users.first_name, " ", users.last_name) as full_name'), DB::raw('COUNT(intervention_user.intervention_id) as total_interventions'))
             ->groupBy('users.id', 'full_name')
             ->get();
     
         // Transformer les données en un tableau avec le nom complet comme clé
         $result = [];
         foreach ($interventionsParConsultant as $item) {
             $result[$item->full_name] = $item->total_interventions;
         }
         $interventionByConsultant=new InterventionByConsultant();
        $interventionByConsultant->labels(array_keys($result));
        $interventionByConsultant->dataset('interventions','bar',array_values($result));
        $interventionByConsultant->options([
            'tooltip' => [
                'show' => false,
            ],
            'yAxis'=>[
                'title' => [
                    'text' => null,
                ],
                'show'=>false,
                'labels'=>[
                    'enabled'=>false
                ],               
            ],
            'xAxis'=>[
                'show'=>false,
                'height'=>'50%'


            ],
            'plotOptions'=>[
                'bar'=>[
                    'pointWidth' => 10, 
                    'dataLabels'=>[
                        'enabled'=>true
                    ],
                ],
                ],
        ],true);
        $interventionByConsultant->displayLegend(false);
        $interventionByConsultant->title('Interventions par Consultant');
         return $interventionByConsultant;
     }


     function getInterventionsByTeam()
     {
         $interventionsParEquipe = DB::table('intervention_user')
             ->join('users', 'intervention_user.user_id', '=', 'users.id')
             ->rightJoin('equipes', 'users.equipe_id', '=', 'equipes.id')
             ->select(DB::raw('CONCAT(equipes.nom, "; ", COUNT(DISTINCT intervention_user.intervention_id)) as legende'), DB::raw('COUNT(DISTINCT intervention_user.intervention_id) as total_interventions'))
             ->groupBy('equipes.nom')
             ->get();
     
         // Transformer les résultats en un tableau associatif
         $result = [];
         foreach ($interventionsParEquipe as $item) {
             $result[$item->legende] = $item->total_interventions;
         }
         $interventionByEquipe=new InterventionByEquipe();
         $interventionByEquipe->labels(array_keys($result));
         $interventionByEquipe->dataset('interventions par équipe','doughnut',array_values($result))->backGroundColor([
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
          ]);  
         $interventionByEquipe->title('Intervention par Equipe');
         $interventionByEquipe->displayLegend(true);
         $interventionByEquipe->displayAxes(false);
         $interventionByEquipe->options([
            'responsive' => true,
            // 'maintainAspectRatio' => false, // Pour ajuster la hauteur du graphe
            // 'plugins' => [
            //     'legend' => [
            //         'position' => 'top',
            //     ],
            //     'tooltip' => [
            //         'enabled' => true,
            //     ],
            // ],
            // 'cutout' => '50%', // Pour ajuster la largeur des arcs
        ]);
         return $interventionByEquipe;
     }


    public function index()
    {
        

        $clientsExigeants = Demandeur::withCount('interventions')
        ->orderBy('interventions_count', 'desc')
        ->take(3)
        ->get();
        $nombreInterventions = Intervention::count();

        $nombreClientsTraites = Societe::count();

        $nombreConsultants = User::count();

        $nombreEquipes = Equipe::count();

        $interventionByConsultant= $this->getInterventionsByConsultant();
        $interventionByEquipe= $this->getInterventionsByTeam();
  
    return view('admin.dashboard', compact('interventionByEquipe','interventionByConsultant','nombreInterventions', 'nombreClientsTraites', 'nombreConsultants', 'nombreEquipes'));
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
