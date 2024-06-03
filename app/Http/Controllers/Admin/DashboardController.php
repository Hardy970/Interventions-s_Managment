<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Equipe;
use App\Models\Societe;
use App\Models\Demandeur;
use App\Models\Intervention;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Charts\ClientByProduct;
use App\Charts\StatutFacturation;
use App\Charts\InterventionByType;
use Illuminate\Support\Facades\DB;
use App\Charts\InterventonByClient;
use App\Charts\InterventionByEquipe;
use App\Http\Controllers\Controller;
use App\Http\Requests\FilterRequest;
use App\Charts\InterventonByChauffeur;
use App\Charts\VehiculeByIntervention;
use App\Charts\InterventionByConsultant;
use App\Charts\PercentageByProductCategory;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function getInterventionsByConsultant($dateDebut = null, $dateFin = null)
     {
        $interventionsParConsultant = DB::table('users')
        ->leftJoin('intervention_user', 'users.id', '=', 'intervention_user.user_id')
        ->leftJoin('interventions', 'intervention_user.intervention_id', '=', 'interventions.id');
        
        if ($dateDebut && $dateFin) {
        $interventionsParConsultant = $interventionsParConsultant->whereBetween('interventions.date_debut', [$dateDebut, $dateFin]);
        }
        
        $interventionsParConsultant = $interventionsParConsultant
        ->select(
            'users.id', 
            DB::raw('CONCAT(users.first_name, " ", users.last_name) as full_name'), 
            DB::raw('COUNT(intervention_user.intervention_id) as total_interventions')
        )
        ->groupBy('users.id', 'full_name')
        ->orderBy('total_interventions', 'desc')
        ->get();
         // Transformer les données en un tableau avec le nom complet comme clé
         $result = [];
         foreach ($interventionsParConsultant as $item) {
             $result[$item->full_name] = $item->total_interventions;
         }
         dd($result);
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
         $interventionByEquipe->dataset('interventions par équipe','pie',array_values($result))->color($colors);  
         $interventionByEquipe->title('Interventions par Equipe');
         $interventionByEquipe->doughnut(70);
         $interventionByEquipe->height(300);
         $interventionByEquipe->options([
            'chart'=>[
                'options3d'=>[
                    'enabled'=>true,
                    'alpha'=>45,
                    'beta'=>0,
                ],
            ],
            'plotOptions'=>[
                'pie'=>[
                    'allowPointSelect'=>true,
                    'depth'=>35

                ],
                ],
                
        ]);
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
        $interventionByType->dataset('interventions','pie',array_values($result))->color($colors);  
         $interventionByType->title('Interventions par Type');
        
         $interventionByType->doughnut(70);
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
        $colors = ['#952323','#F8BDEB'];
        $vehiculeByIntervention->dataset('percentage','pie',array_values($data))->color($colors);  
        $vehiculeByIntervention->title('Véhicule utilisé');
        $vehiculeByIntervention->displayLegend(true);
        $vehiculeByIntervention->height(300);
        $vehiculeByIntervention->options([
            'chart'=>[
                'options3d'=>[
                    'enabled'=>true,
                    'alpha'=>45,
                    'beta'=>0,
                ],
            ],
            'tooltip'=>[
                    'valueSuffix'=>'%'
            ],
            'plotOptions'=>[
                'pie'=>[
                    'allowPointSelect'=>true,
                    'depth'=>35

                ],
                ],
                
        ]);
        return $vehiculeByIntervention;
    }
    public function getPercentageByProductCategory()
    {
        // Récupérer le nombre total d'enregistrements dans la table intervention_produit
        $totalInterventions = DB::table('intervention_produit')->count();
    
        // Récupérer le nombre d'interventions par catégorie de produit
        $categories = DB::table('intervention_produit')
            ->join('produits', 'intervention_produit.produit_id', '=', 'produits.id')
            ->join('categories', 'produits.categorie_id', '=', 'categories.id')
            ->select('categories.libelle as categorie', DB::raw('COUNT(categories.id) as total_interventions'))
            ->groupBy('categories.id', 'categories.libelle')
            ->get();
    
        // Calculer les pourcentages
        $data = [];
        foreach ($categories as $category) {
            $percentage = $totalInterventions > 0 ? round(($category->total_interventions / $totalInterventions) * 100,0) : 0;
            // number_format($percentage,4);
            $data[$category->categorie] = $percentage;
        }

        $percentageByProductCategory=new PercentageByProductCategory();
        $labels=array_keys($data);
        $percentageByProductCategory->labels($labels);
        $colors = ['#01204E','#F6DCAC','#028391','#FEAE6F'];
        $percentageByProductCategory->dataset('percentage','pie',array_values($data))->color($colors);  
        $percentageByProductCategory->title('Nature des interventions');
        $percentageByProductCategory->displayLegend(true);
        $percentageByProductCategory->height(300);
        $percentageByProductCategory->options([
            'tooltip'=>[
                    'valueSuffix'=>'%'
            ],
            'plotOptions'=>[
                'pie'=>[
                    'allowPointSelect'=>true,
                ],
                ],
                
        ]);
        return $percentageByProductCategory;
    }
    public function getPaymentStatusPercentages()
{
    // Récupérer le nombre total d'interventions
    $totalInterventions = Intervention::count();

    // Récupérer le nombre d'interventions payées
    $paidCount = Intervention::where('statut_fact', true)->count();

    // Récupérer le nombre d'interventions non payées
    $unpaidCount = Intervention::where('statut_fact', false)->count();

    // Calculer les pourcentages
    $paidPercentage = $totalInterventions > 0 ? round(($paidCount / $totalInterventions) * 100) : 0;
    $unpaidPercentage = $totalInterventions > 0 ? round(($unpaidCount / $totalInterventions) * 100) : 0;

    // Retourner un tableau associatif
    $data= [
        'Payé' => $paidPercentage,
        'Non Payé' => $unpaidPercentage,
    ];
    $statutFacturation=new StatutFacturation();
    $labels=array_keys($data);
    $statutFacturation->labels($labels);
    $statutFacturation->dataset('percentage','pie',array_values($data))->color(['green','red']);  
    $statutFacturation->title('Statut de Facturation');
    $statutFacturation->displayLegend(true);
    $statutFacturation->height(300);
    $statutFacturation->options([
        'tooltip'=>[
                'valueSuffix'=>'%'
        ],
        'plotOptions'=>[
            'pie'=>[
                'allowPointSelect'=>true,
            ],
            ],
            
    ]);
    return $statutFacturation;
}

public function getClientCountByProduct()
{
    // Récupérer les données avec une jointure sur les tables nécessaires
    $clientCountByProduct = DB::table('intervention_produit')
        ->rightJoin('produits', 'intervention_produit.produit_id', '=', 'produits.id')
        ->leftJoin('interventions', 'intervention_produit.intervention_id', '=', 'interventions.id')
        ->leftJoin('demandeurs', 'interventions.demandeur_id', '=', 'demandeurs.id')
        ->leftJoin('societes', 'demandeurs.societe_id', '=', 'societes.id')
        ->select('produits.libelle as produit', DB::raw('COUNT(DISTINCT societes.id) as total_clients'))
        ->groupBy('produits.id', 'produits.libelle')
        ->get();

    // Transformer les résultats en un tableau associatif
    $data = [];
    foreach ($clientCountByProduct as $item) {
        $data[$item->produit] = $item->total_clients;
    }
    $clientByProduct= new ClientByProduct();
    $labels=array_keys($data);
    $clientByProduct->labels($labels);
    $clientByProduct->dataset('nombre de clients','column',array_values($data))->color('#FF9A00');  
    $clientByProduct->options([
        'chart'=> [
            'options3d'=> [
                'enabled'=> true,
                'alpha'=> 15,
                'beta'=> 15,
                'depth'=> 50,
                'viewDistance'=> 25
    ]
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
            'title' => [
                'text' => null,
            ],

        ],
        'plotOptions'=> [
            'column'=> [
              'depth'=> 45,
              'dataLabels'=>[
                    'enabled'=>true
              ]
            ],
        ],
    ],false);
    $clientByProduct->title('Nombre de Client par Produit');
    $clientByProduct->displayLegend(false);
    $clientByProduct->height(300);
    return $clientByProduct;
}
public function getTop3Clients()
{
    $top3Clients = DB::table('interventions')
        ->join('demandeurs', 'interventions.demandeur_id', '=', 'demandeurs.id')
        ->rightJoin('societes', 'demandeurs.societe_id', '=', 'societes.id')
        ->select('societes.nom as client', DB::raw('COUNT(interventions.id) as total_interventions'))
        ->groupBy('societes.id', 'societes.nom')
        ->orderByDesc('total_interventions')
        ->limit(3)
        ->get();

    // Transformer les résultats en un tableau associatif
    $data = [];
    foreach ($top3Clients as $item) {
        $data[$item->client] = $item->total_interventions;
    }

    $interventionByClient= new InterventonByClient();
    $labels=array_keys($data);
    $interventionByClient->labels($labels);
    $interventionByClient->dataset('interventions','bar',array_values($data))->color("#68D2E8");  
    $interventionByClient->title('Les 3 Clients exigeants');
    $interventionByClient->displayLegend(false);
    $interventionByClient->height(300);
    $interventionByClient->options([
        'chart'=> [
            'options3d'=> [
                'enabled'=> true,
                'alpha'=> 15,
                'beta'=> 15,
                'depth'=> 50,
                'viewDistance'=> 35
    ]
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
            'title' => [
                'text' => null,
            ],

        ],
        'plotOptions'=> [
            'bar'=> [
              'depth'=> 45,
              'dataLabels'=>[
                    'enabled'=>true
              ]
            ],
        ],
    ],false);
    return $interventionByClient;
}
public function getInterventionsByChauffeur()
{
    // Récupérer les données avec une jointure à gauche pour inclure toutes les interventions
    $interventionsParChauffeur = DB::table('interventions')
        ->rightJoin('chauffeurs', 'interventions.chauffeur_id', '=', 'chauffeurs.id')
        ->select('chauffeurs.nom as chauffeur', DB::raw('COUNT(interventions.id) as total_interventions'))
        ->groupBy('chauffeurs.id', 'chauffeurs.nom')
        ->get();

    // Transformer les résultats en un tableau associatif
    $data = [];
    foreach ($interventionsParChauffeur as $item) {
        $data[$item->chauffeur] = $item->total_interventions;
    }

    $interventionByChauffeur= new InterventonByChauffeur();
    $labels=array_keys($data);
    $interventionByChauffeur->labels($labels);
    $interventionByChauffeur->dataset('interventions','bar',array_values($data))->color("#AD88C6");  
    $interventionByChauffeur->title('Interventions par chauffeur');
    $interventionByChauffeur->displayLegend(false);
    $interventionByChauffeur->height(300);
    $interventionByChauffeur->options([
        'chart'=> [
            'options3d'=> [
                'enabled'=> true,
                'alpha'=> 15,
                'beta'=> 15,
                'depth'=> 50,
                'viewDistance'=> 35
    ]
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
            'title' => [
                'text' => null,
            ],

        ],
        'plotOptions'=> [
            'bar'=> [
              'depth'=> 45,
              'dataLabels'=>[
                    'enabled'=>true
              ]
            ],
        ],
    ],false);
    return $interventionByChauffeur;
}
    public function index(FilterRequest $request)
    {
        $dateDebut = $request->input('date_debut');
        $dateFin =$request->input('date_fin');
        $dateDebut = $dateDebut ? Carbon::createFromFormat('d/m/Y',$dateDebut)->format('Y/m/d'):null;
        $dateFin = $dateFin ? Carbon::createFromFormat('d/m/Y',$dateFin)->format('Y/m/d'):null;

        if($dateDebut && $dateFin)
        {
        $nombreInterventions = Intervention::whereBetween('date_debut', [$dateDebut, $dateFin])->count();

        $nombreClientsTraites = Societe::count();

        $nombreConsultants = User::count();

        $nombreEquipes = Equipe::count();

        $interventionByConsultant= $this->getInterventionsByConsultant($dateDebut,$dateFin);
        $interventionByEquipe= $this->getInterventionsByTeam();
        $interventionByType=$this->getInterventionByType();
        $vehiculeByIntervention=$this->getVehicleUsagePercentage();
        $percentageByProductCategory=$this->getPercentageByProductCategory();
        $statutFacturation=$this->getPaymentStatusPercentages();
        $clientByProduct=$this->getClientCountByProduct();
        $interventionByChauffeur=$this->getInterventionsByChauffeur();
        $clientsExigeants=$this->getTop3Clients();
        }
        else{
            $nombreInterventions = Intervention::count();

        $nombreClientsTraites = Societe::count();

        $nombreConsultants = User::count();

        $nombreEquipes = Equipe::count();

        $interventionByConsultant= $this->getInterventionsByConsultant();
        $interventionByEquipe= $this->getInterventionsByTeam();
        $interventionByType=$this->getInterventionByType();
        $vehiculeByIntervention=$this->getVehicleUsagePercentage();
        $percentageByProductCategory=$this->getPercentageByProductCategory();
        $statutFacturation=$this->getPaymentStatusPercentages();
        $clientByProduct=$this->getClientCountByProduct();
        $interventionByChauffeur=$this->getInterventionsByChauffeur();
        $clientsExigeants=$this->getTop3Clients();
        }
        
        $height=300+ User::count()*2;
        return view('admin.dashboard', 
        compact('clientByProduct','clientsExigeants','interventionByChauffeur','statutFacturation','percentageByProductCategory','vehiculeByIntervention','height','interventionByType','interventionByEquipe','interventionByConsultant','nombreInterventions', 'nombreClientsTraites', 'nombreConsultants', 'nombreEquipes'));
    }


    
}
