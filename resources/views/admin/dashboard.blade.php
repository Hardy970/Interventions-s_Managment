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
              <div class="align-self-center text-center"><i data-feather="coins"></i></div>
              <div class="media-body"><span class="m-0">Nombre de Clients Traités</span>
                <h4 class="mb-0 counter">{{ $nombreClientsTraites }}</h4><i class="icon-bg" data-feather="coins"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3 col-lg-6">
        <div class="card o-hidden border-0">
          <div class="bg-primary b-r-4 card-body">
            <div class="media static-top-widget">
              <div class="align-self-center text-center"><i data-feather="user-plus"></i></div>
              <div class="media-body"><span class="m-0">Nombre des Consultants</span>
                <h4 class="mb-0 counter">{{ $nombreConsultants }}</h4><i class="icon-bg" data-feather="user-plus"></i>
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
      <div class="row h-auto  gap-5">
        <div class=" col-6 bg-white  ">
          {{ $interventionByEquipe->container() }}
          {{ $interventionByEquipe->script() }}
        </div>
        <div class=" col-5 bg-white">
          {{ $interventionByConsultant->container() }}
          {{ $interventionByConsultant->script() }}
        </div>
      </div>
      


    </div>
  </div>
  <!-- Container-fluid Ends-->
@endsection