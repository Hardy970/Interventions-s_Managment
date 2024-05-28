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
use App\Charts\VehiculeByIntervention;

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
             ->orderBy('total_interventions','desc')
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
            'responsive' => true,
            'maintainAspectRatio' => false,
            'tooltip' => [
                'show' => true,
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

            ],
            'plotOptions'=>[
                'bar'=>[
                    'pointWidth' => 10, 
                    'dataLabels'=>[
                        'enabled'=>true
                    ],
                ],
                ],
        ]);
        $interventionByConsultant->height(300+ User::count()*2);
        $interventionByConsultant->displayLegend(false);
        $interventionByConsultant->title('Interventions par Consultant');
        // $interventionByConsultant->height(300);
         return $interventionByConsultant;
     }


     function getInterventionsByTeam()
     {
         $interventionsParEquipe = DB::table('intervention_user')
             ->join('users', 'intervention_user.user_id', '=', 'users.id')
             ->rightJoin('equipes', 'users.equipe_id', '=', 'equipes.id')
             ->select(DB::raw('equipes.nom as legende'), DB::raw('COUNT(DISTINCT intervention_user.intervention_id) as total_interventions'))
             ->groupBy('equipes.nom')
             ->get();
     
         // Transformer les résultats en un tableau associatif
         $result = [];
         foreach ($interventionsParEquipe as $item) {
             $result[$item->legende] = $item->total_interventions;
         }
         $labels=array_keys($result);
         $interventionByEquipe=new InterventionByEquipe();
         $interventionByEquipe->labels($labels);
         $colors = array_map(function() {
            return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        }, $labels);
         $interventionByEquipe->dataset('interventions par équipe','doughnut',array_values($result))->backgroundColor($colors);  
         $interventionByEquipe->displayLegend(true);
         $interventionByEquipe->displayAxes(false);
         $interventionByEquipe->options([
            'title'=>[
                'display'=>true,
                'text'=>'Intervention par Equipe'
            ],
            'tooltip' => [
                'enabled' => true,
                'mode' => 'nearest', // Mode d'affichage des tooltips
                'intersect' => false,
                'external' => 'displayTooltip' // Fonction personnalisée pour afficher les tooltips
            ],
            'responsive' => true,
            'maintainAspectRatio' => false, // Pour ajuster la hauteur du graphe
            'cutout' => '80%', // Pour ajuster la largeur des arcs
        ],true);
         return $interventionByEquipe;
     }
     function getInterventionByType()
     {
        $interventionParType= DB::table('intervention_type_intervention')
        ->rightJoin('type_interventions','intervention_type_intervention.type_intervention_id','=','type_interventions.id')
        ->select(DB::raw('type_interventions.libelle as legende'),DB::raw('COUNT( intervention_type_intervention.type_intervention_id) as total'))
        ->groupBy('type_intervention_id','libelle')
        ->get();

        $result = [];
        foreach ($interventionParType as $item) {
            $result[$item->legende] = $item->total;
        }
        $labels=array_keys($result);
         $interventionByType=new InterventionByType();
         $interventionByType->labels($labels);
         $colors = array_map(function() {
            return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        }, $labels);
        $interventionByType->dataset('interventions par type','pie',array_values($result))->color($colors);  
         $interventionByType->title('Intervention par Type');
         $interventionByType->options([
            'width'=>'100%',
            // 'series'=>[
            //     'width'=>'50%',
            // ],
            // 'colorByPoint'=>true,
            'cutout'=>'90%'
            ]);
         $interventionByType->doughnut(50);
         $interventionByType->height(300+ User::count()*2);
         return $interventionByType;
     }
     public function getVehicleUsagePercentage()
    {
        // Récupérer le nombre total d'interventions
        $totalInterventions = Intervention::count();

        // Récupérer le nombre d'interventions avec véhicule de service
        $serviceVehicleCount = Intervention::where('est_vehicule_service', true)->count();

        // Récupérer le nombre d'interventions avec véhicule personnel
        $personalVehicleCount = Intervention::where('est_vehicule_service', false)->count();

        // Calculer les pourcentages
        $serviceVehiclePercentage = $totalInterventions > 0 ? round(($serviceVehicleCount / $totalInterventions) * 100, 2) : 0;
        $personalVehiclePercentage = $totalInterventions > 0 ? round(($personalVehicleCount / $totalInterventions) * 100, 2) : 0;

        // Retourner un tableau associatif
        $data= [
            'Véhicule de service ' => $serviceVehiclePercentage,
            'Véhicule personnel' => $personalVehiclePercentage,
        ];
        $vehiculeByIntervention=new VehiculeByIntervention();
        $labels=array_keys($data);
        $vehiculeByIntervention->labels($labels);
        $colors = array_map(function() {
            return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        }, $labels);
        $vehiculeByIntervention->dataset('véhicule utilisé','pie',array_values($data))->color($colors);  
        $vehiculeByIntervention->title('Véhicule utilisé');
        $vehiculeByIntervention->displayLegend(true);
        $vehiculeByIntervention->options([
            'options3d'=>[
                'enabled'=>true,
                'alpha'=>45,
                'beta'=>0,
            ],
            'tooltip'=>[
                    'valueSuffix'=>'%'
            ],
            'plotOptions'=>[
                'pie'=>[
                    'allowPointSelect'=>true,
                    'cursor'=>'pointer',
                    'depth'=>35,
                    'dataLabels'=>[
                        'enabled'=> true,
                    ]
                ]
            ],
        ]);
        return $vehiculeByIntervention;
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
        $interventionByType=$this->getInterventionByType();
        $height=300+ User::count()*2;
        $vehiculeByIntervention=$this->getVehicleUsagePercentage();
        return view('admin.dashboard', compact('vehiculeByIntervention','height','interventionByType','interventionByEquipe','interventionByConsultant','nombreInterventions', 'nombreClientsTraites', 'nombreConsultants', 'nombreEquipes'));
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
