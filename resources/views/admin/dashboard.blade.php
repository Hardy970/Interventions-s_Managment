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
    <div class=" col-xl-12 xl-100 box-col-12 mb-4">
      <div class="row  ">
        <div class=" col-xl-6 col-xs-12 col-md-6 col-sm-6 bg-white" style="min-height: 300px;height: 300px" >
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
        <div class=" col-xl-6 col-xs-12 col-md-6 col-sm-6 " style="min-height: 300px;height: {{ $height }}px" >      
            {{ $percentageByProductCategory->container() }}
            {{ $percentageByProductCategory->script() }}
        </div>
        <div class="col-xl-6 col-xs-12 col-md-6 col-sm-6  " style=" min-height: 300px;height: {{ $height }}px">  
          {{ $statutFacturation->container() }}
          {{ $statutFacturation->script() }}
        </div>
      </div>
</div>
        
  
      
      <div class="col-xl-6 xl-100 box-col-12">
        <div class="card">
          <div class="cal-date-widget card-body">
            <div class="row">
              <div class="col-xl-6 col-xs-12 col-md-6 col-sm-6">
                <div class="cal-info text-center">
                  <div>
                    <h2>24</h2>
                    <div class="d-inline-block"><span class="b-r-dark pe-3">March</span><span class="ps-3">2018</span></div>
                    <p class="f-16">There is no minimum donation, any sum is appreciated</p>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-xs-12 col-md-6 col-sm-6">
                <div class="cal-datepicker">
                  <div class="datepicker-here float-sm-end" data-language="en">           </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  <!-- Container-fluid Ends-->

@endsection