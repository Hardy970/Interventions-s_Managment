{{-- SELECT equipes.nom ,count(*) from intervention_user,users,equipes where intervention_user.user_id = users.id and users.equipe_id=equipes.id GROUP by intervention_id, equipe_id,equipes.nom; --}}

@extends('layout')

@section('title','Dashboard')

@section('content')
{{-- {!! $chart->script() !!}
{!! $chart->container() !!} --}}
<div class="container-fluid general-widget">
    <div class="row mb-5" >
      <div class="col-sm-6 col-xl-3 col-lg-6">
        <div class="card o-hidden border-0">
          <div class="bg-primary b-r-4 card-body">
            <div class="media static-top-widget">
              <div class="align-self-center text-center"><i data-feather="briefcase"></i></div>
              <div class="media-body"><span class="m-0">Nombre d'Interventions</span>
                <h4 class="mb-0 counter">{{ $nombreInterventions }}</h4><i class="icon-bg" data-feather="briefcase"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3 col-lg-6">
        <div class="card o-hidden border-0">
          <div class="bg-secondary b-r-4 card-body">
            <div class="media static-top-widget">
              <div class="align-self-center text-center"><i data-feather="database"></i></div>
              <div class="media-body"><span class="m-0">Nombre de Clients Traités</span>
                <h4 class="mb-0 counter">{{ $nombreClientsTraites }}</h4><i class="icon-bg" data-feather="database"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3 col-lg-6">
        <div class="card o-hidden border-0">
          <div class="bg-primary b-r-4 card-body">
            <div class="media static-top-widget">
              <div class="align-self-center text-center"><i data-feather="user"></i></div>
              <div class="media-body"><span class="m-0">Nombre des Consultants</span>
                <h4 class="mb-0 counter">{{ $nombreConsultants }}</h4><i class="icon-bg" data-feather="user"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3 col-lg-6">
        <div class="card o-hidden border-0">
          <div class="bg-primary b-r-4 card-body">
            <div class="media static-top-widget">
              <div class="align-self-center text-center"> <i data-feather="users"></i></div>
              <div class="media-body"><span class="m-0">Nombre des Equipes</span>
                <h4 class="mb-0 counter">{{ $nombreEquipes }}</h4><i class="icon-bg" data-feather="users"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class=" col-xl-6 xl-100 box-col-12 mb-4">
          <form action="" method="GET">
            <div class="row  ">
              <div class="col-sm-3">
                <label>Date de début :</label>

                <div class=" form-group">
                  <div class="input-group">
                    <input name="date_debut" value="{{ old('date_debut',request('date_debut')) }}" class="datepicker-here form-control digits" autocomplete="off" type="text" data-language="en">
                  </div>
                  @error('date_debut')
                  <div>
                    <span class="text-danger fw-bold "> {{ $message }} </span>
                  </div>
                  @enderror
                </div>
              </div>

              <div class="col-sm-3">
                <div class=" form-group">
                  <label>Date de fin :</label>
                  <div class="input-group">
                    <input name="date_fin" value="{{ old('date_fin',request('date_fin')) }}" autocomplete="off" class="datepicker-here form-control digits" type="text" data-language="en">
                  </div>
                  @error('date_fin')
                  <div>
                    <span class="text-danger fw-bold "> {{ $message }} </span>
                  </div>
                  @enderror
                </div>
              </div>
              <div class="col-sm-3">
             
                    <button type="submit" class=" btn btn-primary mt-4">Filtrer</button>
              </div>
            </div>
          </form>
    </div>
    <div class=" col-xl-6 xl-100 box-col-12 mb-4">
          <div class="row  ">
            <div class=" col-xl-6 col-xs-12 col-md-6 col-sm-6 " style="min-height: 300px;height: {{ $height }}px" >
              {{ $interventionByType->container() }}
              {{ $interventionByType->script() }}
            </div>
            <div class="col-xl-6 col-xs-12 col-md-6 col-sm-6  " style=" min-height: 300px;height: {{ $height }}px">
          
              {{ $interventionByConsultant->container() }}
              {{ $interventionByConsultant->script() }}
            </div>
          </div>
    </div>
    <div class=" col-xl-6 xl-100 box-col-12 mb-4">
      <div class="row  ">
        <div class=" col-xl-6 col-xs-12 col-md-6 col-sm-6" style="min-height: 300px;height: 300px" >
          {{ $interventionByEquipe->container() }}
          {{ $interventionByEquipe->script() }}
        </div>
        <div class="col-xl-6 col-xs-12 col-md-6 col-sm-6  " style=" min-height: 300px;height: 300px">
      
          {{ $vehiculeByIntervention->container() }}
          {{ $vehiculeByIntervention->script() }}
        </div>

      </div>
    </div>
    <div class=" col-xl-6 xl-100 box-col-12 mb-4">
      <div class="row  ">
        <div class=" col-xl-6 col-xs-12 col-md-6 col-sm-6 " style="min-height: 300px;height: 300px" >      
            {{ $percentageByProductCategory->container() }}
            {{ $percentageByProductCategory->script() }}
        </div>
        <div class="col-xl-6 col-xs-12 col-md-6 col-sm-6  " style=" min-height: 300px;height: 300px">  
          {{ $statutFacturation->container() }}
          {{ $statutFacturation->script() }}
        </div>
      </div>
    </div>
    <div class=" col-xl-6 xl-100 box-col-12 mb-4">
      <div class="row  ">
        <div class=" col-xl-6 col-xs-12 col-md-6 col-sm-6 " style="min-height: 300px;height: 300px" >      
            {{ $clientByProduct->container() }}
            {{ $clientByProduct->script() }}
        </div>
        <div class="col-xl-6 col-xs-12 col-md-6 col-sm-6  " style=" min-height: 300px;height: 300px">  
          {{ $interventionByChauffeur->container() }}
          {{ $interventionByChauffeur->script() }}
        </div>
      </div>
    </div>
    <div class=" col-xl-6 xl-100 box-col-12 mb-4">
      <div class="row  ">
        <div class=" col-xl-6 col-xs-12 col-md-6 col-sm-6 " style="min-height: 300px;height: 300px" >      
            {{ $clientsExigeants->container() }}
            {{ $clientsExigeants->script() }}
        </div>
        <div class="col-xl-6 col-xs-12 col-md-6 col-sm-6  " style=" min-height: 300px;height: 300px">  
          
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->

@endsection